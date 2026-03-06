  @extends('layout.header')
  
  @section('title' , 'Main')

  @section('content')
  <!-- Hero -->
  <section class="hero">
    <div class="hero-left">
      <div class="hero-badge">Verified Consultancy Platform</div>
      <h1 class="hero-h1">Study abroad with <em>verified</em> guidance you can trust</h1>
      <p class="hero-sub">EduBridge connects students with identity-verified education counsellors, transparent visa readiness scoring, and secure document handling — eliminating fraud from the overseas study process.</p>
      <div class="hero-actions">
        <a href="#contact" class="btn-primary-hero">Find a Counsellor</a>
        <a href="#how-it-works" class="btn-ghost-hero">How it works</a>
      </div>
    </div>
    <div class="hero-right">
      <div class="trust-score-card">
        <div class="trust-label">Counsellor Trust Score</div>
        <div class="trust-score-row">
          <div class="score-circle">
            <span class="score-num">85</span>
          </div>
          <div class="score-meta">
            <h4>Aisha Rahman</h4>
            <p>Senior Education Advisor · Lahore</p>
            <div class="badge-verified-full" style="margin-top:8px">✓ Verified</div>
          </div>
        </div>
        <div class="score-bars">
          <div class="score-bar-row">
            <span class="score-bar-label">Identity Verified</span>
            <div class="score-bar-track"><div class="score-bar-fill" style="width:100%"></div></div>
            <span class="score-bar-val">100</span>
          </div>
          <div class="score-bar-row">
            <span class="score-bar-label">Credentials</span>
            <div class="score-bar-track"><div class="score-bar-fill" style="width:88%"></div></div>
            <span class="score-bar-val">88</span>
          </div>
          <div class="score-bar-row">
            <span class="score-bar-label">Student Outcomes</span>
            <div class="score-bar-track"><div class="score-bar-fill" style="width:82%"></div></div>
            <span class="score-bar-val">82</span>
          </div>
          <div class="score-bar-row">
            <span class="score-bar-label">Complaint History</span>
            <div class="score-bar-track"><div class="score-bar-fill" style="width:95%"></div></div>
            <span class="score-bar-val">95</span>
          </div>
        </div>
      </div>
      <div class="hero-stats">
        <div class="stat-tile">
          <div class="stat-num">4,200+</div>
          <div class="stat-desc">Students placed at verified universities</div>
        </div>
        <div class="stat-tile">
          <div class="stat-num">320+</div>
          <div class="stat-desc">Identity-verified counsellors</div>
        </div>
        <div class="stat-tile">
          <div class="stat-num">98.6%</div>
          <div class="stat-desc">Student satisfaction rate</div>
        </div>
        <div class="stat-tile">
          <div class="stat-num">Zero</div>
          <div class="stat-desc">Unresolved fraud complaints</div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works -->
  <section class="how-it-works" id="how-it-works">
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

  <!-- Verification -->
  <section class="verification" id="verification">
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

  <!-- Visa Readiness -->
  <section class="visa-readiness" id="visa-readiness">
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

  <!-- Why Trust Us -->
  <section class="trust-section">
    <div class="container">
      <div class="section-eyebrow">
        <span class="eyebrow-num">04</span>
        <span class="eyebrow-line"></span>
        <span class="eyebrow-tag">Platform Integrity</span>
      </div>
      <h2 class="section-title">Built for trust, not just convenience</h2>
      <p class="section-sub">In markets where regulatory oversight is limited, EduBridge provides the accountability infrastructure that governments haven't yet built.</p>
    </div>
    <div style="max-width:1200px;margin:0 auto;padding:0 32px">
      <div class="trust-grid">
        <div class="trust-item">
          <div class="trust-item-num">01</div>
          <h3>Role-Based Access Control</h3>
          <p>Students, counsellors, and administrators operate in strictly separated permission zones. A counsellor can never access another counsellor's student data.</p>
        </div>
        <div class="trust-item">
          <div class="trust-item-num">02</div>
          <h3>Encrypted Document Vault</h3>
          <p>Every document you upload is encrypted at rest and in transit. Access logs are immutable and auditable, so you always know who saw what and when.</p>
        </div>
        <div class="trust-item">
          <div class="trust-item-num">03</div>
          <h3>Transparent Scoring Logic</h3>
          <p>Our visa readiness engine uses published rule sets — no proprietary black boxes. You can read exactly how every point is calculated before submitting anything.</p>
        </div>
        <div class="trust-item">
          <div class="trust-item-num">04</div>
          <h3>Complaint & Dispute System</h3>
          <p>Every complaint is logged, tracked, and resolved within defined SLAs. Counsellors with unresolved complaints are automatically suspended pending review.</p>
        </div>
        <div class="trust-item">
          <div class="trust-item-num">05</div>
          <h3>Continuous Outcome Tracking</h3>
          <p>We follow up with students post-placement to verify actual outcomes — university enrolment, visa approval, and satisfaction. Counsellor scores reflect reality.</p>
        </div>
        <div class="trust-item">
          <div class="trust-item-num">06</div>
          <h3>Audit Trail for Everything</h3>
          <p>Every message, document action, score change, and session note is timestamped and logged — creating a verifiable record that protects both students and counsellors.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- For Who -->
  <section class="for-who" id="for-who">
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
          <a href="#contact" class="role-cta">Start as a Student →</a>
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
          <a href="#contact" class="role-cta">Apply as a Counsellor →</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="testimonials">
    <div class="container">
      <div class="section-eyebrow">
        <span class="eyebrow-num">06</span>
        <span class="eyebrow-line"></span>
        <span class="eyebrow-tag">Testimonials</span>
      </div>
      <h2 class="section-title">Students who studied smarter</h2>
      <p class="section-sub">Real outcomes from students who used EduBridge to navigate the overseas education process safely.</p>
      <div class="testi-grid">
        <div class="testi-card">
          <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
          <p class="testi-text">"I'd been scammed by a consultant before. EduBridge's verification gave me the confidence to try again. My visa was approved in 6 weeks."</p>
          <div class="testi-author">
            <div class="testi-avatar">FH</div>
            <div>
              <div class="testi-name">Fatima Hussain</div>
              <div class="testi-from">Lahore → University of Edinburgh</div>
            </div>
          </div>
        </div>
        <div class="testi-card">
          <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
          <p class="testi-text">"The visa readiness score showed me exactly what was missing. I fixed my financial documents and went from 58 to 84 in two weeks. Game-changer."</p>
          <div class="testi-author">
            <div class="testi-avatar">AK</div>
            <div>
              <div class="testi-name">Amr Khalil</div>
              <div class="testi-from">Cairo → University of Toronto</div>
            </div>
          </div>
        </div>
        <div class="testi-card">
          <div class="testi-stars"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
          <p class="testi-text">"Knowing my counsellor had been verified and their success rate was real — not self-reported — gave my parents the confidence to support my application."</p>
          <div class="testi-author">
            <div class="testi-avatar">RN</div>
            <div>
              <div class="testi-name">Riya Nair</div>
              <div class="testi-from">Colombo → University of Melbourne</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FAQ -->
  <section class="faq" id="faq">
    <div class="container">
      <div class="section-eyebrow">
        <span class="eyebrow-num">07</span>
        <span class="eyebrow-line"></span>
        <span class="eyebrow-tag">FAQ</span>
      </div>
      <div class="faq-grid">
        <div class="faq-side">
          <h2 class="section-title" style="font-size:2rem">Common questions</h2>
          <p class="faq-side-note">Can't find your answer? Contact our team and we'll respond within one business day.</p>
          <a href="#contact" class="role-cta" style="display:inline-block;margin-top:24px">Contact us →</a>
        </div>
        <div class="faq-items">
          <div class="faq-item open">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
              How long does counsellor verification take?
              <div class="faq-toggle"></div>
            </div>
            <div class="faq-a">Verification typically takes 5–10 business days. We contact issuing institutions directly and cross-reference multiple databases. Counsellors receive a provisional status indicator during review so students can see the process is active.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
              Who can see my documents after I upload them?
              <div class="faq-toggle"></div>
            </div>
            <div class="faq-a">Only you and the specific counsellor you explicitly assign can access your documents. Our role-based access control system prevents any other party — including EduBridge administrators unless legally required — from viewing your files. Every access event is logged.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
              How is the Visa Readiness Score calculated?
              <div class="faq-toggle"></div>
            </div>
            <div class="faq-a">The score uses a published rule set across five weighted dimensions: academic eligibility (25%), financial proof (25%), language proficiency (20%), document completeness (20%), and interview readiness (10%). The weights and rules are publicly documented so you can understand every point.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
              What happens if I have a complaint about a counsellor?
              <div class="faq-toggle"></div>
            </div>
            <div class="faq-a">File a complaint through your dashboard. It is logged immediately and the counsellor is notified. Complaints are resolved within 14 business days. Counsellors with open unresolved complaints are automatically restricted from accepting new students until the matter is closed.</div>
          </div>
          <div class="faq-item">
            <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
              Is EduBridge free for students?
              <div class="faq-toggle"></div>
            </div>
            <div class="faq-a">Browsing verified counsellors, checking their ratings, and generating your Visa Readiness Score are all free. Counsellors pay a platform fee — they are never permitted to pass hidden charges to students without full transparency and your written consent.</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta-section" id="contact">
    <div class="container">
      <h2>Ready to study abroad,<br><em style="font-style:italic">the right way?</em></h2>
      <p>Join thousands of students who chose verification over risk.</p>
      <div class="cta-actions">
        <a href="#" class="cta-btn-white">Find a Verified Counsellor</a>
        <a href="#" class="cta-btn-outline">Apply as a Counsellor</a>
      </div>
    </div>
  </section>

  @endsection