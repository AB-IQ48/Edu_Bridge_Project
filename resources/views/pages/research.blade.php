@extends('pages.layouts.static')

@section('title', 'Research & methodology | EduBridge')

@section('static_title', 'Research & methodology')

@section('static_body')
    <p>“Research” on EduBridge means <strong>transparent methodology</strong>: how we score visa readiness, how counsellor verification works, and what data we do (and do not) collect.</p>
    <h2>Visa readiness score</h2>
    <p>Our questionnaire maps your answers to five dimensions (academic, financial, language, documentation, and interview) with fixed weights (25%, 25%, 20%, 20%, 10%). The rules are implemented in software so the same answers always produce the same breakdown, subject to product updates we will document.</p>
    <p>For the exact weighting and dimensions, see <a href="{{ route('pages.visa-readiness') }}">Visa Readiness</a> and your assessment result page after you complete a questionnaire.</p>
    <h2>Counsellor verification</h2>
    <p>Verification is a structured review of identity and professional claims. Status (for example pending, approved, or rejected) is shown on profiles so students can make informed choices. Details of the review process are described on our <a href="{{ route('pages.verification') }}">Verification</a> page.</p>
    <h2>Outcomes and statistics</h2>
    <p>Any aggregate numbers shown on marketing pages are illustrative of our design goals unless sourced from live analytics. Where we publish platform statistics, we aim to label them clearly and update them over time.</p>
@endsection
