@extends('pages.layouts.static')

@section('title', 'Contact | EduBridge')

@section('static_title', 'Contact')

@section('static_body')
    <p>Questions about verification, your account, or how visa scoring works? Use the options below. We aim to reply within <strong>one to two business days</strong> where email is offered.</p>

    <div class="static-contact-card">
        <p style="margin:0 0 8px;font-weight:600;color:var(--ink)">General enquiries</p>
        <p style="margin:0 0 12px">For platform support and general questions, email us at <a href="mailto:support@edubridge.pk">support@edubridge.pk</a> (replace with your production address when you go live).</p>
        <p style="margin:0;font-size:0.88rem">If you already have an account, signing in helps us find your profile faster.</p>
    </div>

    <div class="static-contact-card">
        <p style="margin:0 0 8px;font-weight:600;color:var(--ink)">Students</p>
        <p style="margin:0">After you <a href="{{ route('login') }}">sign in</a>, your dashboard lists documents and visa assessments. Browse <a href="{{ route('counsellors.index') }}">verified counsellors</a> anytime.</p>
    </div>

    <div class="static-contact-card">
        <p style="margin:0 0 8px;font-weight:600;color:var(--ink)">Counsellors & institutions</p>
        <p style="margin:0">Registration and verification questions are covered in <a href="{{ route('pages.faq') }}">FAQ</a> and <a href="{{ route('pages.verification') }}">Verification</a>. Apply through <a href="{{ route('register.company') }}">counsellor registration</a>.</p>
    </div>

    <p style="margin-top:24px"><a href="{{ route('login') }}">Sign in</a> · <a href="{{ route('pages.faq') }}">FAQ</a></p>
@endsection
