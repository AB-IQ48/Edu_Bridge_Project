@extends('layout.auth')

@section('title', 'Visa score')

@section('content')
    <h1>Visa readiness score</h1>
    <p class="sub">Recorded {{ $score->created_at->format('M j, Y H:i') }}</p>
    <p class="hint" style="margin-bottom: 16px; padding: 10px 12px; background: rgba(74,124,107,0.08); border-radius: 8px; border-left: 3px solid var(--sage);">
        <strong>Interpretable, rule-based model:</strong> This score is calculated from documented weights (Academic 25%, Financial 25%, Language 20%, Documentation 20%, Interview 10%). No opaque AI — every point is explainable.
    </p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap:12px; margin-bottom:20px;">
        <div style="background: var(--cream); padding:12px; border-radius:8px; text-align:center;">
            <div style="font-size:0.75rem; color: var(--muted);">Academic</div>
            <div style="font-weight:700; font-size:1.25rem;">{{ $score->education_score }}</div>
            <div style="font-size:0.7rem;">25%</div>
        </div>
        <div style="background: var(--cream); padding:12px; border-radius:8px; text-align:center;">
            <div style="font-size:0.75rem; color: var(--muted);">Financial</div>
            <div style="font-weight:700; font-size:1.25rem;">{{ $score->financial_score }}</div>
            <div style="font-size:0.7rem;">25%</div>
        </div>
        <div style="background: var(--cream); padding:12px; border-radius:8px; text-align:center;">
            <div style="font-size:0.75rem; color: var(--muted);">Language</div>
            <div style="font-weight:700; font-size:1.25rem;">{{ $score->language_score ?? 0 }}</div>
            <div style="font-size:0.7rem;">20%</div>
        </div>
        <div style="background: var(--cream); padding:12px; border-radius:8px; text-align:center;">
            <div style="font-size:0.75rem; color: var(--muted);">Documents</div>
            <div style="font-weight:700; font-size:1.25rem;">{{ $score->documentation_score }}</div>
            <div style="font-size:0.7rem;">20%</div>
        </div>
        <div style="background: var(--cream); padding:12px; border-radius:8px; text-align:center;">
            <div style="font-size:0.75rem; color: var(--muted);">Interview</div>
            <div style="font-weight:700; font-size:1.25rem;">{{ $score->interview_score ?? 0 }}</div>
            <div style="font-size:0.7rem;">10%</div>
        </div>
    </div>

    <div style="background: #0d1117; color: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
        <div style="font-size: 2.5rem; font-weight: 700;">{{ $score->total_score }}</div>
        <div style="font-size: 0.9rem; opacity: 0.8;">Overall visa readiness</div>
        <div style="margin-top: 8px; display: inline-block; padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;
            @if($score->total_score >= 75) background: rgba(74,124,107,0.3); color: #7ab3a0;
            @elseif($score->total_score >= 50) background: rgba(200,168,75,0.3); color: #e8d49a;
            @else background: rgba(220,38,38,0.2); color: #f87171;
            @endif
        ">{{ $score->band }}</div>
    </div>

    @php $requirements = $score->requirements; @endphp
    @if(count($requirements) > 0)
        <h2 style="font-size:1.1rem; margin-bottom:12px;">Where you're required</h2>
        <p class="sub" style="margin-bottom:16px;">Focus on these areas to improve your visa readiness.</p>
        <ul style="list-style:none; padding:0;">
            @foreach($requirements as $req)
                <li style="background: #fff; border: 1px solid rgba(0,0,0,0.08); border-radius: 8px; padding: 14px 16px; margin-bottom: 10px;">
                    <strong>{{ $req['dimension'] }}</strong> (score: {{ $req['score'] }})<br>
                    <span style="font-size:0.9rem; color: var(--muted);">{{ $req['tip'] }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <p style="background: rgba(74,124,107,0.12); color: var(--sage); padding: 12px; border-radius: 8px;">All dimensions are at or above 75. You're in good shape for visa readiness.</p>
    @endif

    <div class="toplinks" style="margin-top:24px">
        <a href="{{ route('scores.index') }}">Back to my scores</a>
        <a href="{{ route('scores.create') }}">Calculate new score</a>
    </div>
@endsection
