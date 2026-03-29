@extends('pages.layouts.static')

@section('title', 'Terms of Service | EduBridge')

@section('static_title', 'Terms of Service')

@section('static_updated', 'Last updated: March 29, 2026')

@section('static_body')
    <p>By accessing or using EduBridge, you agree to these terms. If you do not agree, do not use the service.</p>
    <h2>Service description</h2>
    <p>EduBridge provides tools for education planning, counsellor discovery, document handling, and rule-based visa readiness scoring. We are <strong>not</strong> a government immigration authority and we do not guarantee visa outcomes.</p>
    <h2>Accounts</h2>
    <p>You must provide accurate information and keep your credentials secure. You are responsible for activity under your account unless you report misuse promptly.</p>
    <h2>Acceptable use</h2>
    <p>You may not misuse the platform (for example by attempting unauthorized access, harassing users, uploading malware, or misrepresenting credentials). We may suspend or terminate accounts that violate these rules or applicable law.</p>
    <h2>Content and documents</h2>
    <p>You retain rights to content you upload; you grant us a licence to host, process, and display it as needed to operate the service. You confirm you have the right to share the materials you upload.</p>
    <h2>Visa readiness score</h2>
    <p>The score is an informational tool based on published rules and your answers. It is not a prediction of government decisions. Always confirm requirements with official sources.</p>
    <h2>Disclaimer</h2>
    <p>The service is provided “as is” to the extent permitted by law. We disclaim warranties not expressly stated and limit liability as allowed by law.</p>
    <h2>Changes</h2>
    <p>We may change these terms. Continued use after changes constitutes acceptance of the updated terms.</p>
    <p style="margin-top:20px"><a href="{{ route('pages.contact') }}">Contact</a> · <a href="{{ route('pages.privacy') }}">Privacy Policy</a></p>
@endsection
