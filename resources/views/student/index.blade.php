@extends('layout.header')

@section('title', 'Student Dashboard | EduBridge')

@section('content')
<style>
  .sd-page {
    background:
      radial-gradient(900px 400px at 0% 0%, rgba(74,124,107,0.14), transparent 55%),
      radial-gradient(700px 350px at 100% 10%, rgba(200,168,75,0.12), transparent 50%),
      linear-gradient(180deg, #f0ebe3 0%, var(--cream) 35%, #eef4f0 100%);
    padding-bottom: 64px;
  }
  .sd-wrap {
    max-width: 1040px;
    margin: 0 auto;
    padding: 28px 20px 0;
  }
  .sd-hero {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    padding: 32px 28px 36px;
    margin-bottom: 28px;
    background: linear-gradient(125deg, #0d1117 0%, #1e3a2f 45%, #0f172a 100%);
    color: #fff;
    box-shadow: 0 20px 50px rgba(13,17,23,0.25);
    animation: sdFadeInUp 0.55s ease-out;
  }
  .sd-hero::after {
    content: '';
    position: absolute;
    right: -40px;
    top: -40px;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle, rgba(200,168,75,0.35) 0%, transparent 70%);
    pointer-events: none;
  }
  .sd-hero-inner { position: relative; z-index: 1; max-width: 640px; }
  .sd-hero h1 {
    font-family: var(--font-serif, Georgia, serif);
    font-size: clamp(1.55rem, 4vw, 2rem);
    font-weight: 700;
    margin: 0 0 10px;
    letter-spacing: -0.02em;
    line-height: 1.2;
  }
  .sd-hero .sd-tagline {
    margin: 0;
    font-size: 1.02rem;
    opacity: 0.88;
    line-height: 1.55;
  }
  .sd-hero-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 18px;
  }
  .sd-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 600;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.15);
  }
  .sd-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 14px;
    margin-bottom: 28px;
  }
  .sd-stat {
    border-radius: 16px;
    padding: 18px 16px;
    text-align: left;
    color: #fff;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    animation: sdFadeInUp 0.5s ease-out backwards;
  }
  .sd-stat:nth-child(1) { animation-delay: 0.08s; background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
  .sd-stat:nth-child(2) { animation-delay: 0.14s; background: linear-gradient(135deg, #22c55e, #15803d); }
  .sd-stat:nth-child(3) { animation-delay: 0.2s; background: linear-gradient(135deg, #a855f7, #7c3aed); }
  .sd-stat:nth-child(4) { animation-delay: 0.26s; background: linear-gradient(135deg, #f59e0b, #d97706); }
  .sd-stat:hover { transform: translateY(-4px); box-shadow: 0 14px 32px rgba(0,0,0,0.18); }
  .sd-stat-link {
    text-decoration: none;
    color: inherit;
    display: block;
  }
  .sd-stat-num { font-size: 1.85rem; font-weight: 800; line-height: 1.1; letter-spacing: -0.02em; }
  .sd-stat-label { font-size: 0.78rem; opacity: 0.92; margin-top: 6px; font-weight: 600; letter-spacing: 0.02em; }
  .sd-section-title {
    font-family: var(--font-serif, Georgia, serif);
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 14px;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .sd-section-title span { font-size: 1.35rem; }
  .sd-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 18px;
    margin-bottom: 32px;
  }
  .sd-card {
    display: block;
    border-radius: 18px;
    padding: 22px 22px 20px;
    text-decoration: none;
    color: var(--ink);
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.06);
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: sdFadeInUp 0.55s ease-out backwards;
  }
  .sd-card:nth-child(1) { animation-delay: 0.12s; border-top: 4px solid #3b82f6; }
  .sd-card:nth-child(2) { animation-delay: 0.2s; border-top: 4px solid #22c55e; }
  .sd-card:nth-child(3) { animation-delay: 0.28s; border-top: 4px solid #e07a5f; }
  .sd-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.1);
  }
  .sd-card-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    margin-bottom: 12px;
  }
  .sd-card:nth-child(1) .sd-card-icon { background: rgba(59,130,246,0.15); }
  .sd-card:nth-child(2) .sd-card-icon { background: rgba(34,197,94,0.15); }
  .sd-card:nth-child(3) .sd-card-icon { background: rgba(224,122,95,0.15); }
  .sd-card h3 { font-size: 1.08rem; font-weight: 700; margin: 0 0 8px; }
  .sd-card p { font-size: 0.9rem; color: var(--muted); margin: 0; line-height: 1.45; }
  .sd-card .sd-card-cta {
    margin-top: 14px;
    font-size: 0.88rem;
    font-weight: 700;
    color: var(--sage);
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .sd-card .sd-card-cta::after { content: '→'; transition: transform 0.2s ease; }
  .sd-card:hover .sd-card-cta::after { transform: translateX(4px); }
  .sd-quick-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 28px;
  }
  .sd-quick-actions a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 18px;
    border-radius: 999px;
    font-size: 0.88rem;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid rgba(0,0,0,0.1);
    background: var(--white);
    color: var(--ink);
    box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
  }
  .sd-quick-actions a:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border-color: rgba(74,124,107,0.35);
  }
  .sd-quick-actions a.primary {
    background: linear-gradient(135deg, #4a7c6b, #3d6b5c);
    color: #fff;
    border-color: transparent;
  }
  .sd-quick-actions a .sd-badge {
    min-width: 20px;
    height: 20px;
    padding: 0 6px;
    border-radius: 999px;
    background: #dc2626;
    color: #fff;
    font-size: 0.72rem;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
  .sd-scores-list { list-style: none; margin: 0 0 28px; padding: 0; }
  .sd-scores-list li { margin-bottom: 10px; animation: sdFadeInUp 0.4s ease-out backwards; }
  .sd-scores-list li:nth-child(1) { animation-delay: 0.1s; }
  .sd-scores-list li:nth-child(2) { animation-delay: 0.16s; }
  .sd-scores-list li:nth-child(3) { animation-delay: 0.22s; }
  .sd-score-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding: 14px 18px;
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.07);
    border-radius: 14px;
    text-decoration: none;
    color: var(--ink);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .sd-score-item:hover { transform: translateX(4px); box-shadow: 0 6px 20px rgba(0,0,0,0.07); }
  .sd-score-band {
    font-size: 0.72rem;
    font-weight: 700;
    padding: 5px 11px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
  }
  .sd-score-band.ready { background: rgba(74,124,107,0.18); color: #1a5c4a; }
  .sd-score-band.conditional { background: rgba(200,168,75,0.25); color: #7c5d12; }
  .sd-score-band.not-ready { background: rgba(220,38,38,0.12); color: #b91c1c; }
  .sd-tips {
    background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(245,240,232,0.9) 100%);
    border: 1px solid rgba(74,124,107,0.2);
    border-radius: 18px;
    padding: 22px 24px;
    margin-bottom: 28px;
    box-shadow: 0 4px 20px rgba(74,124,107,0.08);
  }
  .sd-tips h3 {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0 0 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .sd-tips ul { margin: 0; padding-left: 20px; color: var(--ink-soft, #1e2530); font-size: 0.92rem; line-height: 1.65; }
  .sd-tips li { margin-bottom: 8px; }
  .sd-footer-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 14px;
    padding-top: 18px;
    border-top: 1px solid rgba(0,0,0,0.08);
  }
  .sd-footer-actions a { color: var(--sage); font-weight: 600; text-decoration: none; }
  .sd-footer-actions a:hover { text-decoration: underline; }
  .sd-footer-actions .btn-logout {
    padding: 8px 16px;
    background: transparent;
    border: 1px solid rgba(0,0,0,0.15);
    border-radius: 10px;
    color: var(--ink);
    font-size: 0.9rem;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
  }
  .sd-footer-actions .btn-logout:hover {
    background: rgba(220,38,38,0.08);
    border-color: rgba(220,38,38,0.3);
    color: var(--danger, #dc2626);
  }
  .sd-empty {
    padding: 28px;
    text-align: center;
    color: var(--muted);
    background: var(--white);
    border: 2px dashed rgba(0,0,0,0.1);
    border-radius: 16px;
  }
  .sd-counsellor-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(74,124,107,0.12);
    color: var(--sage);
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 700;
    margin-top: 10px;
  }
  .sd-chat-note { margin-top: 6px; font-size: 0.85rem; color: var(--muted); }
  @keyframes sdFadeInUp {
    from { opacity: 0; transform: translateY(14px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @media (max-width: 600px) {
    .sd-hero { padding: 24px 20px; }
  }
</style>

<div class="sd-page">
<div class="sd-wrap">
  <header class="sd-hero">
    <div class="sd-hero-inner">
      <h1>Welcome back, {{ auth()->user()->name }} ✨</h1>
      <p class="sd-tagline">One place for your documents, visa scores, and verified counsellors. Everything is laid out simply so you can find what you need fast.</p>
      <div class="sd-hero-badges">
        <span class="sd-pill">📚 Study abroad</span>
        <span class="sd-pill">📊 Rule-based scoring</span>
        <span class="sd-pill">🤝 Verified counsellors</span>
      </div>
    </div>
  </header>

  <div class="sd-stats">
    <a href="{{ route('student.documents.index') }}" class="sd-stat-link" title="Open your documents">
      <div class="sd-stat">
        <div class="sd-stat-num">{{ $documentCount }}</div>
        <div class="sd-stat-label">Documents uploaded</div>
      </div>
    </a>
    <a href="{{ $latestScore ? route('scores.show', $latestScore) : route('scores.assess') }}" class="sd-stat-link" title="Open your latest score">
      <div class="sd-stat">
        <div class="sd-stat-num">{{ $latestScore ? $latestScore->total_score : '-' }}</div>
        <div class="sd-stat-label">Latest visa score</div>
      </div>
    </a>
    <a href="{{ route('scores.index') }}" class="sd-stat-link" title="Open all assessments">
      <div class="sd-stat">
        <div class="sd-stat-num">{{ $scores->total() }}</div>
        <div class="sd-stat-label">Total assessments</div>
      </div>
    </a>
    <a href="{{ $assignedCounsellor ? route('chat.index') : route('counsellors.index') }}" class="sd-stat-link" title="Open counsellor area">
      <div class="sd-stat">
        <div class="sd-stat-num">{{ $assignedCounsellor ? '1' : '0' }}</div>
        <div class="sd-stat-label">Counsellor linked</div>
      </div>
    </a>
  </div>

  <h2 class="sd-section-title"><span>🚀</span>Explore your portal</h2>
  <div class="sd-cards">
    <a href="{{ route('student.documents.index') }}" class="sd-card">
      <div class="sd-card-icon">📄</div>
      <h3>Documents</h3>
      <p>Upload transcripts, bank stuff, passport copies, and keep it tidy for your counsellor and your applications.</p>
      <span class="sd-card-cta">Open documents</span>
    </a>
    <a href="{{ route('scores.index') }}" class="sd-card">
      <div class="sd-card-icon">📊</div>
      <h3>Visa readiness</h3>
      <p>See your scores and which areas need work. The rules are fixed and you can see how they are weighted.</p>
      <span class="sd-card-cta">View scores</span>
    </a>
    <a href="{{ route('counsellors.index') }}" class="sd-card">
      <div class="sd-card-icon">🤝</div>
      <h3>Counsellors</h3>
      <p>Browse verified education counsellors and connect with someone who fits your goals.</p>
      @if($assignedCounsellor)
        <span class="sd-counsellor-badge">✓ {{ $assignedCounsellor->user->name ?? 'Connected' }}</span>
      @else
        <span class="sd-card-cta">Browse list</span>
      @endif
    </a>
  </div>

  <h2 class="sd-section-title"><span>⚡</span>Quick actions</h2>
  <div class="sd-quick-actions">
    <a href="{{ route('scores.assess') }}" class="primary">Visa assessment (questions)</a>
    <a href="{{ route('student.documents.create') }}">Upload document</a>
    <a href="{{ route('student.complaints.create') }}">Make a complaint</a>
    <a href="{{ route('student.profile') }}">Profile hub</a>
    <a href="{{ route('chat.index') }}">Chat
      @if(($unreadChatCount ?? 0) > 0)<span class="sd-badge">{{ $unreadChatCount }}</span>@endif
    </a>
  </div>
  @if(!$assignedCounsellor)
    <p class="sd-chat-note">💬 Connect with a counsellor from the list to unlock chat and guided support.</p>
  @endif

  <h2 class="sd-section-title"><span>📈</span>Recent scores</h2>
  @if($scores->count() > 0)
    <ul class="sd-scores-list">
      @foreach($scores as $s)
        <li>
          <a href="{{ route('scores.show', $s) }}" class="sd-score-item">
            <div>
              <strong>Score {{ $s->total_score }}</strong>
              <span style="color: var(--muted); font-size: 0.88rem;"> · {{ $s->created_at->format('M j, Y') }}</span>
            </div>
            @php
              $bandSlug = strtolower(str_replace(' ', '-', $s->band ?? ''));
              $bandClass = match($bandSlug) {
                'ready' => 'ready',
                'conditionally-ready' => 'conditional',
                'not-yet-ready' => 'not-ready',
                default => 'not-ready',
              };
            @endphp
            <span class="sd-score-band {{ $bandClass }}">{{ $s->band ?? '-' }}</span>
          </a>
        </li>
      @endforeach
    </ul>
    @if($scores->hasPages())
      <p style="font-size:0.88rem; color: var(--muted); margin-top: 8px;">Showing {{ $scores->count() }} of {{ $scores->total() }}.</p>
    @endif
  @else
    <div class="sd-empty">
      <p style="margin:0 0 12px;">No scores yet. Take the full questionnaire once and you will get a breakdown you can work with.</p>
      <a href="{{ route('scores.assess') }}" style="display:inline-block; padding:12px 22px; border-radius:999px; background:linear-gradient(135deg,#4a7c6b,#3d6b5c); color:#fff; font-weight:700; text-decoration:none;">Take the assessment</a>
    </div>
  @endif

  <section class="sd-tips">
    <h3>💡 Your journey</h3>
    <ul>
      <li><strong>Documents first:</strong> upload clear scans so your counsellor can help you sooner.</li>
      <li><strong>Visa readiness:</strong> use the questionnaire to see where you stand and what to fix.</li>
      <li><strong>Stay in touch:</strong> connect with a verified counsellor and use chat when you are stuck.</li>
    </ul>
  </section>

  <div class="sd-footer-actions" style="align-items:center; flex-wrap:wrap;">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ route('dashboard') }}">Account</a>
    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="btn-logout">Log out</button></form>
  </div>
</div>
</div>
@endsection
