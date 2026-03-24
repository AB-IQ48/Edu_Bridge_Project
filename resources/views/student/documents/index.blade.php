@extends('layout.auth')

@section('title', 'My documents')

@section('content')
    <h1>My documents</h1>
    <p class="sub">Upload and manage your application documents (transcripts, financial proof, passport, etc.). Access is role-gated — only you and your assigned counsellor can see these; secure web design for digital trust.</p>

    @if (session('message'))
        <p class="error" style="background: rgba(74,124,107,0.15); color: var(--sage); border-color: var(--sage);">{{ session('message') }}</p>
    @endif

    <div class="toplinks">
        <a href="{{ route('student.documents.create') }}">Upload document</a>
        <a href="{{ route('student.index') }}">Student dashboard</a>
    </div>

    <ul style="margin-top:20px; list-style:none; padding:0;">
        @forelse($documents as $d)
            <li style="background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 14px 16px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                <div>
                    <strong>{{ $d->document_name }}</strong>
                    @if($d->document_type)
                        <span style="font-size:0.85rem; color: var(--muted);"> ({{ $d->document_type }})</span>
                    @endif
                    <br>
                    <span style="font-size:0.8rem; color: var(--muted);">
                        @if($d->status === 'pending') Pending review
                        @elseif($d->status === 'approved') Approved
                        @else Rejected
                        @endif
                        · {{ $d->created_at->format('M j, Y') }}
                    </span>
                </div>
            </li>
        @empty
            <li style="color: var(--muted); padding: 20px;">No documents yet. Upload transcripts, financial proof, or other required files.</li>
        @endforelse
    </ul>

    @if($documents->hasPages())
        <div style="margin-top: 16px;">
            {{ $documents->links() }}
        </div>
    @endif

    <div class="toplinks" style="margin-top:24px">
        <a href="{{ route('scores.index') }}">Visa readiness scores</a>
        <a href="{{ route('counsellors.index') }}">Find a counsellor</a>
    </div>
@endsection
