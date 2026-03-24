@extends('layout.auth')

@section('title', 'Visa Readiness Calculator')

@section('content')
    <h1>Visa Readiness Calculator</h1>
    <p class="sub">Enter your scores (0–100) per category. Total uses a <strong>transparent, rule-based formula</strong>: Academic 25%, Financial 25%, Language 20%, Documentation 20%, Interview 10%. Interpretable — no black box.</p>

    @if ($errors->any())
        <ul class="error" style="margin-bottom:16px">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <form class="grid" method="POST" action="{{ route('scores.store') }}">
        @csrf
        <div class="grid">
            <label for="education_score">Academic eligibility (0–100)</label>
            <input id="education_score" name="education_score" type="number" min="0" max="100" value="{{ old('education_score') }}" required placeholder="GPA, degree match to destination">
            <span class="hint">Weight: 25%. Your academic fit for the chosen course and country.</span>
        </div>
        <div class="grid">
            <label for="financial_score">Financial proof (0–100)</label>
            <input id="financial_score" name="financial_score" type="number" min="0" max="100" value="{{ old('financial_score') }}" required placeholder="Funds, sponsorship">
            <span class="hint">Weight: 25%. Bank statements, sponsorship, or scholarship covering required period.</span>
        </div>
        <div class="grid">
            <label for="language_score">Language proficiency (0–100)</label>
            <input id="language_score" name="language_score" type="number" min="0" max="100" value="{{ old('language_score') }}" required placeholder="IELTS, TOEFL, etc.">
            <span class="hint">Weight: 20%. Test scores meeting course and visa minimums.</span>
        </div>
        <div class="grid">
            <label for="documentation_score">Document completeness (0–100)</label>
            <input id="documentation_score" name="documentation_score" type="number" min="0" max="100" value="{{ old('documentation_score') }}" required placeholder="Passport, police clearance, etc.">
            <span class="hint">Weight: 20%. All required documents uploaded and valid.</span>
        </div>
        <div class="grid">
            <label for="interview_score">Interview readiness (0–100)</label>
            <input id="interview_score" name="interview_score" type="number" min="0" max="100" value="{{ old('interview_score') }}" required placeholder="Prepared for visa interview">
            <span class="hint">Weight: 10%. Prepared for common visa interview questions.</span>
        </div>
        <button class="btn" type="submit">Calculate & save score</button>
    </form>

    <div class="toplinks" style="margin-top:16px">
        <a href="{{ route('scores.index') }}">Back to my scores</a>
        <a href="{{ route('student.index') }}">Student dashboard</a>
    </div>
@endsection
