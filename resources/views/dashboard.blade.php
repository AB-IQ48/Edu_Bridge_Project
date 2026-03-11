@extends('layout.auth')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>
    <p class="sub">
        You are logged in as <strong>{{ auth()->user()->name }}</strong>
        ({{ auth()->user()->role?->name ?? 'N/A' }}).
    </p>

    @if (auth()->user()->counsellorProfile)
        <div class="grid" style="margin-bottom:12px">
            <div><strong>Organization:</strong> {{ auth()->user()->counsellorProfile->organization_name }}</div>
            <div><strong>Experience:</strong> {{ auth()->user()->counsellorProfile->experience_years }} years</div>
            <div><strong>Verification:</strong> {{ auth()->user()->counsellorProfile->verification_status }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn" type="submit">Logout</button>
    </form>
@endsection
