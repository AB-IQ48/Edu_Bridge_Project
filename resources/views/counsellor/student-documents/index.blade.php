@extends('layout.auth')

@section('title', 'Student documents')

@section('content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Counsellor</p>
    <h1>Documents — {{ $student->name }}</h1>
    <p class="sub">Files this student uploaded for you to review. Only their <strong>assigned</strong> counsellor (you) can open these.</p>

    <div class="toplinks" style="margin-bottom:18px;">
        <a href="{{ route('chat.show', $student) }}">Open chat</a>
        <a href="{{ route('counsellor.index') }}">Counsellor dashboard</a>
    </div>

    <ul style="margin:0; padding:0; list-style:none;">
        @forelse($documents as $d)
            <li style="margin-bottom:12px; padding:16px 18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:#fff; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                <div>
                    <strong>{{ $d->document_name }}</strong>
                    @if($d->document_type)
                        <span class="hint" style="margin-left:6px;">· {{ $d->document_type }}</span>
                    @endif
                    <div class="hint" style="margin-top:6px; font-size:0.82rem;">
                        {{ ucfirst($d->status) }} · {{ $d->created_at->format('M j, Y') }}
                    </div>
                </div>
                <a href="{{ route('counsellor.student-documents.download', $d) }}" class="btn btn--sage" style="width:auto; padding:10px 18px; font-size:0.88rem; text-decoration:none;">Open file</a>
            </li>
        @empty
            <li class="hint" style="padding:24px; border-radius:12px; border:1px dashed rgba(0,0,0,0.12);">No documents uploaded yet.</li>
        @endforelse
    </ul>

    @if($documents->hasPages())
        <div style="margin-top:16px;">{{ $documents->links() }}</div>
    @endif
@endsection
