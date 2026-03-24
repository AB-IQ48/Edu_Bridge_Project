@extends('layout.header')

@section('title', 'Student Dashboard — EduBridge')

@section('content')
<style>
  /* Student dashboard: animations & layout */
  .sd-wrap {
    max-width: 1000px;
    margin: 0 auto;
    padding: 32px 24px 64px;
  }
  .sd-hero {
    margin-bottom: 36px;
    animation: sdFadeInUp 0.6s ease-out;
  }
  .sd-hero h1 {
    font-size: clamp(1.5rem, 4vw, 1.85rem);
    font-weight: 700;
    color: var(--ink);
    margin: 0 0 6px;
    letter-spacing: -0.02em;
  }
  .sd-hero .sd-tagline {
    color: var(--muted);
    font-size: 1rem;
    margin: 0;
  }
  .sd-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 16px;
    margin-bottom: 32px;
  }
  .sd-stat {
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 12px;
    padding: 18px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    animation: sdFadeInUp 0.5s ease-out backwards;
  }
  .sd-stat:nth-child(1) { animation-delay: 0.1s; }
  .sd-stat:nth-child(2) { animation-delay: 0.18s; }
  .sd-stat:nth-child(3) { animation-delay: 0.26s; }
  .sd-stat:nth-child(4) { animation-delay: 0.34s; }
  .sd-stat:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
  }
  .sd-stat-num {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--sage);
    line-height: 1.2;
  }
  .sd-stat-label {
    font-size: 0.8rem;
    color: var(--muted);
    margin-top: 4px;
  }
  .sd-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    margin-bottom: 36px;
  }
  .sd-card {
    display: block;
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 14px;
    padding: 24px;
    text-decoration: none;
    color: var(--ink);
    box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    animation: sdFadeInUp 0.55s ease-out backwards;
  }
  .sd-card:nth-child(1) { animation-delay: 0.15s; }
  .sd-card:nth-child(2) { animation-delay: 0.25s; }
  .sd-card:nth-child(3) { animation-delay: 0.35s; }
  .sd-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.1);
    border-color: rgba(74,124,107,0.35);
  }
  .sd-card-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    margin-bottom: 14px;
    background: rgba(74,124,107,0.12);
    color: var(--sage);
  }
  .sd-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 6px;
  }
  .sd-card p {
    font-size: 0.9rem;
    color: var(--muted);
    margin: 0;
    line-height: 1.4;
  }
  .sd-card .sd-card-cta {
    margin-top: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--sage);
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .sd-card .sd-card-cta::after {
    content: '→';
    transition: transform 0.2s ease;
  }
  .sd-card:hover .sd-card-cta::after { transform: translateX(4px); }
  .sd-section-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--ink);
    margin: 0 0 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .sd-quick-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 32px;
    animation: sdFadeIn 0.5s ease-out 0.4s backwards;
  }
  .sd-quick-actions a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: 8px;
    color: var(--ink);
    font-size: 0.9rem;
    font-weight: 500;
    text-decoration: none;
    transition: background 0.2s, border-color 0.2s, transform 0.2s;
  }
  .sd-quick-actions a:hover {
    background: rgba(74,124,107,0.08);
    border-color: rgba(74,124,107,0.3);
    transform: translateY(-1px);
  }
  .sd-quick-actions a.primary {
    background: var(--ink);
    color: var(--white);
    border-color: var(--ink);
  }
  .sd-quick-actions a.primary:hover {
    background: var(--sage);
    border-color: var(--sage);
  }
  .sd-scores-list {
    list-style: none;
    margin: 0 0 32px;
    padding: 0;
  }
  .sd-scores-list li {
    margin-bottom: 10px;
    animation: sdFadeInUp 0.4s ease-out backwards;
  }
  .sd-scores-list li:nth-child(1) { animation-delay: 0.2s; }
  .sd-scores-list li:nth-child(2) { animation-delay: 0.28s; }
  .sd-scores-list li:nth-child(3) { animation-delay: 0.36s; }
  .sd-scores-list li:nth-child(4) { animation-delay: 0.44s; }
  .sd-scores-list li:nth-child(5) { animation-delay: 0.52s; }
  .sd-score-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    padding: 14px 18px;
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 10px;
    text-decoration: none;
    color: var(--ink);
    transition: transform 0.2s, box-shadow 0.2s;
  }
  .sd-score-item:hover {
    transform: translateX(4px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.06);
  }
  .sd-score-item strong { font-size: 1rem; }
  .sd-score-meta {
    font-size: 0.85rem;
    color: var(--muted);
  }
  .sd-score-band {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 6px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .sd-score-band.ready { background: rgba(74,124,107,0.15); color: #2d5a4a; }
  .sd-score-band.conditional { background: rgba(200,168,75,0.2); color: #8a7420; }
  .sd-score-band.not-ready { background: rgba(220,38,38,0.1); color: #b91c1c; }
  .sd-tips {
    background: linear-gradient(135deg, rgba(74,124,107,0.08) 0%, rgba(74,124,107,0.03) 100%);
    border: 1px solid rgba(74,124,107,0.2);
    border-radius: 14px;
    padding: 24px;
    margin-bottom: 32px;
    animation: sdFadeIn 0.5s ease-out 0.5s backwards;
  }
  .sd-tips h3 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--ink);
    margin: 0 0 14px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .sd-tips ul {
    margin: 0;
    padding-left: 20px;
    color: var(--ink-soft, #1e2530);
    font-size: 0.92rem;
    line-height: 1.65;
  }
  .sd-tips li { margin-bottom: 6px; }
  .sd-footer-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 16px;
    padding-top: 20px;
    border-top: 1px solid rgba(0,0,0,0.08);
    animation: sdFadeIn 0.4s ease-out 0.6s backwards;
  }
  .sd-footer-actions a {
    color: var(--sage);
    font-weight: 500;
    text-decoration: none;
  }
  .sd-footer-actions a:hover { text-decoration: underline; }
  .sd-footer-actions form { display: inline; }
  .sd-footer-actions .btn-logout {
    padding: 8px 16px;
    background: transparent;
    border: 1px solid rgba(0,0,0,0.15);
    border-radius: 8px;
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
  @keyframes sdFadeInUp {
    from { opacity: 0; transform: translateY(16px); }
    to { opacity: 1; transform: translateY(0); }
  }
  @keyframes sdFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
  }
  .sd-empty {
    padding: 20px;
    text-align: center;
    color: var(--muted);
    font-size: 0.95rem;
    background: var(--white);
    border: 1px dashed rgba(0,0,0,0.12);
    border-radius: 10px;
  }
  .sd-counsellor-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(74,124,107,0.12);
    color: var(--sage);
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-top: 8px;
  }
</style>

<div class="sd-wrap">
  <header class="sd-hero">
    <h1>Hi, {{ auth()->user()->name }} 👋</h1>
    <p class="sd-tagline">Your study-abroad hub — documents, visa readiness, and verified counsellors in one place.</p>
  </header>

  <div class="sd-stats">
    <div class="sd-stat">
      <div class="sd-stat-num">{{ $documentCount }}</div>
      <div class="sd-stat-label">Documents</div>
    </div>
    <div class="sd-stat">
      <div class="sd-stat-num">{{ $latestScore ? $latestScore->total_score : '—' }}</div>
      <div class="sd-stat-label">Latest score</div>
    </div>
    <div class="sd-stat">
      <div class="sd-stat-num">{{ $scores->total() }}</div>
      <div class="sd-stat-label">Assessments</div>
    </div>
    <div class="sd-stat">
      <div class="sd-stat-num">{{ $assignedCounsellor ? '1' : '0' }}</div>
      <div class="sd-stat-label">Counsellor</div>
    </div>
  </div>

  <div class="sd-cards">
    <a href="{{ route('student.documents.index') }}" class="sd-card">
      <div class="sd-card-icon">📄</div>
      <h3>My documents</h3>
      <p>Upload transcripts, financial proof, passport copies, and keep everything in one secure place.</p>
      <span class="sd-card-cta">View & upload</span>
    </a>
    <a href="{{ route('scores.index') }}" class="sd-card">
      <div class="sd-card-icon">📊</div>
      <h3>Visa readiness</h3>
      <p>See your rule-based visa score and get clear guidance on where you need to improve.</p>
      <span class="sd-card-cta">Check score</span>
    </a>
    <a href="{{ route('counsellors.index') }}" class="sd-card">
      <div class="sd-card-icon">🤝</div>
      <h3>Find a counsellor</h3>
      <p>Connect with verified education counsellors who have been reviewed and approved by EduBridge.</p>
      @if($assignedCounsellor)
        <span class="sd-counsellor-badge">✓ {{ $assignedCounsellor->user->name ?? 'Connected' }}</span>
      @else
        <span class="sd-card-cta">Browse counsellors</span>
      @endif
    </a>
  </div>

  <h2 class="sd-section-title">Quick actions</h2>
  <div class="sd-quick-actions">
    <a href="{{ route('scores.assess') }}" class="primary">Visa assessment (questions)</a>
    <a href="{{ route('scores.create') }}">Quick score (enter numbers)</a>
    <a href="{{ route('student.documents.create') }}">Upload document</a>
    <a href="{{ route('student.profile') }}">Profile</a>
  </div>

  <h2 class="sd-section-title">Recent scores</h2>
  @if($scores->count() > 0)
    <ul class="sd-scores-list">
      @foreach($scores as $s)
        <li>
          <a href="{{ route('scores.show', $s) }}" class="sd-score-item">
            <div>
              <strong>Score {{ $s->total_score }}</strong>
              <span class="sd-score-meta"> — {{ $s->created_at->format('M j, Y') }}</span>
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
            <span class="sd-score-band {{ $bandClass }}">{{ $s->band ?? '—' }}</span>
          </a>
        </li>
      @endforeach
    </ul>
    @if($scores->hasPages())
      <p style="font-size:0.9rem; color: var(--muted); margin-top: 8px;">Showing latest {{ $scores->count() }} of {{ $scores->total() }}.</p>
    @endif
  @else
    <div class="sd-empty">
      No assessments yet. <a href="{{ route('scores.assess') }}" style="color: var(--sage); font-weight: 600;">Take the visa readiness assessment</a> to get your first score and see where you stand.
    </div>
  @endif

  <section class="sd-tips">
    <h3>💡 Your journey</h3>
    <ul>
      <li><strong>Gather documents</strong> — transcripts, financial proof, and ID. Upload them here so you and your counsellor can track progress.</li>
      <li><strong>Run the visa readiness tool</strong> — our rule-based score shows exactly which areas (academic, financial, language, docs, interview) need work.</li>
      <li><strong>Connect with a verified counsellor</strong> — get guidance from EduBridge-approved advisors and reduce the risk of fraud.</li>
    </ul>
  </section>

  <div class="sd-footer-actions">
    <a href="{{ url('/') }}">Home</a>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="btn-logout">Log out</button></form>
  </div>
</div>
@endsection
