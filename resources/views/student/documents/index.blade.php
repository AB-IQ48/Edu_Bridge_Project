@extends('layout.panel')

@section('title', 'My documents')

@section('card_class', 'card--wide')

@section('auth_content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Secure uploads</p>
    <h1>My documents</h1>
    <p class="sub">Keep transcripts, bank letters, passport scans, and other files here. Only you and your assigned counsellor can open them.</p>

    <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:18px;">
        <a href="{{ route('student.documents.create') }}" class="btn btn--sage" style="width:auto; padding:10px 18px; font-size:0.88rem;">+ Upload document</a>
    </div>

    <ul style="list-style:none; padding:0; margin:0;">
        @forelse($documents as $d)
            <li style="margin-bottom:12px; padding:16px 18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:linear-gradient(135deg,#fff,#f9faf9); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
                <div>
                    <strong style="font-size:1.02rem;">{{ $d->document_name }}</strong>
                    @if($d->document_type)
                        <span style="font-size:0.8rem; color:var(--muted);"> · {{ $d->document_type }}</span>
                    @endif
                    <div style="font-size:0.82rem; color:var(--muted); margin-top:6px;">
                        @if($d->status === 'pending')
                            <span style="color:#ca8a04; font-weight:600;">Pending review</span>
                        @elseif($d->status === 'approved')
                            <span style="color:#15803d; font-weight:600;">Approved</span>
                        @else
                            <span style="color:#b91c1c; font-weight:600;">Rejected</span>
                        @endif
                        · {{ $d->created_at->format('M j, Y') }}
                    </div>
                </div>
            </li>
        @empty
            <li style="text-align:center; padding:40px 20px; border-radius:14px; border:2px dashed rgba(0,0,0,0.1); background:rgba(255,255,255,0.7);">
                <p style="margin:0 0 14px; color:var(--muted);">No documents yet. Upload your first file to get started.</p>
                <a href="{{ route('student.documents.create') }}" class="btn btn--sage" style="width:auto; display:inline-flex; padding:12px 22px;">Upload now</a>
            </li>
        @endforelse
    </ul>

    @if($documents->hasPages())
        <div style="margin-top: 16px;">
            {{ $documents->links() }}
        </div>
    @endif

    <div class="toplinks" style="margin-top:20px;">
        <a href="{{ route('scores.index') }}">Visa scores</a>
        <a href="{{ route('counsellors.index') }}">Find a counsellor</a>
    </div>
@endsection
