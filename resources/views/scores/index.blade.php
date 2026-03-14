@extends('layout.auth')

@section('title', 'Visa scores')

@section('content')
    <h1>Visa readiness scores</h1>
    @if (session('message'))
        <p class="error" style="background: rgba(74,124,107,0.15); color: var(--sage); border-color: var(--sage);">{{ session('message') }}</p>
    @endif
    <div class="toplinks">
        <a href="{{ route('scores.create') }}">Calculate new score</a>
        <a href="{{ route('student.index') }}">Student dashboard</a>
    </div>
    <ul style="margin-top:16px; padding-left:20px">
        @forelse($scores as $s)
            <li><a href="{{ route('scores.show', $s) }}">Total: {{ $s->total_score }} (E:{{ $s->education_score }} F:{{ $s->financial_score }} D:{{ $s->documentation_score }}) — {{ $s->created_at->format('Y-m-d') }}</a></li>
        @empty
            <li>No scores yet.</li>
        @endforelse
    </ul>
@endsection
