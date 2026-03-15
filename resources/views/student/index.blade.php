@extends('layout.auth')

@section('title', 'Student Dashboard')

@section('content')
    <h1>Student Dashboard</h1>
    <p class="sub">Manage your documents and visa readiness.</p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px; margin: 20px 0;">
        <a href="{{ route('student.documents.index') }}" style="background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 16px; text-decoration: none; color: var(--ink);">
            <strong>My documents</strong><br>
            <span style="font-size:0.85rem; color: var(--muted);">Upload transcripts, financial proof, passport</span>
        </a>
        <a href="{{ route('scores.index') }}" style="background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 16px; text-decoration: none; color: var(--ink);">
            <strong>Visa readiness</strong><br>
            <span style="font-size:0.85rem; color: var(--muted);">View and calculate your score</span>
        </a>
        <a href="{{ route('counsellors.index') }}" style="background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 16px; text-decoration: none; color: var(--ink);">
            <strong>Find a counsellor</strong><br>
            <span style="font-size:0.85rem; color: var(--muted);">Connect with a verified counsellor</span>
        </a>
    </div>

    <div class="toplinks">
        <a href="{{ route('scores.assess') }}">Visa readiness assessment (answer questions)</a>
        <a href="{{ route('scores.create') }}">Quick score (enter numbers)</a>
        <a href="{{ route('student.documents.create') }}">Upload document</a>
        <a href="{{ route('student.profile') }}">Profile</a>
    </div>
    <ul style="margin-top:16px; padding-left:20px">
        @forelse($scores as $s)
            <li><a href="{{ route('scores.show', $s) }}">Score {{ $s->total_score }} ({{ $s->created_at->format('Y-m-d') }})</a></li>
        @empty
            <li>No scores yet.</li>
        @endforelse
    </ul>
    <div class="toplinks" style="margin-top:24px">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit" class="btn" style="width:auto; padding:8px 16px">Logout</button></form>
    </div>
@endsection
