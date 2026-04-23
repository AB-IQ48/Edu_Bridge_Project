@extends('layout.auth')

@section('title', 'Counsellor Dashboard')

@push('auth_styles')
<style>
    .cs-hero {
        border-radius: 16px;
        padding: 18px;
        margin-bottom: 14px;
        background: linear-gradient(135deg, #0f172a 0%, #1f3a2f 45%, #1e293b 100%);
        color: #fff;
        box-shadow: 0 14px 38px rgba(15,23,42,.25);
    }
    .cs-hero h1 { color: #fff; margin-bottom: 6px; }
    .cs-hero .sub { color: rgba(255,255,255,.82); margin-bottom: 0; }
    .cs-actions a {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: .87rem;
        font-weight: 600;
    }
    .cs-doc-help { margin-top: 8px; }
    .stat-mini-link {
        display: block;
        text-decoration: none;
        color: inherit;
    }
    .stat-mini-link .stat-mini:hover {
        border-color: rgba(74,124,107,.45);
        box-shadow: 0 8px 18px rgba(74,124,107,.12);
        transform: translateY(-1px);
    }
</style>
@endpush

@section('content')
    <div class="cs-hero">
        <p class="role-badge-inline" style="margin-bottom:8px; background:rgba(255,255,255,.16); color:#fff;">Counsellor</p>
        <h1>Counsellor Dashboard</h1>
        <p class="sub">Manage your public profile, verification documents, and student chat from one place.</p>
    </div>

    @if ($profile)
        <div class="panel">
            <p class="sub" style="margin-bottom:10px;">
                <strong>{{ $profile->organization_name }}</strong> · {{ $profile->experience_years }} years experience
            </p>
            <div class="chip {{ $profile->verification_status === 'approved' ? 'chip--ok' : ($profile->verification_status === 'pending' ? 'chip--warn' : 'chip--danger') }}">
                Verification: {{ ucfirst($profile->verification_status) }}
            </div>
            <div class="stat-mini-grid">
                <a href="{{ route('counsellor.profile.edit') }}" class="stat-mini-link" title="Edit profile">
                    <div class="stat-mini">
                        <div class="num">{{ $profile->experience_years }}</div>
                        <div class="lbl">Years experience</div>
                    </div>
                </a>
                <a href="{{ route('chat.index') }}" class="stat-mini-link" title="Open chat inbox">
                    <div class="stat-mini">
                        <div class="num">{{ $unreadChatCount ?? 0 }}</div>
                        <div class="lbl">Unread chat messages</div>
                    </div>
                </a>
                <a href="{{ route('counsellor.notifications.index') }}" class="stat-mini-link" title="Account notifications">
                    <div class="stat-mini">
                        <div class="num">{{ (int) ($counsellorUnreadNotificationsCount ?? 0) }}</div>
                        <div class="lbl">Unread alerts</div>
                    </div>
                </a>
            </div>
        </div>

        <h2 style="font-size:1rem; margin-top:20px; margin-bottom:8px;">Documents (verification workflow)</h2>
        <p class="hint cs-doc-help">Upload documents, wait for admin review, then get approved/rejected. Your public "verified" status depends on this.</p>
        <div class="toplinks cs-actions">
            <a href="{{ route('counsellor.profile.edit') }}">Edit public profile</a>
            @if($profile->verification_status === 'approved')
                <a href="{{ route('counsellors.show', $profile) }}">View public profile page</a>
            @endif
            <a href="{{ route('documents.index') }}">My verification documents</a>
            <a href="{{ route('documents.create') }}">Upload verification document</a>
            <a href="{{ route('chat.index') }}">
                Chat with students
                @if(($unreadChatCount ?? 0) > 0)
                    <span class="chip chip--danger" style="margin-left:4px; padding:2px 7px;">{{ $unreadChatCount }}</span>
                @endif
            </a>
            @php $ebNotify = (int) ($counsellorUnreadNotificationsCount ?? 0); @endphp
            <a href="{{ route('counsellor.notifications.index') }}">
                Notifications
                @if($ebNotify > 0)
                    <span class="chip chip--warn" style="margin-left:4px; padding:2px 7px;">{{ $ebNotify > 99 ? '99+' : $ebNotify }}</span>
                @endif
            </a>
            <a href="{{ route('counsellor.complaints.index') }}">Complaints</a>
        </div>

        @php $assignedStudents = $assignedStudents ?? collect(); @endphp
        @if($assignedStudents->isNotEmpty())
            <h2 style="font-size:1rem; margin-top:26px; margin-bottom:8px;">Assigned students — documents</h2>
            <p class="hint" style="margin-bottom:12px;">Review files each student uploaded for their application. Only their assigned counsellor can open these.</p>
            <ul class="cs-students-list">
                @foreach($assignedStudents as $stu)
                    <li class="cs-students-item">
                        <div class="cs-students-meta">
                            <strong class="cs-students-name">{{ $stu->name }}</strong>
                            <span class="hint cs-students-count">
                                {{ (int) ($stu->student_documents_count ?? 0) }} document{{ ((int) ($stu->student_documents_count ?? 0)) === 1 ? '' : 's' }}
                            </span>
                        </div>
                        <div class="cs-students-actions">
                            <a href="{{ route('counsellor.assigned-students.documents', $stu) }}" class="btn btn--sage cs-students-btn">View documents</a>
                            <a href="{{ route('chat.show', $stu) }}" class="btn btn--ghost cs-students-btn">Open chat</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        <div class="alert alert--error">No counsellor profile found yet.</div>
    @endif

    <div class="toplinks" style="margin-top:16px;">
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn btn--ghost" style="width:auto; padding:8px 16px">Logout</button>
        </form>
    </div>
@endsection
