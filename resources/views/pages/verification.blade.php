@extends('layout.header')

@section('title', 'Verification | EduBridge')

@section('content')
<section class="verification">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">02</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Verification</span>
    </div>
    <h2 class="section-title">Rigorous counsellor verification</h2>
    <p class="section-sub">Every counsellor undergoes a five-layer verification process before they can advise a single student. Additional checks may also be performed case by case before approval.</p>
    <p style="max-width:640px;margin-top:20px;font-size:0.95rem;color:rgba(255,255,255,0.6);line-height:1.7">In many markets, anyone can call themselves an education consultant. EduBridge changes that: we verify identity, credentials, and business registration, and we keep monitoring outcomes so the badge on a profile reflects real, up-to-date trust.</p>
    <div class="veri-grid">
      <div class="veri-checks">
        <div class="veri-check">
          <div class="check-badge verified">✓</div>
          <div>
            <h4>Government ID Authentication</h4>
            <p>National ID and passport cross-referenced against official databases to confirm real identity.</p>
          </div>
        </div>
        <div class="veri-check">
          <div class="check-badge verified">✓</div>
          <div>
            <h4>Professional Credential Validation</h4>
            <p>University degrees, counselling certifications, and membership bodies verified directly with issuing institutions.</p>
          </div>
        </div>
        <div class="veri-check">
          <div class="check-badge verified">✓</div>
          <div>
            <h4>Business Registration Check</h4>
            <p>Agency registration documents validated to confirm legal operating status in the counsellor's jurisdiction.</p>
          </div>
        </div>
        <div class="veri-check">
          <div class="check-badge pending">⏳</div>
          <div>
            <h4>Ongoing Outcome Monitoring</h4>
            <p>We track how students do, visa results, and complaints, and we refresh scores every few months.</p>
          </div>
        </div>
        <div class="veri-check">
          <div class="check-badge verified">✓</div>
          <div>
            <h4>Background & Fraud History Screening</h4>
            <p>Cross-checked against reported fraud databases and student complaint registries across three countries.</p>
          </div>
        </div>
      </div>
      <div class="veri-visual">
        <div class="veri-visual-title">Sample Verified Profile</div>
        @include('partials.marketing-verified-profile-card')
      </div>
    </div>
  </div>
</section>

<section class="trust-section" style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">•</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">After verification</span>
    </div>
    <h2 class="section-title" style="font-size:1.75rem">What verified counsellors get</h2>
    <p class="section-sub" style="margin-bottom:28px">Once all five checks are complete, counsellors receive a verified badge and full access to the platform.</p>
    <ul style="max-width:600px;padding-left:20px;font-size:0.95rem;color:var(--muted);line-height:1.9">
      <li><strong style="color:var(--ink)">Verified badge:</strong> shows on the profile and in search so students can pick verified counsellors.</li>
      <li><strong style="color:var(--ink)">Trust score:</strong> one number from 0 to 100 based on ID, papers, results, and complaints (updated every few months).</li>
      <li><strong style="color:var(--ink)">Secure document access:</strong> only the students who assigned you can share files with you.</li>
      <li><strong style="color:var(--ink)">Ongoing monitoring:</strong> we re-check things so profiles do not go stale.</li>
    </ul>
    <p style="max-width:640px;margin-top:24px;font-size:0.9rem;color:var(--muted);line-height:1.7">Counsellors with unresolved complaints are restricted from taking new students until the matter is closed. We take accountability seriously.</p>
  </div>
</section>

<section class="cta-section">
  <div class="container">
    <h2>Get verified guidance — or become verified</h2>
    <p>Students can work with trusted counsellors. Counsellors can apply and earn the verified badge.</p>
    <div class="cta-actions">
      <a href="{{ route('register.company') }}" class="cta-btn-white">Apply as Counsellor</a>
      <a href="{{ route('register.student') }}" class="cta-btn-outline">Register as Student</a>
    </div>
  </div>
</section>
@endsection
