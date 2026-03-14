@extends('layout.auth')

@section('title', 'Calculate visa score')

@section('content')
    <h1>Calculate visa readiness score</h1>
    <p class="sub">Scores 0–100 per category. Total = average (transparent calculation).</p>
    <form class="grid" method="POST" action="{{ route('scores.store') }}">
        @csrf
        <div class="grid">
            <label for="education_score">Education score (0–100)</label>
            <input id="education_score" name="education_score" type="number" min="0" max="100" value="{{ old('education_score') }}" required>
        </div>
        <div class="grid">
            <label for="financial_score">Financial score (0–100)</label>
            <input id="financial_score" name="financial_score" type="number" min="0" max="100" value="{{ old('financial_score') }}" required>
        </div>
        <div class="grid">
            <label for="documentation_score">Documentation score (0–100)</label>
            <input id="documentation_score" name="documentation_score" type="number" min="0" max="100" value="{{ old('documentation_score') }}" required>
        </div>
        <button class="btn" type="submit">Save score</button>
    </form>
    <div class="toplinks" style="margin-top:16px">
        <a href="{{ route('scores.index') }}">Back to scores</a>
    </div>
@endsection
