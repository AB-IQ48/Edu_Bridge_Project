@extends('layout.auth')

@section('title', 'Document')

@section('content')
    <h1>{{ $document->document_name }}</h1>
    <p class="sub">Status: {{ $document->status }}</p>
    <div class="toplinks">
        <a href="{{ route('documents.index') }}">Document list</a>
    </div>
@endsection
