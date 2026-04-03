@extends('layout.header')

@section('title', ($profile->user->name ?? 'Counsellor') . ' | Profile | EduBridge')

@section('content')
@php
  $u = $profile->user;
  $parts = preg_split('/\s+/', trim($u->name ?? 'Counsellor'));
  $initials = '';
  foreach (array_slice($parts, 0, 2) as $p) {
    $initials .= mb_strtoupper(mb_substr($p, 0, 1));
  }
  $initials = mb_substr($initials ?: 'CO', 0, 2);
@endphp

<style>
  .cp-wrap { max-width: 920px; margin: 0 auto; padding: 88px 24px 72px; }
  .cp-hero {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    background: linear-gradient(135deg, #0d1117 0%, #1e3a2f 50%, #0f172a 100%);
    color: #fff;
    padding: 36px 32px 32px;
    margin-bottom: 28px;
    box-shadow: 0 24px 60px rgba(13,17,23,0.28);
  }
  .cp-hero::before {
    content: '';
    position: absolute;
    right: -60px; top: -60px;
    width: 280px; height: 280px;
    background: radial-gradient(circle, rgba(200,168,75,0.35) 0%, transparent 65%);
    pointer-events: none;
  }
  .cp-hero-inner { position: relative; z-index: 1; display: flex; flex-wrap: wrap; gap: 24px; align-items: flex-start; }
  .cp-avatar {
    width: 96px; height: 96px;
    border-radius: 20px;
    background: linear-gradient(135deg, #4a7c6b, #2d5a4a);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.75rem; font-weight: 800;
    letter-spacing: 0.02em;
    flex-shrink: 0;
    border: 3px solid rgba(255,255,255,0.2);
  }
  .cp-hero h1 {
    font-family: var(--font-serif, Georgia, serif);
    font-size: clamp(1.5rem, 4vw, 2rem);
    margin: 0 0 8px;
    font-weight: 700;
    letter-spacing: -0.02em;
  }
  .cp-org { font-size: 1.05rem; opacity: 0.9; margin: 0 0 14px; }
  .cp-meta { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
  .cp-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 12px; border-radius: 999px;
    font-size: 0.72rem; font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase;
    background: rgba(74,124,107,0.35);
    border: 1px solid rgba(255,255,255,0.25);
      color: #b8e6d4;
  }
  .cp-pill { font-size: 0.85rem; opacity: 0.88; }
  .cp-actions { margin-top: 22px; display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
  .cp-btn-primary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 22px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #e8d49a, #c8a84b);
    color: #1a1508;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    text-decoration: none;
  }
  .cp-btn-outline {
    display: inline-flex;
    padding: 12px 20px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.35);
    color: #fff;
    font-weight: 600;
    font-size: 0.88rem;
    text-decoration: none;
    background: rgba(255,255,255,0.06);
  }
  .cp-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
  @media (max-width: 720px) { .cp-grid { grid-template-columns: 1fr; } }
  .cp-card {
    background: var(--white);
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 16px;
    padding: 22px 22px 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  }
  .cp-card h2 {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted);
    margin: 0 0 12px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .cp-bio { font-size: 0.98rem; line-height: 1.7; color: var(--ink); margin: 0; }
  .cp-tags { display: flex; flex-wrap: wrap; gap: 8px; }
  .cp-tag {
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 0.82rem;
    font-weight: 600;
    background: rgba(74,124,107,0.12);
    color: var(--sage);
    border: 1px solid rgba(74,124,107,0.2);
  }
  .cp-tag--gold { background: rgba(200,168,75,0.15); color: #8a7420; border-color: rgba(200,168,75,0.3); }
  .cp-tag--sky { background: rgba(59,130,246,0.1); color: #1d4ed8; border-color: rgba(59,130,246,0.2); }
  .cp-detail-row { font-size: 0.92rem; margin-bottom: 10px; display: flex; gap: 8px; flex-wrap: wrap; }
  .cp-detail-row strong { color: var(--ink); min-width: 110px; }
  .cp-detail-row a { color: var(--sage); font-weight: 600; }
  .cp-alert { margin-bottom: 20px; padding: 14px 18px; border-radius: 12px; font-size: 0.9rem; }
  .cp-alert--ok { background: rgba(74,124,107,0.12); border: 1px solid rgba(74,124,107,0.3); color: var(--sage); }
  .cp-alert--err { background: rgba(220,38,38,0.08); border: 1px solid rgba(220,38,38,0.25); color: var(--danger); }
</style>

<div class="cp-wrap">
  <header class="cp-hero">
    <div class="cp-hero-inner">
      <div class="cp-avatar" aria-hidden="true">{{ $initials }}</div>
      <div style="flex:1; min-width:0;">
        <h1>{{ $u->name }}</h1>
        <p class="cp-org">{{ $profile->organization_name }}</p>
        <div class="cp-meta">
          <span class="cp-badge">✓ EduBridge verified</span>
          </div>
        <div class="cp-meta" style="margin-top:10px;">
          <span class="cp-pill">📍 {{ $profile->city ?: 'Location not specified' }}</span>
          <span class="cp-pill">⏱ {{ $profile->experience_years }}+ years experience</span>
          </div>
        <div class="cp-actions">
          @auth
            @if(auth()->user()->isStudent())
              @if(auth()->user()->assigned_counsellor_profile_id == $profile->id)
                <span style="padding:12px 20px;background:rgba(255,255,255,0.15);border-radius:10px;font-weight:600;font-size:0.88rem;">You are connected</span>
              @else
                <form method="POST" action="{{ route('counsellors.attach', $profile) }}" style="display:inline;">
                  @csrf
                  <button type="submit" class="cp-btn-primary">Connect with this counsellor</button>
                </form>
              @endif
            @else
              <span class="cp-pill">Log in as a student to connect</span>
            @endif
          @else
            <a href="{{ route('login') }}" class="cp-btn-primary">Login to connect</a>
          @endauth
          <a href="{{ route('counsellors.index') }}" class="cp-btn-outline">All counsellors</a>
        </div>
      </div>
    </div>
  </header>

  <div class="cp-grid">
    <div class="cp-card" style="grid-column: 1 / -1;">
      <h2>📝 About</h2>
      @if($profile->bio)
        <p class="cp-bio">{{ $profile->bio }}</p>
      @else
        <p class="cp-bio" style="color:var(--muted);">This counsellor is verified on EduBridge. Connect to discuss your goals, documents, and destination.</p>
      @endif
    </div>

    <div class="cp-card">
      <h2>🎯 Focus & specializations</h2>
      @if(count($profile->specializationTags()) > 0)
        <div class="cp-tags">
          @foreach($profile->specializationTags() as $tag)
            <span class="cp-tag">{{ $tag }}</span>
          @endforeach
        </div>
      @else
        <p style="margin:0; color:var(--muted); font-size:0.92rem;">General study-abroad guidance and application support.</p>
      @endif
    </div>

    <div class="cp-card">
      <h2>🌍 Destinations & languages</h2>
      @if(count($profile->countryTags()) > 0)
        <p style="margin:0 0 10px; font-size:0.88rem; color:var(--muted); font-weight:600;">Countries / regions</p>
        <div class="cp-tags" style="margin-bottom:14px;">
          @foreach($profile->countryTags() as $c)
            <span class="cp-tag cp-tag--sky">{{ $c }}</span>
          @endforeach
        </div>
      @endif
      @if(count($profile->languageTags()) > 0)
        <p style="margin:0 0 10px; font-size:0.88rem; color:var(--muted); font-weight:600;">Languages</p>
        <div class="cp-tags">
          @foreach($profile->languageTags() as $lang)
            <span class="cp-tag cp-tag--gold">{{ $lang }}</span>
          @endforeach
        </div>
      @else
        <p style="margin:0; color:var(--muted); font-size:0.92rem;">Ask about language support when you connect.</p>
      @endif
    </div>

    <div class="cp-card">
      <h2>📇 Contact & organisation</h2>
      <div class="cp-detail-row"><strong>Organisation</strong> <span>{{ $profile->organization_name }}</span></div>
      @if($profile->city)
        <div class="cp-detail-row"><strong>City / region</strong> <span>{{ $profile->city }}</span></div>
      @endif
      @if($profile->phone)
        <div class="cp-detail-row"><strong>Phone</strong> <span>{{ $profile->phone }}</span></div>
      @endif
      @if($profile->website)
        @php
          $w = $profile->website;
          $webHref = $w ? (preg_match('#^https?://#i', $w) ? $w : 'https://' . $w) : '#';
        @endphp
        <div class="cp-detail-row"><strong>Website</strong> <a href="{{ $webHref }}" target="_blank" rel="noopener noreferrer">{{ $profile->website }}</a></div>
      @endif
      <div class="cp-detail-row"><strong>Email</strong> <span style="color:var(--muted); font-size:0.88rem;">Available after you connect</span></div>
      <div class="cp-detail-row"><strong>On EduBridge since</strong> <span>{{ $profile->created_at->format('F Y') }}</span></div>
    </div>

    <div class="cp-card">
      <h2>✅ Why verified</h2>
      <p style="margin:0; font-size:0.92rem; line-height:1.65; color:var(--muted);">
        EduBridge reviews counsellor credentials before they appear here. Compare profiles, read focus areas, then connect with someone who fits your destination and study level.
      </p>
    </div>
  </div>
</div>
@endsection
