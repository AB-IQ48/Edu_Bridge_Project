<?php

namespace App\Http\Controllers;

use App\Models\CounsellorProfile;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounsellorController extends Controller
{
    /**
     * Display counsellor dashboard and own profile.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $profile = $user->counsellorProfile;
        $unreadChatCount = 0;

        if ($profile) {
            $studentIds = $profile->assignedStudents()->pluck('id');
            if ($studentIds->isNotEmpty()) {
                $unreadChatCount = ChatMessage::query()
                    ->whereIn('sender_id', $studentIds)
                    ->where('receiver_id', $user->id)
                    ->whereNull('read_at')
                    ->count();
            }
        }

        return view('counsellor.index', [
            'profile' => $profile,
            'unreadChatCount' => $unreadChatCount,
        ]);
    }

    /**
     * Show form to edit professional profile.
     */
    public function edit(Request $request): View
    {
        $profile = $request->user()->counsellorProfile;

        if (! $profile) {
            abort(404, 'Counsellor profile not found.');
        }

        return view('counsellor.edit', ['profile' => $profile]);
    }

    /**
     * Update professional profile.
     */
    public function update(Request $request)
    {
        $profile = $request->user()->counsellorProfile;

        if (! $profile) {
            abort(404, 'Counsellor profile not found.');
        }

        $data = $request->validate([
            'organization_name' => ['required', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:70'],
            'city' => ['nullable', 'string', 'max:120'],
            'phone' => ['nullable', 'string', 'max:40'],
            'website' => ['nullable', 'string', 'max:255'],
            'countries_served' => ['nullable', 'string', 'max:500'],
            'languages' => ['nullable', 'string', 'max:255'],
            'specializations' => ['nullable', 'string', 'max:2000'],
            'bio' => ['nullable', 'string', 'max:5000'],
        ]);

        $profile->update($data);

        return redirect()->route('counsellor.index')->with('message', 'Profile updated.');
    }
}
