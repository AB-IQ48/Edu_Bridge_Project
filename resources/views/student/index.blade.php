@extends('layout.auth')

@section('title', 'Student Dashboard')

@section('content')
    <h1>Student Dashboard</h1>
    <p class="sub">Your visa readiness scores.</p>
    <div class="toplinks">
        <a href="{{ route('scores.create') }}">Calculate new score</a>
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
