@extends('layout.auth')

@section('title', 'Counsellor Dashboard')

@section('content')
    <h1>Counsellor Dashboard</h1>
    @if (session('message'))
        <p class="error" style="background: rgba(74,124,107,0.15); color: var(--sage); border-color: var(--sage);">{{ session('message') }}</p>
    @endif
    @if ($profile)
        <p class="sub">{{ $profile->organization_name }} · {{ $profile->experience_years }} years · Verification: {{ $profile->verification_status }}</p>
        <div class="toplinks">
            <a href="{{ route('counsellor.profile.edit') }}">Edit profile</a>
            <a href="{{ route('documents.index') }}">My documents</a>
            <a href="{{ route('documents.create') }}">Upload document</a>
        </div>
    @else
        <p class="sub">No profile found.</p>
    @endif
    <div class="toplinks" style="margin-top:16px">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit" class="btn" style="width:auto; padding:8px 16px">Logout</button></form>
    </div>
@endsection
