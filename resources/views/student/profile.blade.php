@extends('layout.auth')

@section('title', 'Student profile')

@section('content')
    <h1>Student profile</h1>
    <p class="sub">Manage your profile and visa readiness inputs.</p>
    <div class="toplinks">
        <a href="{{ route('scores.create') }}">Calculate visa readiness score</a>
        <a href="{{ route('student.index') }}">Back to dashboard</a>
    </div>
@endsection
