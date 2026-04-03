@extends('layout.header')

@section('title', 'For you | EduBridge')

@section('content')
<section class="for-who">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">05</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Who It's For</span>
    </div>
    <h2 class="section-title">Designed for every side of the equation</h2>
    <p class="section-sub" style="margin-bottom:16px">Whether you're a student planning your first move abroad or a counsellor building a reputation for integrity, EduBridge is built for you.</p>
    <p style="max-width:720px;font-size:1rem;color:var(--muted);line-height:1.75">Students get checked guidance and a clear visa score. Consultants get a way to show they are legit. Everyone uses the same tools: safe file storage, readable scores, and outcome data.</p>
  </div>
  <div style="max-width:1200px;margin:0 auto;padding:0 32px">
    <div class="roles-grid">
      <div class="role-card" id="for-students">
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
      <div class="role-card" id="for-counsellors">
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

<section class="trust-section" style="padding:80px 0;background:var(--white)">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">•</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">By the numbers</span>
    </div>
    <h2 class="section-title" style="font-size:1.75rem">Why students and counsellors choose EduBridge</h2>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:24px;margin-top:40px;max-width:1000px">
      <div style="text-align:center;padding:24px">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:600;color:var(--sage);line-height:1">4,200+</div>
        <p style="font-size:0.85rem;color:var(--muted);margin-top:8px">Students placed at verified universities</p>
      </div>
      <div style="text-align:center;padding:24px">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:600;color:var(--sage);line-height:1">320+</div>
        <p style="font-size:0.85rem;color:var(--muted);margin-top:8px">Identity-verified counsellors</p>
      </div>
      <div style="text-align:center;padding:24px">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:600;color:var(--sage);line-height:1">98.6%</div>
        <p style="font-size:0.85rem;color:var(--muted);margin-top:8px">Student satisfaction rate</p>
      </div>
      <div style="text-align:center;padding:24px">
        <div style="font-family:var(--font-serif);font-size:2.5rem;font-weight:600;color:var(--sage);line-height:1">Zero</div>
        <p style="font-size:0.85rem;color:var(--muted);margin-top:8px">Unresolved fraud complaints</p>
      </div>
    </div>
    <p style="max-width:640px;margin:40px auto 0;font-size:0.9rem;color:var(--muted);line-height:1.7;text-align:center">Our platform is built for transparency. Every counsellor is verified; every score is explainable; every document access is logged. That’s how we keep trust at the centre of study abroad.</p>
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
