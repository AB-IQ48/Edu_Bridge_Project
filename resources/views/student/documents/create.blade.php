@extends('layout.panel')

@section('title', 'Upload document')

@section('card_class', 'card--wide')

@section('auth_content')
    <p class="role-badge-inline" style="margin-bottom:10px;">New upload</p>
    <h1>Upload a document</h1>
    <p class="sub">Add a file for your application (transcript, bank statement, passport, language test, or something else).</p>

    @if ($errors->any())
        <div class="alert alert--error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="grid" method="POST" action="{{ route('student.documents.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-section" style="padding-bottom:16px;">
            <div class="form-section__head" style="border-left:4px solid #3b82f6; padding-left:12px;">
                <div class="form-section__icon" style="background:linear-gradient(135deg,#3b82f6,#1d4ed8);">📄</div>
                <div>
                    <p class="form-section__title">Document details</p>
                    <p class="form-section__sub">Name your file clearly so reviewers can find it fast.</p>
                </div>
            </div>
            <div class="grid">
                <div class="grid">
                    <label for="document_name">Document name</label>
                    <input id="document_name" name="document_name" value="{{ old('document_name') }}" required placeholder="e.g. Bachelor transcript, HEC attested">
                </div>
                <div class="grid">
                    <label for="document_type">Type (optional)</label>
                    <select id="document_type" name="document_type">
                        <option value="">Pick a type</option>
                        <option value="transcript" {{ old('document_type') === 'transcript' ? 'selected' : '' }}>Transcript</option>
                        <option value="financial_proof" {{ old('document_type') === 'financial_proof' ? 'selected' : '' }}>Financial proof</option>
                        <option value="passport" {{ old('document_type') === 'passport' ? 'selected' : '' }}>Passport</option>
                        <option value="language_test" {{ old('document_type') === 'language_test' ? 'selected' : '' }}>Language test</option>
                        <option value="other" {{ old('document_type') === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="grid">
            <label for="document">File (max 10MB)</label>
            <input id="document" name="document" type="file" required>
            <span class="hint">PDF, JPG, or PNG. Make sure scans are easy to read.</span>
        </div>
        <button class="btn btn--sage" type="submit">Upload securely</button>
    </form>

    <div class="toplinks">
        <a href="{{ route('student.documents.index') }}">My documents</a>
        <a href="{{ route('student.index') }}">Student hub</a>
    </div>
@endsection
