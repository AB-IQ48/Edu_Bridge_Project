@extends('layout.header')

@section('title', 'Visa Readiness — EduBridge')

@section('content')
<section class="visa-readiness">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">03</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Eligibility Engine</span>
    </div>
    <h2 class="section-title">Your Visa Readiness Score — explained</h2>
    <p class="section-sub">No black boxes. Our <strong>documented, rule-based</strong> scoring model breaks down exactly why your score is what it is and how to improve it. Interpretability over opaque AI — for accountability and student decision-making.</p>
    <p style="max-width:720px;margin-top:24px;font-size:1rem;color:var(--muted);line-height:1.75">The score is built from five weighted dimensions: academic eligibility (25%), financial proof (25%), language proficiency (20%), document completeness (20%), and interview readiness (10%). Each dimension uses published rules so you can see how every point is calculated and what to do next.</p>
    <div class="visa-grid">
      <div class="visa-factors">
        <div class="factor-card">
          <div class="factor-head">
            <span class="factor-name">Academic Eligibility</span>
            <span class="factor-score high">88/100</span>
          </div>
          <div class="factor-bar"><div class="factor-bar-fill fill-high" style="width:88%"></div></div>
          <div class="factor-note">Strong GPA (3.6/4.0) meets destination university requirements.</div>
        </div>
        <div class="factor-card">
          <div class="factor-head">
            <span class="factor-name">Financial Proof</span>
            <span class="factor-score mid">61/100</span>
          </div>
          <div class="factor-bar"><div class="factor-bar-fill fill-mid" style="width:61%"></div></div>
          <div class="factor-note">Funds cover 14 of 18 required months. Consider adding a co-sponsor.</div>
        </div>
        <div class="factor-card">
          <div class="factor-head">
            <span class="factor-name">Language Proficiency</span>
            <span class="factor-score high">92/100</span>
          </div>
          <div class="factor-bar"><div class="factor-bar-fill fill-high" style="width:92%"></div></div>
          <div class="factor-note">IELTS 7.5 exceeds minimum threshold for all target programmes.</div>
        </div>
        <div class="factor-card">
          <div class="factor-head">
            <span class="factor-name">Document Completeness</span>
            <span class="factor-score low">45/100</span>
          </div>
          <div class="factor-bar"><div class="factor-bar-fill fill-low" style="width:45%"></div></div>
          <div class="factor-note">Police clearance and birth certificate not yet uploaded.</div>
        </div>
        <div class="factor-card">
          <div class="factor-head">
            <span class="factor-name">Interview Readiness</span>
            <span class="factor-score mid">74/100</span>
          </div>
          <div class="factor-bar"><div class="factor-bar-fill fill-mid" style="width:74%"></div></div>
          <div class="factor-note">Practise recommended. Complete counsellor-assigned mock sessions.</div>
        </div>
      </div>
      <div class="visa-info">
        <div class="visa-total">
          <div class="visa-score-big">72</div>
          <div class="visa-score-label">Overall Visa Readiness Score</div>
          <div class="visa-verdict">Conditionally Ready</div>
        </div>
        <div class="visa-tips">
          <div class="tip">
            <svg class="tip-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p>Upload missing documents to increase your score to an estimated <strong>82/100</strong> within 48 hours.</p>
          </div>
          <div class="tip">
            <svg class="tip-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p>Adding a financial co-sponsor document could raise your Financial Proof score by up to 30 points.</p>
          </div>
          <div class="tip">
            <svg class="tip-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p>Your counsellor has flagged 3 actionable steps. Review your session notes.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="trust-section" style="padding:80px 0;background:var(--white)">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">—</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Score bands</span>
    </div>
    <h2 class="section-title" style="font-size:1.75rem">What your score means</h2>
    <p class="section-sub" style="margin-bottom:28px">We use three bands so you know where you stand and what to focus on.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;max-width:900px">
      <div style="background:var(--cream);padding:24px;border-radius:8px;border-left:4px solid var(--sage)">
        <div style="font-weight:600;color:var(--sage);margin-bottom:6px">Ready (75–100)</div>
        <p style="font-size:0.875rem;color:var(--muted);line-height:1.6">Your profile meets typical requirements. Focus on polishing your application and preparing for the interview.</p>
      </div>
      <div style="background:var(--cream);padding:24px;border-radius:8px;border-left:4px solid var(--gold)">
        <div style="font-weight:600;color:var(--gold);margin-bottom:6px">Conditionally ready (50–74)</div>
        <p style="font-size:0.875rem;color:var(--muted);line-height:1.6">One or more areas need work. Follow the tips in your dashboard and upload missing documents or improve weak areas.</p>
      </div>
      <div style="background:var(--cream);padding:24px;border-radius:8px;border-left:4px solid var(--danger)">
        <div style="font-weight:600;color:var(--danger);margin-bottom:6px">Not yet ready (0–49)</div>
        <p style="font-size:0.875rem;color:var(--muted);line-height:1.6">Significant gaps remain. Your counsellor can help you build a plan to improve each dimension before you apply.</p>
      </div>
    </div>
    <p style="max-width:640px;margin-top:32px;font-size:0.9rem;color:var(--muted);line-height:1.7">Scores are recalculated whenever you update your profile or documents. There is no limit to how often you can run the assessment — use it to track your progress over time.</p>
  </div>
</section>

<section class="cta-section">
  <div class="container">
    <h2>Check your visa readiness</h2>
    <p>Register as a student to get your personalised score.</p>
    <div class="cta-actions">
      <a href="{{ route('register.student') }}" class="cta-btn-white">Register as Student</a>
      <a href="{{ route('login') }}" class="cta-btn-outline">Login</a>
    </div>
  </div>
</section>
@endsection
