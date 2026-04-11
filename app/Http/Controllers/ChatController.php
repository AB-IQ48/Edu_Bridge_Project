<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use App\Notifications\ChatMessageReceivedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(Request $request, ?User $user = null): View
    {
        $authUser = $request->user();
        $contacts = $this->allowedContacts($authUser);

        $selectedUser = null;
        if ($user && $contacts->contains('id', $user->id)) {
            $selectedUser = $user;
        } elseif ($contacts->isNotEmpty()) {
            $selectedUser = $contacts->first();
        }

        $messages = collect();

        // Mark open conversation as read first so unread badges stay accurate.
        if ($selectedUser) {
            ChatMessage::query()
                ->where('sender_id', $selectedUser->id)
                ->where('receiver_id', $authUser->id)
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            $messages = ChatMessage::query()
                ->where(function ($q) use ($authUser, $selectedUser) {
                    $q->where('sender_id', $authUser->id)
                        ->where('receiver_id', $selectedUser->id);
                })
                ->orWhere(function ($q) use ($authUser, $selectedUser) {
                    $q->where('sender_id', $selectedUser->id)
                        ->where('receiver_id', $authUser->id);
                })
                ->with(['sender', 'receiver'])
                ->orderBy('created_at')
                ->get();
        }

        $unreadByContact = [];
        $totalUnread = 0;
        $onlineMap = [];

        if ($contacts->isNotEmpty()) {
            $senderIds = $contacts->pluck('id');
            $countsBySender = ChatMessage::query()
                ->where('receiver_id', $authUser->id)
                ->whereNull('read_at')
                ->whereIn('sender_id', $senderIds)
                ->selectRaw('sender_id, COUNT(*) as c')
                ->groupBy('sender_id')
                ->pluck('c', 'sender_id');

            foreach ($contacts as $contact) {
                $count = (int) ($countsBySender[$contact->id] ?? 0);
                $unreadByContact[$contact->id] = $count;
                $totalUnread += $count;
                $onlineMap[$contact->id] = $contact->last_seen_at && $contact->last_seen_at->gte(now()->subMinutes(3));
            }
        }

        return view('chat.index', [
            'contacts' => $contacts,
            'selectedUser' => $selectedUser,
            'messages' => $messages,
            'unreadByContact' => $unreadByContact,
            'totalUnread' => $totalUnread,
            'onlineMap' => $onlineMap,
        ]);
    }

    public function store(Request $request, User $user): RedirectResponse
    {
        $authUser = $request->user();

        if ($authUser->isStudent()) {
            $assignedCounsellorUser = $authUser->assignedCounsellorProfile?->user;
            if (! $assignedCounsellorUser || (int) $assignedCounsellorUser->id !== (int) $user->id) {
                abort(403, 'You can only send messages to your current assigned counsellor.');
            }
        } elseif (! $this->allowedContacts($authUser)->contains('id', $user->id)) {
            abort(403, 'Unauthorized chat access.');
        }

        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ChatMessage::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id,
            'message' => trim($data['message']),
        ]);

        try {
            $preview = mb_strimwidth(trim($data['message']), 0, 120, '...');
            $user->notify(new ChatMessageReceivedNotification(
                senderName: $authUser->name,
                messagePreview: $preview,
                senderUserId: $authUser->id
            ));
        } catch (\Throwable $e) {
            Log::warning('Chat message notification failed.', [
                'sender_id' => $authUser->id,
                'receiver_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route('chat.show', $user)->with('message', 'Message sent.');
    }

    private function allowedContacts(User $user)
    {
        if ($user->isStudent()) {
            return $this->studentChatContacts($user);
        }

        if ($user->isCounsellor()) {
            $profile = $user->counsellorProfile;
            if (! $profile) {
                return collect();
            }

            return $profile->assignedStudents()
                ->whereHas('role', fn ($q) => $q->where('name', 'student'))
                ->orderBy('name')
                ->get();
        }

        return collect();
    }

    /**
     * Counsellors the student may open in chat: current assigned counsellor plus any former counsellor
     * they exchanged messages with (history is kept when switching counsellor).
     */
    private function studentChatContacts(User $student): \Illuminate\Support\Collection
    {
        $idsFromMessages = $this->counsellorUserIdsFromChatHistory($student);

        $contacts = User::query()
            ->whereIn('id', $idsFromMessages)
            ->whereHas('role', fn ($q) => $q->where('name', 'counsellor'))
            ->orderBy('name')
            ->get();

        $current = $student->assignedCounsellorProfile?->user;
        if ($current && ! $contacts->contains('id', $current->id)) {
            $contacts->prepend($current);
        } elseif ($current) {
            $contacts = $contacts->sortBy(function (User $u) use ($current) {
                return $u->id === $current->id ? '0' : '1'.$u->name;
            })->values();
        }

        return $contacts->unique('id')->values();
    }

    /**
     * @return list<int>
     */
    private function counsellorUserIdsFromChatHistory(User $student): array
    {
        $peerIds = ChatMessage::query()
            ->where(function ($q) use ($student) {
                $q->where('sender_id', $student->id)
                    ->orWhere('receiver_id', $student->id);
            })
            ->get()
            ->map(function (ChatMessage $m) use ($student) {
                return (int) ($m->sender_id === $student->id ? $m->receiver_id : $m->sender_id);
            })
            ->unique()
            ->filter(fn (int $id) => $id !== (int) $student->id)
            ->values()
            ->all();

        return array_values($peerIds);
    }
}
