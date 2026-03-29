@extends('layout.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
    <a href="{{ route('admin.counsellors.index', ['status' => 'pending']) }}" class="admin-workflow-link hint" style="margin-bottom: 20px; padding: 12px 16px; background: rgba(74,124,107,0.1); border-radius: 10px; border: 1px solid rgba(74,124,107,.24); border-left: 4px solid var(--sage);">
        <strong>Verification workflow:</strong> Counsellors upload documents → you review and approve or reject. Profile verification and document visibility are updated only after your approval. Structured process for digital trust.
        <span style="display:block; margin-top:8px; font-size:0.82rem; color:var(--sage); font-weight:600;">Open pending counsellors →</span>
    </a>
    <div class="stat-grid" style="margin-bottom: 28px;">
        <a href="{{ route('admin.counsellors.index') }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box">
            <div class="num">{{ $stats['counsellors_total'] }}</div>
            <div class="label">Total Counsellors</div>
        </div>
        </a>
        <a href="{{ route('admin.counsellors.index', ['status' => 'pending']) }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box pending">
            <div class="num">{{ $stats['counsellors_pending'] }}</div>
            <div class="label">Pending Verification</div>
        </div>
        </a>
        <a href="{{ route('admin.counsellors.index', ['status' => 'approved']) }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box approved">
            <div class="num">{{ $stats['counsellors_approved'] }}</div>
            <div class="label">Approved Counsellors</div>
        </div>
        </a>
        <a href="{{ route('admin.counsellors.index', ['status' => 'rejected']) }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box rejected">
            <div class="num">{{ $stats['counsellors_rejected'] }}</div>
            <div class="label">Rejected</div>
        </div>
        </a>
        <a href="{{ route('admin.documents.index', ['status' => 'pending']) }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box pending">
            <div class="num">{{ $stats['documents_pending'] }}</div>
            <div class="label">Pending Documents</div>
        </div>
        </a>
        <a href="{{ route('admin.students.index') }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box">
            <div class="num">{{ $stats['students_total'] }}</div>
            <div class="label">Students</div>
        </div>
        </a>
        <a href="{{ route('admin.scores.index') }}" style="text-decoration:none; color:inherit;">
        <div class="stat-box">
            <div class="num">{{ $stats['scores_total'] }}</div>
            <div class="label">Visa Scores</div>
        </div>
        </a>
    </div>

    <div class="admin-card">
        <h2><a href="{{ route('admin.counsellors.index', ['status' => 'pending']) }}" class="admin-card-title-link">Pending profile verifications</a></h2>
        @if($pendingProfiles->isEmpty())
            <p style="color: var(--muted);">No pending profiles.</p>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Experience</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingProfiles as $p)
                        <tr>
                            <td><a href="{{ route('admin.counsellors.show', $p) }}" class="table-link">{{ $p->user->name }}</a></td>
                            <td><a href="{{ route('admin.counsellors.show', $p) }}" class="table-link">{{ $p->organization_name }}</a></td>
                            <td>{{ $p->experience_years }} yrs</td>
                            <td><span class="badge badge-pending">{{ $p->verification_status }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.counsellors.show', $p) }}" class="btn btn-outline btn-sm">View</a>
                                    <form method="POST" action="{{ route('admin.profiles.review', $p) }}" style="display:inline">@csrf<input type="hidden" name="verification_status" value="approved"><button type="submit" class="btn btn-primary btn-sm">Approve</button></form>
                                    <form method="POST" action="{{ route('admin.profiles.review', $p) }}" style="display:inline-grid; gap:6px;">@csrf<input type="hidden" name="verification_status" value="rejected"><input type="text" name="rejection_reason" placeholder="Reason (required)" required maxlength="1000" style="padding:6px 8px; border-radius:6px; border:1px solid rgba(0,0,0,0.15); min-width:190px;"><button type="submit" class="btn btn-danger btn-sm">Deny</button></form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin-top: 12px;"><a href="{{ route('admin.counsellors.index', ['status' => 'pending']) }}">View all pending counsellors →</a></p>
        @endif
    </div>

    <div class="admin-card">
        <h2><a href="{{ route('admin.documents.index', ['status' => 'pending']) }}" class="admin-card-title-link">Pending document reviews</a></h2>
        @if($pendingDocuments->isEmpty())
            <p style="color: var(--muted);">No pending documents.</p>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Counsellor</th>
                        <th>Status</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingDocuments as $d)
                        <tr>
                            <td><a href="{{ route('admin.counsellors.show', $d->counsellorProfile) }}#doc-{{ $d->id }}" class="table-link">{{ $d->document_name }}</a></td>
                            <td><a href="{{ route('admin.counsellors.show', $d->counsellorProfile) }}" class="table-link">{{ $d->counsellorProfile->user->name }} ({{ $d->counsellorProfile->organization_name }})</a></td>
                            <td><span class="badge badge-pending">{{ $d->status }}</span></td>
                            <td>
                                <a href="{{ route('admin.documents.file', $d) }}" class="btn btn-outline btn-sm" target="_blank" rel="noopener">Open file</a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.counsellors.show', $d->counsellorProfile) }}#doc-{{ $d->id }}" class="btn btn-outline btn-sm">Profile</a>
                                    <form method="POST" action="{{ route('admin.documents.review', $d) }}" style="display:inline">@csrf<input type="hidden" name="status" value="approved"><button type="submit" class="btn btn-primary btn-sm">Approve</button></form>
                                    <form method="POST" action="{{ route('admin.documents.review', $d) }}" style="display:inline-grid; gap:6px;">@csrf<input type="hidden" name="status" value="rejected"><input type="text" name="rejection_reason" placeholder="Reason (required)" required maxlength="1000" style="padding:6px 8px; border-radius:6px; border:1px solid rgba(0,0,0,0.15); min-width:190px;"><button type="submit" class="btn btn-danger btn-sm">Deny</button></form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p style="margin-top: 12px;"><a href="{{ route('admin.documents.index', ['status' => 'pending']) }}">View all pending documents →</a></p>
        @endif
    </div>
@endsection
