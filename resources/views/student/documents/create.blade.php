@extends('layout.auth')

@section('title', 'Upload document')

@section('content')
    <h1>Upload document</h1>
    <p class="sub">Add a document for your application (transcript, financial proof, passport copy, etc.).</p>

    @if ($errors->any())
        <ul class="error" style="margin-bottom:16px">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <form class="grid" method="POST" action="{{ route('student.documents.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid">
            <label for="document_name">Document name</label>
            <input id="document_name" name="document_name" value="{{ old('document_name') }}" required placeholder="e.g. Bachelor transcript">
        </div>
        <div class="grid">
            <label for="document_type">Type (optional)</label>
            <select id="document_type" name="document_type">
                <option value="">— Select —</option>
                <option value="transcript" {{ old('document_type') === 'transcript' ? 'selected' : '' }}>Transcript</option>
                <option value="financial_proof" {{ old('document_type') === 'financial_proof' ? 'selected' : '' }}>Financial proof</option>
                <option value="passport" {{ old('document_type') === 'passport' ? 'selected' : '' }}>Passport</option>
                <option value="language_test" {{ old('document_type') === 'language_test' ? 'selected' : '' }}>Language test</option>
                <option value="other" {{ old('document_type') === 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="grid">
            <label for="document">File (max 10MB)</label>
            <input id="document" name="document" type="file" required>
        </div>
        <button class="btn" type="submit">Upload</button>
    </form>

    <div class="toplinks" style="margin-top:16px">
        <a href="{{ route('student.documents.index') }}">Back to my documents</a>
    </div>
@endsection
