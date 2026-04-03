<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CounsellorStudentDocumentController extends Controller
{
    public function index(Request $request, User $student): View
    {
        abort_unless($student->isStudent(), 404);
        abort_unless($request->user()->servesAsCounsellorFor($student), 403);

        $documents = $student->studentDocuments()->latest()->paginate(15);

        return view('counsellor.student-documents.index', [
            'student' => $student,
            'documents' => $documents,
        ]);
    }

    public function download(Request $request, StudentDocument $studentDocument): StreamedResponse
    {
        abort_unless($studentDocument->canBeViewedBy($request->user()), 403);

        if (! Storage::disk('local')->exists($studentDocument->document_path)) {
            abort(404, 'File not found.');
        }

        $safeBase = preg_replace('/[^a-zA-Z0-9._\-\s]+/u', '_', $studentDocument->document_name) ?: 'document';
        $ext = pathinfo($studentDocument->document_path, PATHINFO_EXTENSION);
        $downloadName = $ext !== '' ? "{$safeBase}.{$ext}" : $safeBase;

        return Storage::disk('local')->response($studentDocument->document_path, $downloadName, [], 'inline');
    }
}
