@extends('layout.panel')

@section('title', 'Visa Readiness Assessment')

@section('card_class', 'card--wide')

@section('auth_content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Student · Visa readiness</p>
    <h1>Visa readiness assessment</h1>
    <p class="sub">Pick where you want to study first, then answer honestly. Your score follows <strong>fixed rules</strong> (no hidden AI). Weights: academic 25%, financial 25%, language 20%, documents 20%, interview 10%. Rules change, so always check the <strong>official immigration or embassy page</strong> for your country. We put useful official links on your result page.</p>

    @if ($errors->any())
        <div class="alert alert--error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('scores.assess.store') }}">
        @csrf

        <div class="form-section" style="margin-bottom:8px;">
            <div class="form-section__head">
                <div class="form-section__icon" style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%); color:#fff;">🌍</div>
                <div>
                    <p class="form-section__title">Where are you applying?</p>
                    <p class="form-section__sub">We use this for tips and links. It does not change how the numbers are weighted.</p>
                </div>
            </div>
            <div class="q-block">
                <label class="q-label" for="destination_country" style="display:block; margin-bottom:8px;">Destination country / region</label>
                <select name="destination_country" id="destination_country" class="input" required style="max-width:100%; padding:10px 12px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                    <option value="" disabled {{ old('destination_country') ? '' : 'selected' }}>Select one…</option>
                    @foreach($countries as $code => $label)
                        <option value="{{ $code }}" {{ old('destination_country') === $code ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @php
            $sections = [
                'education_score' => ['title' => 'Academic & course fit', 'sub' => 'Qualifications and how they match your chosen programme', 'emoji' => '🎓', 'accent' => 'linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%)'],
                'financial_score' => ['title' => 'Financial proof', 'sub' => 'Funding, bank evidence, and sponsorship', 'emoji' => '💰', 'accent' => 'linear-gradient(135deg, #22c55e 0%, #15803d 100%)'],
                'language_score' => ['title' => 'Language proficiency', 'sub' => 'English tests and validity for your destination', 'emoji' => '🗣️', 'accent' => 'linear-gradient(135deg, #a855f7 0%, #7c3aed 100%)'],
                'documentation_score' => ['title' => 'Documentation', 'sub' => 'Passport, certificates, identity and completeness', 'emoji' => '📁', 'accent' => 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)'],
                'interview_score' => ['title' => 'Interview readiness', 'sub' => 'Preparation and clarity for a visa interview', 'emoji' => '✅', 'accent' => 'linear-gradient(135deg, #e07a5f 0%, #c2410c 100%)'],
            ];
        @endphp

        @foreach ($sections as $dim => $section)
            <div class="form-section">
                <div class="form-section__head">
                    <div class="form-section__icon" style="background: {{ $section['accent'] }}; color:#fff;">{{ $section['emoji'] }}</div>
                    <div>
                        <p class="form-section__title">{{ $section['title'] }}</p>
                        <p class="form-section__sub">{{ $section['sub'] }}</p>
                    </div>
                </div>
                @foreach ($questions as $qKey => $q)
                    @if ($q['dimension'] !== $dim) @continue @endif
                    <div class="q-block">
                        <p class="q-label" style="margin:0;">{{ $q['label'] }}</p>
                        <div class="radio-grid">
                            @foreach ($q['options'] as $optKey => $points)
                                <label class="radio-option">
                                    <input type="radio" name="{{ $qKey }}" id="q-{{ $qKey }}-{{ $optKey }}" value="{{ $optKey }}" {{ old($qKey) === $optKey ? 'checked' : '' }} required>
                                    <span>{{ \App\Services\VisaQuestionnaire::optionLabel($optKey) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <button class="btn btn--sage" type="submit">See my visa readiness score →</button>
    </form>

    <div class="toplinks">
        <a href="{{ route('scores.index') }}">My scores</a>
        <a href="{{ route('student.index') }}">Student dashboard</a>
    </div>
@endsection
