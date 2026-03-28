@extends('layout.auth')

@section('title', 'My documents')

@section('content')
    <h1>Verification documents</h1>
    <p class="sub">Structured verification workflow: upload credentials here. Documents are <strong>reviewed and approved by an administrator</strong> before your verified status is updated. No visibility to students until approved.</p>
    <div class="toplinks">
        <a href="{{ route('documents.create') }}">Upload document</a>
        <a href="{{ route('counsellor.index') }}">Counsellor dashboard</a>
    </div>
    <ul style="margin-top:16px; padding-left:0; list-style:none;">
        @forelse($documents as $d)
            <li style="padding:12px 14px; border:1px solid rgba(0,0,0,.08); border-radius:10px; margin-bottom:10px; background:#fff; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap;">
                <span>
                    <strong>{{ $d->document_name }}</strong>
                    <span class="hint" style="margin-left:6px;">({{ ucfirst($d->status) }})</span>
                </span>
                <a href="{{ route('documents.show', $d) }}">View</a>
            </li>
        @empty
            <li>No documents yet.</li>
        @endforelse
    </ul>
@endsection
