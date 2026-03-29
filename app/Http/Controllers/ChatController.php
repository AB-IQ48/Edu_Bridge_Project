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

        if (! $this->allowedContacts($authUser)->contains('id', $user->id)) {
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
            $user->notify(new ChatMessageReceivedNotification($authUser->name, $preview));
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
            $profile = $user->assignedCounsellorProfile;
            if (! $profile || ! $profile->user) {
                return collect();
            }

            return collect([$profile->user]);
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
}
