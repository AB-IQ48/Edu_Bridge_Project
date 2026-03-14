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
        <p class="faq-side-note">We've collected the most frequent questions from students and counsellors. Can't find your answer? Contact our team and we'll respond within one business day.</p>
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
        <div class="faq-item">
          <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
            Which countries and universities does EduBridge support?
            <div class="faq-toggle"></div>
          </div>
          <div class="faq-a">We support study-abroad applications to major destinations including the UK, Canada, Australia, USA, and several European and Asian countries. Our counsellors specialise by region and institution — you can filter by destination and see which counsellors have verified experience there. University lists are updated as we add new partners.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
            Can I change or remove my documents after uploading?
            <div class="faq-toggle"></div>
          </div>
          <div class="faq-a">Yes. You can update or remove documents at any time from your dashboard. Your Visa Readiness Score will recalculate automatically when you add or change documents. Only the counsellor you have assigned will see your documents; if you change counsellors, you control who has access.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
            How often is my counsellor's trust score updated?
            <div class="faq-toggle"></div>
          </div>
          <div class="faq-a">Trust scores are recalculated quarterly based on identity verification status, credential checks, student outcomes (e.g. visa approvals, enrolment), and complaint history. If a counsellor receives a new verification or a complaint is resolved, their score can be updated sooner. You always see the latest score on their profile.</div>
        </div>
        <div class="faq-item">
          <div class="faq-q" onclick="this.parentElement.classList.toggle('open')">
            What if I'm a counsellor and my verification is delayed?
            <div class="faq-toggle"></div>
          </div>
          <div class="faq-a">Verification usually takes 5–10 business days. Delays can happen if we need to contact institutions in different time zones or if documents are unclear. You'll see a provisional "Under review" status, and we'll email you if we need anything else. Once approved, your verified badge and full access go live immediately.</div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
