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
            <li style="margin-bottom:10px;">
                <a href="{{ route('documents.show', $d) }}" style="padding:12px 14px; border:1px solid rgba(0,0,0,.08); border-radius:10px; background:#fff; display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; text-decoration:none; color:inherit; transition:border-color .2s, box-shadow .2s;">
                <span>
                    <strong>{{ $d->document_name }}</strong>
                    <span class="hint" style="margin-left:6px;">({{ ucfirst($d->status) }})</span>
                </span>
                <span style="color:var(--sage); font-weight:700; font-size:0.88rem;">View →</span>
                </a>
            </li>
        @empty
            <li>No documents yet.</li>
        @endforelse
    </ul>
@endsection
