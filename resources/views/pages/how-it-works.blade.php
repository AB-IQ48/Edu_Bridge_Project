@extends('layout.header')

@section('title', 'How It Works — EduBridge')

@section('content')
<section class="how-it-works">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">01</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Process</span>
    </div>
    <h2 class="section-title">How EduBridge works</h2>
    <p class="section-sub">A structured four-step workflow that protects students and ensures only qualified, verified counsellors operate on our platform.</p>
  </div>
  <div style="max-width:1200px;margin:0 auto;padding:0 32px">
    <div class="steps-grid">
      <div class="step">
        <div class="step-num">01</div>
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
        </div>
        <h3>Counsellor Registration & ID Verification</h3>
        <p>Consultants submit credentials, government-issued ID, and professional licences. Our multi-layer verification workflow validates authenticity before any profile goes live.</p>
      </div>
      <div class="step">
        <div class="step-num">02</div>
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
        <h3>Secure Document Submission</h3>
        <p>Students upload transcripts, financial proofs, and language test scores to encrypted, role-gated storage. Only assigned, verified counsellors can access your documents.</p>
      </div>
      <div class="step">
        <div class="step-num">03</div>
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
        </div>
        <h3>Visa Readiness Score Assessment</h3>
        <p>Our rule-based eligibility engine analyses your academic profile, finances, language scores, and destination requirements to generate a transparent, explainable readiness score.</p>
      </div>
      <div class="step">
        <div class="step-num">04</div>
        <div class="step-icon">
          <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h3>Matched & Monitored Guidance</h3>
        <p>Connect with counsellors whose verified specialisations match your destination and field. All advice is logged, reviewable, and tied to real accountability metrics.</p>
      </div>
    </div>
  </div>
</section>

<section class="cta-section">
  <div class="container">
    <h2>Ready to get started?</h2>
    <p>Join thousands of students who chose verification over risk.</p>
    <div class="cta-actions">
      <a href="{{ route('login') }}" class="cta-btn-white">Login</a>
      <a href="{{ route('register.student') }}" class="cta-btn-outline">Register as Student</a>
    </div>
  </div>
</section>
@endsection
