<?php

namespace App\Http\Controllers;

use App\Models\CounsellorProfile;
use App\Notifications\StudentCounsellorLinkNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CounsellorListingController extends Controller
{
    /**
     * Display the list of verified counsellors. Students can attach to one.
     */
    public function index(): View
    {
        $counsellors = CounsellorProfile::query()
            ->where('verification_status', 'approved')
            ->with('user')
            ->orderBy('experience_years', 'desc')
            ->get();

        return view('counsellors.listing', [
            'counsellors' => $counsellors,
        ]);
    }

    /**
     * Public profile page for a verified counsellor (helps students compare and choose).
     */
    public function show(CounsellorProfile $counsellorProfile): View
    {
        if ($counsellorProfile->verification_status !== 'approved') {
            abort(404);
        }

        $counsellorProfile->load('user');

        return view('counsellors.show', [
            'profile' => $counsellorProfile,
        ]);
    }

    /**
     * Attach the authenticated student to the given counsellor.
     */
    public function attach(Request $request, CounsellorProfile $counsellorProfile): RedirectResponse
    {
        $user = $request->user();

        if (! $user->isStudent()) {
            return redirect()->route('counsellors.index')
                ->with('error', 'Only students can attach to a counsellor.');
        }

        if ($counsellorProfile->verification_status !== 'approved') {
            return redirect()->route('counsellors.index')
                ->with('error', 'You can only attach to verified counsellors.');
        }

        $user->forceFill([
            'assigned_counsellor_profile_id' => $counsellorProfile->id,
        ])->save();

        try {
            $counsellorProfile->user?->notify(new StudentCounsellorLinkNotification($user->name, 'attached'));
        } catch (\Throwable $e) {
            Log::warning('Failed to send attach notification.', [
                'student_id' => $user->id,
                'counsellor_profile_id' => $counsellorProfile->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->back()
            ->with('message', 'You are now connected to ' . $counsellorProfile->user->name . '. They can now guide you through your application.');
    }

    /**
     * Detach the authenticated student from their current counsellor.
     */
    public function detach(Request $request): RedirectResponse
    {
        $user = $request->user();
        $currentCounsellor = $user->assignedCounsellorProfile;

        if (! $user->isStudent()) {
            return redirect()->route('dashboard')
                ->with('error', 'Only students can detach from a counsellor.');
        }

        $user->forceFill(['assigned_counsellor_profile_id' => null])->save();

        if ($currentCounsellor && $currentCounsellor->user) {
            try {
                $currentCounsellor->user->notify(new StudentCounsellorLinkNotification($user->name, 'detached'));
            } catch (\Throwable $e) {
                Log::warning('Failed to send detach notification.', [
                    'student_id' => $user->id,
                    'counsellor_profile_id' => $currentCounsellor->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('counsellors.index')
            ->with('message', 'You have been disconnected from your counsellor. You can attach to a new one anytime.');
    }
}
