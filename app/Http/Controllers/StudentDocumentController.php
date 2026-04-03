<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StudentDocumentController extends Controller
{
    public function index(Request $request): View
    {
        $documents = $request->user()->studentDocuments()->latest()->paginate(10);

        return view('student.documents.index', [
            'documents' => $documents,
        ]);
    }

    public function create(Request $request): View
    {
        return view('student.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'document_name' => ['required', 'string', 'max:255'],
            'document_type' => ['nullable', 'string', 'max:50'],
            'document' => ['required', 'file', 'max:10240'],
        ]);

        $path = $request->file('document')->store('student-documents', 'local');

        StudentDocument::create([
            'user_id' => $request->user()->id,
            'document_name' => $data['document_name'],
            'document_path' => $path,
            'document_type' => $data['document_type'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('student.documents.index')->with('message', 'Document uploaded. Your assigned counsellor can view it from their dashboard.');
    }

    public function download(Request $request, StudentDocument $document): StreamedResponse
    {
        abort_unless($document->user_id === $request->user()->id, 403);

        if (! Storage::disk('local')->exists($document->document_path)) {
            abort(404, 'File not found.');
        }

        $safeBase = preg_replace('/[^a-zA-Z0-9._\-\s]+/u', '_', $document->document_name) ?: 'document';
        $ext = pathinfo($document->document_path, PATHINFO_EXTENSION);
        $downloadName = $ext !== '' ? "{$safeBase}.{$ext}" : $safeBase;

        return Storage::disk('local')->response($document->document_path, $downloadName, [], 'inline');
    }
}
