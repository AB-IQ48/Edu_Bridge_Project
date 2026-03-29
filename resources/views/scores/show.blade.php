@extends('layout.panel')

@section('title', 'Visa score')

@section('card_class', 'card--wide')

@section('auth_content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Result</p>
    <h1>Your visa readiness result</h1>
    <p class="sub">Recorded <strong>{{ $score->created_at->format('M j, Y · H:i') }}</strong>
        @if($score->destination_label)
            <br><span style="color:var(--muted);">Applying to: <strong>{{ $score->destination_label }}</strong></span>
        @endif
    </p>

    <div style="padding:14px 16px; border-radius:12px; margin-bottom:20px; background:linear-gradient(135deg, rgba(74,124,107,0.12), rgba(200,168,75,0.08)); border:1px solid rgba(74,124,107,0.2); font-size:0.9rem; line-height:1.5;">
        <strong>How we score this:</strong> Academic 25%, financial 25%, language 20%, documentation 20%, interview 10%. It is all rule-based (no mystery AI). The tips below are general ideas officers often care about; they are not legal advice, so double-check the official site for your country.
    </div>

    @php
        $official = $score->destination_country ? (\App\Services\VisaContextualAdvice::officialLinks()[$score->destination_country] ?? null) : null;
    @endphp
    @if($official)
        <p class="sub" style="margin-top:-8px; margin-bottom:16px;">
            <a href="{{ $official['url'] }}" target="_blank" rel="noopener noreferrer">{{ $official['label'] }}</a>
        </p>
    @endif

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap:12px; margin-bottom:20px;">
        @php $dims = [
            ['k' => 'education_score', 'label' => 'Academic', 'w' => '25%', 'c' => '#3b82f6'],
            ['k' => 'financial_score', 'label' => 'Financial', 'w' => '25%', 'c' => '#22c55e'],
            ['k' => 'language_score', 'label' => 'Language', 'w' => '20%', 'c' => '#a855f7'],
            ['k' => 'documentation_score', 'label' => 'Documents', 'w' => '20%', 'c' => '#f59e0b'],
            ['k' => 'interview_score', 'label' => 'Interview', 'w' => '10%', 'c' => '#e07a5f'],
        ]; @endphp
        @foreach($dims as $d)
            <div style="text-align:center; padding:14px 10px; border-radius:12px; background:#fff; border:1px solid rgba(0,0,0,0.06); box-shadow:0 2px 8px rgba(0,0,0,0.04); color:inherit;">
                <div style="font-size:0.72rem; font-weight:700; text-transform:uppercase; letter-spacing:0.04em; color:{{ $d['c'] }};">{{ $d['label'] }}</div>
                <div style="font-weight:800; font-size:1.5rem; margin:6px 0 2px;">{{ $score->{$d['k']} ?? 0 }}</div>
                <div style="font-size:0.7rem; color:var(--muted);">{{ $d['w'] }} weight</div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('scores.index') }}" style="display:block; background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: #fff; padding: 28px 22px; border-radius: 16px; margin-bottom: 22px; text-align: center; box-shadow: 0 12px 40px rgba(15,23,42,0.35); text-decoration:none; transition: transform .18s, box-shadow .2s;">
        <div style="font-size: 3rem; font-weight: 800; line-height:1; letter-spacing:-0.03em;">{{ $score->total_score }}</div>
        <div style="font-size: 0.95rem; opacity: 0.85; margin-top: 6px;">Overall visa readiness</div>
        <div style="margin-top: 14px; display: inline-block; padding: 8px 18px; border-radius: 999px; font-size: 0.88rem; font-weight: 700;
            @if($score->total_score >= 75) background: rgba(34,197,94,0.25); color: #86efac;
            @elseif($score->total_score >= 50) background: rgba(234,179,8,0.25); color: #fde047;
            @else background: rgba(248,113,113,0.2); color: #fecaca;
            @endif
        ">{{ $score->band }}</div>
        <div style="font-size:0.78rem; opacity:0.75; margin-top:12px;">All assessments →</div>
    </a>

    @php
        $tips = $score->contextual_tips;
        $requirements = $score->requirements;
    @endphp
    @if(count($tips) > 0)
        <h2 style="font-family:var(--font-serif, Georgia, serif); font-size:1.15rem; margin:0 0 8px;">Personalised areas to strengthen</h2>
        <p class="sub" style="margin-bottom:14px;">Based on what you told us and where you want to study. Pick the tips that match your situation.</p>
        <ul style="list-style:none; padding:0; margin:0 0 22px;">
            @foreach($tips as $tip)
                <li style="background: linear-gradient(135deg, #f8fafc 0%, #fff 100%); border: 1px solid rgba(59,130,246,0.2); border-left: 4px solid #3b82f6; border-radius: 12px; padding: 14px 16px; margin-bottom: 10px;">
                    <strong>{{ $tip['title'] }}</strong>
                    @if(($tip['priority'] ?? '') === 'high')
                        <span style="font-size:0.72rem; font-weight:700; text-transform:uppercase; margin-left:8px; padding:2px 8px; border-radius:999px; background:rgba(239,68,68,0.15); color:#b91c1c;">Priority</span>
                    @endif
                    <div style="font-size:0.9rem; color: var(--muted); line-height:1.55; margin-top:8px;">{!! \Illuminate\Support\Str::markdown($tip['body']) !!}</div>
                </li>
            @endforeach
        </ul>
    @endif

    @if(count($requirements) > 0)
        <h2 style="font-family:var(--font-serif, Georgia, serif); font-size:1.15rem; margin:0 0 8px;">Where you can improve (scores)</h2>
        <p class="sub" style="margin-bottom:14px;">Fix these areas first if you can. Small improvements still help.</p>
        <ul style="list-style:none; padding:0; margin:0;">
            @foreach($requirements as $req)
                <li style="background: linear-gradient(135deg, #fff 0%, #fafafa 100%); border: 1px solid rgba(0,0,0,0.08); border-left: 4px solid var(--coral, #e07a5f); border-radius: 12px; padding: 14px 16px; margin-bottom: 10px;">
                    <strong>{{ $req['dimension'] }}</strong> <span style="color:var(--muted); font-size:0.88rem;">(score {{ $req['score'] }})</span><br>
                    <span style="font-size:0.9rem; color: var(--muted); line-height:1.5;">{{ $req['tip'] }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert--success" style="margin-top:4px;">
            All dimensions are at or above 75. Nice work. Keep your documents up to date.
        </div>
    @endif

    <div class="toplinks" style="margin-top:22px;">
        <a href="{{ route('scores.index') }}">All scores</a>
        <a href="{{ route('scores.assess') }}">New assessment</a>
    </div>
@endsection
