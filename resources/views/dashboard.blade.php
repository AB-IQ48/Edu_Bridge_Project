@extends('layout.auth')

@section('title', 'Dashboard')

@section('content')
    <div class="role-card" style="margin-bottom: 20px;">
        <div style="font-size: 0.72rem; letter-spacing: 0.08em; text-transform: uppercase; color: var(--muted); margin-bottom: 4px;">Role-based access</div>
        <h1 style="margin: 0 0 4px;">Dashboard</h1>
        <p class="sub" style="margin: 0;">
            You are logged in as <strong>{{ auth()->user()->name }}</strong>
            · <span class="role-badge-inline">{{ ucfirst(auth()->user()->role?->name ?? 'User') }}</span>
        </p>
    </div>

    <p class="hint" style="margin-bottom: 20px; padding: 10px 12px; background: rgba(74,124,107,0.08); border-radius: 8px; border-left: 3px solid var(--sage);">
        EduBridge uses role-based governance: your access is limited to your role (Student, Counsellor, or Administrator). No opaque systems — verification and scoring are documented and transparent.
    </p>

    @if (auth()->user()->counsellorProfile)
        <div class="grid" style="margin-bottom: 16px;">
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
