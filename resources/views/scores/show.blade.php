@extends('layout.auth')

@section('title', 'Visa score')

@section('content')
    <h1>Visa readiness score</h1>
    <p class="sub">Education: {{ $score->education_score }} · Financial: {{ $score->financial_score }} · Documentation: {{ $score->documentation_score }} → Total: {{ $score->total_score }}</p>
    <p class="hint">Recorded {{ $score->created_at->format('Y-m-d H:i') }}</p>
    <div class="toplinks">
        <a href="{{ route('scores.index') }}">Back to scores</a>
    </div>
@endsection
