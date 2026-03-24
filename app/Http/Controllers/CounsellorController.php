<?php

namespace App\Http\Controllers;

use App\Models\CounsellorProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounsellorController extends Controller
{
    /**
     * Display counsellor dashboard and own profile.
     */
    public function index(Request $request): View
    {
        $profile = $request->user()->counsellorProfile;

        return view('counsellor.index', [
            'profile' => $profile,
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
        ]);

        $profile->update($data);

        return redirect()->route('counsellor.index')->with('message', 'Profile updated.');
    }
}
