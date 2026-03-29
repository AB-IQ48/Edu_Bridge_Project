@extends('layout.panel')

@section('title', 'Visa scores')

@section('card_class', 'card--wide')

@section('auth_content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Your history</p>
    <h1>Visa readiness scores</h1>
    <p class="sub">Every entry below is a saved assessment. Open one to see bands, weights, and <strong>where you need to improve</strong>.</p>

    <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px;">
        <a href="{{ route('scores.assess') }}" class="btn btn--sage" style="width:auto; padding:10px 18px; font-size:0.88rem;">+ New assessment</a>
    </div>

    <ul style="list-style:none; padding:0; margin:0;">
        @forelse($scores as $s)
            <li style="margin-bottom:12px;">
                <a href="{{ route('scores.show', $s) }}" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; padding:16px 18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:linear-gradient(135deg,#fff 0%,#fafbfa 100%); text-decoration:none; color:inherit; box-shadow:0 2px 8px rgba(0,0,0,0.04); transition: transform .2s, box-shadow .2s;">
                    <div>
                        <strong style="font-size:1.1rem; color:var(--sage);">Total {{ $s->total_score }}</strong>
                        <span style="color:var(--muted); font-size:0.88rem;"> · {{ $s->created_at->format('M j, Y') }}</span>
                        <div style="font-size:0.8rem; color:var(--muted); margin-top:4px;">
                            A {{ $s->education_score }} · F {{ $s->financial_score }} · L {{ $s->language_score ?? 0 }} · Doc {{ $s->documentation_score }} · Int {{ $s->interview_score ?? 0 }}
                        </div>
                    </div>
                    <span style="font-size:0.75rem; font-weight:700; text-transform:uppercase; padding:6px 12px; border-radius:999px; background:rgba(74,124,107,0.12); color:#2d5a4a;">View →</span>
                </a>
            </li>
        @empty
            <li style="text-align:center; padding:36px 20px; border-radius:14px; border:2px dashed rgba(0,0,0,0.12); background:rgba(255,255,255,0.6);">
                <p style="margin:0 0 12px; color:var(--muted);">No scores yet. Start with the assessment below.</p>
                <a href="{{ route('scores.assess') }}" class="btn btn--sage" style="width:auto; display:inline-flex; padding:12px 22px;">Take the assessment</a>
            </li>
        @endforelse
    </ul>

    @if($scores->hasPages())
        <div style="margin-top: 16px;">
            {{ $scores->links() }}
        </div>
    @endif

    <div class="toplinks">
        <a href="{{ route('student.index') }}">Student dashboard</a>
    </div>
@endsection
