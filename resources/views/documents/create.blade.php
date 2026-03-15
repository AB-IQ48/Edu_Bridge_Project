@extends('layout.auth')

@section('title', 'Upload document')

@section('content')
    <h1>Upload verification document</h1>
    <p class="sub">Upload professional credentials for admin verification. Documents enter a <strong>pending</strong> state until an administrator approves them — part of our structured verification workflow for digital trust.</p>
    <form class="grid" method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid">
            <label for="document_name">Document name</label>
            <input id="document_name" name="document_name" value="{{ old('document_name') }}" required>
        </div>
        <div class="grid">
            <label for="document">File (max 10MB)</label>
            <input id="document" name="document" type="file" required>
        </div>
        <button class="btn" type="submit">Upload</button>
    </form>
    <div class="toplinks" style="margin-top:16px">
        <a href="{{ route('documents.index') }}">Back to documents</a>
    </div>
@endsection
