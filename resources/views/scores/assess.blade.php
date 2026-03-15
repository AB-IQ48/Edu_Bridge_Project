@extends('layout.auth')

@section('title', 'Visa Readiness Assessment')

@section('content')
    <h1>Visa Readiness Assessment</h1>
    <p class="sub">Answer the questions about your case. Your visa readiness score will be calculated at the end using a <strong>documented, rule-based model</strong> (not opaque AI). Weights: Academic 25%, Financial 25%, Language 20%, Documentation 20%, Interview 10%.</p>

    @if ($errors->any())
        <ul class="error" style="margin-bottom:16px">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('scores.assess.store') }}">
        @csrf

        @php
            $sections = [
                'education_score' => ['title' => 'Academic & previous / designated degree', 'sub' => 'Your qualifications and course choice'],
                'financial_score' => ['title' => 'Financial proof', 'sub' => 'Funding and bank evidence'],
                'language_score' => ['title' => 'Language proficiency', 'sub' => 'English test and validity'],
                'documentation_score' => ['title' => 'Documentation', 'sub' => 'Passport, certificates, identity docs'],
                'interview_score' => ['title' => 'Interview readiness', 'sub' => 'Preparation and documents for interview'],
            ];
        @endphp

        @foreach ($sections as $dim => $section)
            <div style="margin-bottom: 28px; padding-bottom: 24px; border-bottom: 1px solid rgba(0,0,0,0.08);">
                <h2 style="font-size: 1.05rem; margin-bottom: 4px;">{{ $section['title'] }}</h2>
                <p class="hint" style="margin-bottom: 16px;">{{ $section['sub'] }}</p>
                @foreach ($questions as $qKey => $q)
                    @if ($q['dimension'] !== $dim) @continue @endif
                    <div class="grid" style="margin-bottom: 18px;">
                        <label for="q-{{ $qKey }}" style="font-weight: 600;">{{ $q['label'] }}</label>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
                            @foreach ($q['options'] as $optKey => $points)
                                <label style="display: inline-flex; align-items: center; gap: 6px; cursor: pointer; font-weight: 400;">
                                    <input type="radio" name="{{ $qKey }}" id="q-{{ $qKey }}-{{ $optKey }}" value="{{ $optKey }}" {{ old($qKey) === $optKey ? 'checked' : '' }} required>
                                    {{ \App\Services\VisaQuestionnaire::optionLabel($optKey) }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button class="btn" type="submit">See my visa readiness score</button>
    </form>

    <div class="toplinks" style="margin-top: 20px;">
        <a href="{{ route('scores.index') }}">Back to my scores</a>
        <a href="{{ route('scores.create') }}">Quick score (enter numbers)</a>
        <a href="{{ route('student.index') }}">Student dashboard</a>
    </div>
@endsection
