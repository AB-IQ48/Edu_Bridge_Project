@extends('layout.auth')

@section('title', 'Student profile')

@section('card_class', 'card--wide')

@section('content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Student</p>
    <h1>Your profile</h1>
    <p class="sub">Quick links: visa assessment, your documents, and counsellor search.</p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:14px; margin-bottom:8px;">
        <a href="{{ route('scores.assess') }}" style="padding:18px; border-radius:14px; text-decoration:none; color:inherit; background:linear-gradient(135deg, rgba(74,124,107,0.12), #fff); border:1px solid rgba(74,124,107,0.25); box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <div style="font-size:1.5rem; margin-bottom:6px;">📋</div>
            <strong style="display:block; margin-bottom:4px;">Visa readiness assessment</strong>
            <span style="font-size:0.85rem; color:var(--muted);">Choose destination, answer questions → score &amp; tips</span>
        </a>
        <a href="{{ route('student.documents.index') }}" style="padding:18px; border-radius:14px; text-decoration:none; color:inherit; background:linear-gradient(135deg, rgba(59,130,246,0.1), #fff); border:1px solid rgba(59,130,246,0.25); box-shadow:0 4px 12px rgba(0,0,0,0.05);">
            <div style="font-size:1.5rem; margin-bottom:6px;">🗂️</div>
            <strong style="display:block; margin-bottom:4px;">Documents</strong>
            <span style="font-size:0.85rem; color:var(--muted);">Upload & track files</span>
        </a>
    </div>

    <div class="toplinks">
        <a href="{{ route('student.index') }}">← Student dashboard</a>
        <a href="{{ route('counsellors.index') }}">Find a counsellor</a>
    </div>
@endsection
