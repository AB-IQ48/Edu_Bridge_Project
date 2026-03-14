@extends('layout.header')

@section('title', 'FAQ — EduBridge')

@section('content')
<section class="faq">
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
        <a href="{{ route('login') }}" class="role-cta" style="display:inline-block;margin-top:24px">Contact us →</a>
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
@endsection
