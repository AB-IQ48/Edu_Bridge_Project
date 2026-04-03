@extends('pages.layouts.static')

@section('title', 'Complaint Policy | EduBridge')

@section('static_title', 'Complaint Policy')

@section('static_updated', 'Last updated: March 29, 2026')

@section('static_body')
    <p>We take reports of misconduct, fraud, or poor service seriously. This policy explains how to raise concerns and what you can expect from us.</p>
    <h2>What you can report</h2>
    <ul>
        <li>Suspected misrepresentation by a counsellor or misuse of the verification badge.</li>
        <li>Harassment or abuse in platform chat.</li>
        <li>Technical issues that expose data or block access to your account.</li>
        <li>Other behaviour that violates our <a href="{{ route('pages.terms') }}">Terms of Service</a> or community expectations.</li>
    </ul>
    <h2>How to report</h2>
    @auth
        @if(auth()->user()->isStudent())
            <p><strong>Signed in as a student:</strong> use <a href="{{ route('student.complaints.create') }}">Make a complaint</a> in your account (also linked from your dashboard). That sends your report securely with your account details.</p>
        @elseif(auth()->user()->isCounsellor())
            <p><strong>Signed in as a counsellor:</strong> use <a href="{{ route('counsellor.complaints.create') }}">Make a complaint</a> from your counsellor dashboard.</p>
        @endif
    @endauth
    <p>You can also email <a href="mailto:support@edubridge.pk">support@edubridge.pk</a> with a clear description, dates, and any relevant screenshots or message IDs. Include your account email if you are logged in.</p>
    <p>For general enquiries, see <a href="{{ route('pages.contact') }}">Contact</a>.</p>
    <h2>What we do next</h2>
    <p>We acknowledge receipt when possible, review facts in line with our moderation capacity, and may take action such as warnings, suspension, or removal from the platform, or escalation to authorities where required.</p>
    <h2>Visa and legal disputes</h2>
    <p>EduBridge cannot adjudicate immigration decisions or replace regulators. For visa refusals or legal claims, seek appropriate legal or government channels.</p>
@endsection
