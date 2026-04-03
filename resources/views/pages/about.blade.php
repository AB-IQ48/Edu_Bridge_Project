@extends('pages.layouts.static')

@section('title', 'About | EduBridge')

@section('static_title', 'About EduBridge')

@section('static_body')
    <p>EduBridge is a platform for overseas study planning that puts <strong>verification</strong> and <strong>clear rules</strong> first. We help students find counsellors who have been checked, track documents safely, and understand visa readiness using a published, rule-based score, not a black box.</p>
    <h2>What we believe</h2>
    <ul>
        <li>Students deserve to know how advice is sourced and who is accountable.</li>
        <li>Ethical counsellors should be able to prove credibility, not compete with anonymous listings.</li>
        <li>Visa readiness tools should explain their weights and inputs in plain language.</li>
    </ul>
    <h2>What we are not</h2>
    <p>We are not a law firm or a government visa service. Immigration rules change by country and over time. Always confirm requirements on <strong>official</strong> immigration and embassy sites, and use qualified legal advice when you need it.</p>
    <p style="margin-top:20px"><a href="{{ route('pages.contact') }}">Contact us</a> · <a href="{{ route('pages.faq') }}">FAQ</a></p>
@endsection
