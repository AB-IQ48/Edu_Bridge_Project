<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * List documents for the authenticated counsellor's profile.
     */
    public function index(Request $request): View
    {
        $profile = $request->user()->counsellorProfile;

        if (! $profile) {
            abort(404, 'Counsellor profile not found.');
        }

        $documents = $profile->documents()->latest()->paginate(10);

        return view('documents.index', [
            'documents' => $documents,
            'profile' => $profile,
        ]);
    }

    /**
     * Show upload form.
     */
    public function create(Request $request): View
    {
        $profile = $request->user()->counsellorProfile;

        if (! $profile) {
            abort(404, 'Counsellor profile not found.');
        }

        return view('documents.create', ['profile' => $profile]);
    }

    /**
     * Store uploaded verification document.
     */
    public function store(Request $request): RedirectResponse
    {
        $profile = $request->user()->counsellorProfile;

        if (! $profile) {
            abort(404, 'Counsellor profile not found.');
        }

        $data = $request->validate([
            'document_name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'file', 'max:10240'], // 10MB
        ]);

        $path = $request->file('document')->store('counsellor-documents', 'local');

        Document::create([
            'counsellor_profile_id' => $profile->id,
            'document_name' => $data['document_name'],
            'document_path' => $path,
            'status' => 'pending',
        ]);

        return redirect()->route('documents.index')->with('message', 'Document uploaded for review.');
    }

    /**
     * Show single document (metadata only; actual file served separately if needed).
     */
    public function show(Request $request, Document $document): View
    {
        if ($document->counsellorProfile->user_id !== $request->user()->id) {
            abort(403);
        }

        return view('documents.show', ['document' => $document]);
    }
}
