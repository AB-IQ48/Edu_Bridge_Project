@extends('pages.layouts.static')

@section('title', 'Data Security | EduBridge')

@section('static_title', 'Data Security')

@section('static_updated', 'Last updated: March 29, 2026')

@section('static_body')
    <p>We design EduBridge so that sensitive study-abroad documents and messages are handled with care. No online system is risk-free; these practices describe our intent and priorities.</p>
    <h2>Access control</h2>
    <p>Students and counsellors see only what their role and assignments require. Administrative access is limited to operational needs (for example moderation or support).</p>
    <h2>Transport and storage</h2>
    <p>We use industry-standard HTTPS for transport. Stored files and databases are protected with access controls appropriate to our hosting environment.</p>
    <h2>Logging</h2>
    <p>We may log security events and certain actions (such as document access) to detect misuse and support audits.</p>
    <h2>Your responsibilities</h2>
    <p>Use a strong password, sign out on shared devices, and report suspicious activity. Do not upload documents you are not entitled to share.</p>
    <h2>Incidents</h2>
    <p>If we become aware of a breach that affects your personal data, we will notify you as required by applicable law and take steps to mitigate harm.</p>
    <p style="margin-top:20px"><a href="{{ route('pages.privacy') }}">Privacy Policy</a> · <a href="{{ route('pages.complaints') }}">Complaint Policy</a> · <a href="{{ route('pages.contact') }}">Contact</a></p>
@endsection
