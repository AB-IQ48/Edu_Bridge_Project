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
    <p class="section-sub">No black boxes. Our rule-based scoring model breaks down exactly why your score is what it is and how to improve it.</p>
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
