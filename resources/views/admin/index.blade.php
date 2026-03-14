@extends('layout.auth')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>
    <p class="sub">Review counsellor profiles and verification documents.</p>

    @if (session('message'))
        <p class="error" style="background: rgba(74,124,107,0.15); color: var(--sage); border-color: var(--sage);">{{ session('message') }}</p>
    @endif

    <h2 style="font-size:1.1rem; margin-top:24px">Pending profile verifications</h2>
    <ul style="margin:0; padding-left:20px">
        @forelse($pendingProfiles as $p)
            <li>{{ $p->user->name }} — {{ $p->organization_name }} ({{ $p->verification_status }})
                <form method="POST" action="{{ route('admin.profiles.review', $p) }}" style="display:inline; margin-left:8px">
                    @csrf
                    <input type="hidden" name="verification_status" value="approved"><button type="submit">Approve</button>
                </form>
                <form method="POST" action="{{ route('admin.profiles.review', $p) }}" style="display:inline">
                    @csrf
                    <input type="hidden" name="verification_status" value="rejected"><button type="submit">Reject</button>
                </form>
            </li>
        @empty
            <li>No pending profiles.</li>
        @endforelse
    </ul>

    <h2 style="font-size:1.1rem; margin-top:24px">Pending document reviews</h2>
    <ul style="margin:0; padding-left:20px">
        @forelse($pendingDocuments as $d)
            <li>{{ $d->document_name }} ({{ $d->counsellorProfile->user->name }})
                <form method="POST" action="{{ route('admin.documents.review', $d) }}" style="display:inline; margin-left:8px">
                    @csrf
                    <input type="hidden" name="status" value="approved"><button type="submit">Approve</button>
                </form>
                <form method="POST" action="{{ route('admin.documents.review', $d) }}" style="display:inline">
                    @csrf
                    <input type="hidden" name="status" value="rejected"><button type="submit">Reject</button>
                </form>
            </li>
        @empty
            <li>No pending documents.</li>
        @endforelse
    </ul>

    <div class="toplinks" style="margin-top:24px">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit" class="btn" style="width:auto; padding:8px 16px">Logout</button></form>
    </div>
@endsection
