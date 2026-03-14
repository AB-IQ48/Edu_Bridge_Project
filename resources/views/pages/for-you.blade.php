@extends('layout.header')

@section('title', 'For You — EduBridge')

@section('content')
<section class="for-who">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">05</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Who It's For</span>
    </div>
    <h2 class="section-title">Designed for every side of the equation</h2>
  </div>
  <div style="max-width:1200px;margin:0 auto;padding:0 32px">
    <div class="roles-grid">
      <div class="role-card">
        <div class="role-label">For Students</div>
        <h3 class="role-title">Study abroad without fear of fraud</h3>
        <p class="role-desc">You're making one of the biggest decisions of your life. EduBridge ensures the person guiding you has been verified, accountable, and is measured on your actual success.</p>
        <div class="role-features">
          <div class="role-feature">Browse verified counsellors with real outcome data</div>
          <div class="role-feature">Know your visa readiness before you apply</div>
          <div class="role-feature">Secure document upload with access control</div>
          <div class="role-feature">Report issues with guaranteed resolution</div>
        </div>
        <a href="{{ route('register.student') }}" class="role-cta">Start as a Student →</a>
      </div>
      <div class="role-card">
        <div class="role-label">For Counsellors</div>
        <h3 class="role-title">Differentiate through verified credibility</h3>
        <p class="role-desc">Stand out in a crowded market by proving your legitimacy. EduBridge verification gives ethical consultants a competitive edge over fraudulent operators.</p>
        <div class="role-features">
          <div class="role-feature">Verified badge that builds instant trust</div>
          <div class="role-feature">Dashboard to manage student pipelines</div>
          <div class="role-feature">Transparent rating system based on outcomes</div>
          <div class="role-feature">Secure document workflow reduces liability</div>
        </div>
        <a href="{{ route('register.company') }}" class="role-cta">Apply as a Counsellor →</a>
      </div>
    </div>
  </div>
</section>

<section class="cta-section">
  <div class="container">
    <h2>Ready to join EduBridge?</h2>
    <p>Choose your path and get started today.</p>
    <div class="cta-actions">
      <a href="{{ route('register.student') }}" class="cta-btn-white">Register as Student</a>
      <a href="{{ route('register.company') }}" class="cta-btn-outline">Register as Counsellor</a>
    </div>
  </div>
</section>
@endsection
