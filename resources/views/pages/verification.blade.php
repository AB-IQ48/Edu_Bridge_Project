@extends('layout.header')

@section('title', 'Verification — EduBridge')

@section('content')
<section class="verification">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">02</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Verification</span>
    </div>
    <h2 class="section-title">Rigorous counsellor verification</h2>
    <p class="section-sub">Every counsellor undergoes a five-layer verification process before they can advise a single student. No exceptions.</p>
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
            <p>Student success rates, visa approval ratios, and complaints tracked continuously — scores updated quarterly.</p>
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
        <div class="counsellor-card-demo">
          <div class="counsellor-head">
            <div class="counsellor-avatar">AR</div>
            <div>
              <div class="counsellor-name">Aisha Rahman</div>
              <div class="counsellor-org">Global Study Advisors · Lahore, Pakistan</div>
            </div>
          </div>
          <div style="margin-bottom:16px">
            <span class="badge-verified-full">✓ Identity Verified</span>
            <span class="badge-verified-full" style="margin-left:8px;background:rgba(200,168,75,0.15);border-color:rgba(200,168,75,0.4);color:#e8d49a">★ 4.9 Rating</span>
          </div>
          <div class="counsellor-metrics">
            <div class="metric">
              <div class="metric-val">7 yrs</div>
              <div class="metric-key">Experience</div>
            </div>
            <div class="metric">
              <div class="metric-val">340</div>
              <div class="metric-key">Students Placed</div>
            </div>
            <div class="metric">
              <div class="metric-val">94%</div>
              <div class="metric-key">Visa Success</div>
            </div>
          </div>
        </div>
        <div style="font-size:0.75rem;color:rgba(255,255,255,0.4);line-height:1.6">
          Verified on EduBridge · Last review: Jan 2026 · Profile ID: EB-2024-0341
        </div>
      </div>
    </div>
  </div>
</section>

<section class="cta-section">
  <div class="container">
    <h2>Work with verified counsellors</h2>
    <p>Apply as a counsellor or find one that's right for you.</p>
    <div class="cta-actions">
      <a href="{{ route('register.company') }}" class="cta-btn-white">Apply as Counsellor</a>
      <a href="{{ route('register.student') }}" class="cta-btn-outline">Register as Student</a>
    </div>
  </div>
</section>
@endsection
