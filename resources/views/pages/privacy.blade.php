@extends('pages.layouts.static')

@section('title', 'Privacy Policy | EduBridge')

@section('static_title', 'Privacy Policy')

@section('static_updated', 'Last updated: March 29, 2026')

@section('static_body')
    <p>This policy describes how EduBridge (“we”, “us”) handles personal information when you use our website and services. It is written for clarity; it is not legal advice. If you need advice for your situation, consult a qualified professional.</p>
    <h2>What we collect</h2>
    <ul>
        <li><strong>Account data:</strong> such as name, email, role (student, counsellor, administrator), and login metadata.</li>
        <li><strong>Profile and application data:</strong> information you or your counsellor submits, including documents you upload for study-abroad or verification purposes.</li>
        <li><strong>Usage data:</strong> such as pages viewed, approximate timestamps, and security-related logs to protect accounts.</li>
        <li><strong>Communications:</strong> messages sent through in-platform chat between connected students and counsellors.</li>
    </ul>
    <h2>How we use information</h2>
    <p>We use data to run the service (accounts, verification workflows, visa readiness scoring), to keep the platform secure, to improve features, and to meet legal obligations where they apply.</p>
    <h2>Sharing</h2>
    <p>We do not sell your personal information. We may share data with service providers who host or support our systems under strict terms, or when required by law. Assigned counsellors and students can see information needed for the counselling relationship (for example documents you choose to share).</p>
    <h2>Retention</h2>
    <p>We keep information as long as your account is active and as needed for legal, security, or dispute-resolution purposes. You can ask to delete or export certain data subject to applicable law and operational limits.</p>
    <h2>Your choices</h2>
    <p>You may update some information in your profile, opt out of non-essential communications where offered, and contact us with privacy requests. See <a href="{{ route('pages.contact') }}">Contact</a>.</p>
    <h2>International users</h2>
    <p>If you access the service from outside the country where the platform is operated, your data may be processed in other countries with appropriate safeguards as required by law.</p>
    <h2>Changes</h2>
    <p>We may update this policy from time to time. We will post the new date at the top of this page.</p>
@endsection
