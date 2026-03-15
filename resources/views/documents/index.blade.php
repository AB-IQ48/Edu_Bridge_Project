@extends('layout.auth')

@section('title', 'My documents')

@section('content')
    <h1>Verification documents</h1>
    <p class="sub">Structured verification workflow: upload credentials here. Documents are <strong>reviewed and approved by an administrator</strong> before your verified status is updated. No visibility to students until approved.</p>
    @if (session('message'))
        <p class="error" style="background: rgba(74,124,107,0.15); color: var(--sage); border-color: var(--sage);">{{ session('message') }}</p>
    @endif
    <div class="toplinks">
        <a href="{{ route('documents.create') }}">Upload document</a>
        <a href="{{ route('counsellor.index') }}">Counsellor dashboard</a>
    </div>
    <ul style="margin-top:16px; padding-left:20px">
        @forelse($documents as $d)
            <li>{{ $d->document_name }} — {{ $d->status }} <a href="{{ route('documents.show', $d) }}">View</a></li>
        @empty
            <li>No documents yet.</li>
        @endforelse
    </ul>
@endsection
