@extends('layout.admin')

@section('title', 'Counsellor — ' . $profile->user->name)
@section('header', 'Counsellor: ' . $profile->user->name)

@section('content')
    <div class="admin-card">
        <h2>Profile</h2>
        <table class="data-table">
            <tr>
                <th style="width: 180px;">Name</th>
                <td>{{ $profile->user->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $profile->user->email }}</td>
            </tr>
            <tr>
                <th>Organization</th>
                <td>{{ $profile->organization_name }}</td>
            </tr>
            <tr>
                <th>Experience</th>
                <td>{{ $profile->experience_years }} years</td>
            </tr>
            <tr>
                <th>Verification status</th>
                <td>
                    @if($profile->verification_status === 'pending')
                        <span class="badge badge-pending">Pending</span>
                    @elseif($profile->verification_status === 'approved')
                        <span class="badge badge-approved">Approved</span>
                    @else
                        <span class="badge badge-rejected">Rejected</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Rejection reason</th>
                <td>{{ $profile->rejection_reason ?: '—' }}</td>
            </tr>
            <tr>
                <th>Reviewed at</th>
                <td>{{ $profile->reviewed_at?->format('M j, Y H:i') ?: '—' }}</td>
            </tr>
            <tr>
                <th>Reviewed by</th>
                <td>{{ $profile->reviewedBy?->name ?: '—' }}</td>
            </tr>
            <tr>
                <th>Assigned students</th>
                <td>{{ $profile->assignedStudents()->count() }}</td>
            </tr>
        </table>

        <div class="btn-group" style="margin-top: 16px;">
            @if($profile->verification_status !== 'approved')
                <form method="POST" action="{{ route('admin.profiles.review', $profile) }}" style="display:inline">@csrf<input type="hidden" name="verification_status" value="approved"><button type="submit" class="btn btn-primary">Approve counsellor</button></form>
            @endif
            @if($profile->verification_status !== 'rejected')
                <form method="POST" action="{{ route('admin.profiles.review', $profile) }}" style="display:inline-grid; gap:8px; min-width: 300px;" onsubmit="return confirm('Reject this counsellor? They will no longer appear as verified.');">@csrf<input type="hidden" name="verification_status" value="rejected"><input type="text" name="rejection_reason" placeholder="Rejection reason (required)" required maxlength="1000" style="padding:8px 10px; border-radius:6px; border:1px solid rgba(0,0,0,0.15);"><button type="submit" class="btn btn-danger">Deny counsellor</button></form>
            @endif
        </div>
    </div>

    <div class="admin-card" id="documents">
        <h2>Verification documents</h2>
        @if($profile->documents->isEmpty())
            <p style="color: var(--muted);">No documents uploaded.</p>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Document name</th>
                        <th>Status</th>
                        <th>Uploaded</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profile->documents as $doc)
                        <tr id="doc-{{ $doc->id }}">
                            <td>{{ $doc->document_name }}</td>
                            <td>
                                @if($doc->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($doc->status === 'approved')
                                    <span class="badge badge-approved">Approved</span>
                                @else
                                    <span class="badge badge-rejected">Rejected</span>
                                @endif
                            </td>
                            <td>{{ $doc->created_at->format('M j, Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    @if($doc->status !== 'approved')
                                        <form method="POST" action="{{ route('admin.documents.review', $doc) }}" style="display:inline">@csrf<input type="hidden" name="status" value="approved"><button type="submit" class="btn btn-primary btn-sm">Approve</button></form>
                                    @endif
                                    @if($doc->status !== 'rejected')
                                        <form method="POST" action="{{ route('admin.documents.review', $doc) }}" style="display:inline-grid; gap:6px;">@csrf<input type="hidden" name="status" value="rejected"><input type="text" name="rejection_reason" placeholder="Reason (required)" required maxlength="1000" style="padding:6px 8px; border-radius:6px; border:1px solid rgba(0,0,0,0.15); min-width:190px;"><button type="submit" class="btn btn-danger btn-sm">Deny</button></form>
                                    @endif
                                </div>
                                @if($doc->rejection_reason)
                                    <div style="font-size:.8rem; color: var(--danger); margin-top:6px;">Reason: {{ $doc->rejection_reason }}</div>
                                @endif
                                @if($doc->reviewed_at || $doc->reviewedBy)
                                    <div style="font-size:.78rem; color: var(--muted); margin-top:4px;">
                                        Reviewed {{ $doc->reviewed_at?->format('M j, Y H:i') ?: '—' }} by {{ $doc->reviewedBy?->name ?: '—' }}
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <p><a href="{{ route('admin.counsellors.index') }}" class="btn btn-outline">← Back to counsellors list</a></p>
@endsection
