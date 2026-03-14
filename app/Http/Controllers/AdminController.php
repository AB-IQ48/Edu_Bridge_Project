<?php

namespace App\Http\Controllers;

use App\Models\CounsellorProfile;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display admin dashboard and pending verification items.
     */
    public function index(Request $request): View
    {
        $pendingProfiles = CounsellorProfile::where('verification_status', 'pending')
            ->with('user')
            ->latest()
            ->paginate(10);

        $pendingDocuments = Document::where('status', 'pending')
            ->with('counsellorProfile.user')
            ->latest()
            ->paginate(10);

        return view('admin.index', [
            'pendingProfiles' => $pendingProfiles,
            'pendingDocuments' => $pendingDocuments,
        ]);
    }

    /**
     * Approve or reject counsellor profile verification.
     */
    public function reviewProfile(Request $request, CounsellorProfile $counsellorProfile)
    {
        $request->validate([
            'verification_status' => ['required', 'in:approved,rejected'],
        ]);

        $counsellorProfile->update([
            'verification_status' => $request->verification_status,
        ]);

        return back()->with('message', 'Profile verification updated.');
    }

    /**
     * Approve or reject a document.
     */
    public function reviewDocument(Request $request, Document $document)
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        $document->update(['status' => $request->status]);

        return back()->with('message', 'Document review updated.');
    }
}
