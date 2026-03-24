@extends('layout.admin')

@section('title', 'Documents')
@section('header', 'Manage Documents')

@section('content')
    <div class="admin-card">
        <form method="GET" action="{{ route('admin.documents.index') }}" class="filter-bar">
            <select name="status">
                <option value="">All statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.documents.index') }}" class="btn btn-outline">Clear</a>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Document name</th>
                    <th>Counsellor</th>
                    <th>Organization</th>
                    <th>Status</th>
                    <th>Uploaded</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $d)
                    <tr>
                        <td>{{ $d->document_name }}</td>
                        <td>{{ $d->counsellorProfile->user->name }}</td>
                        <td>{{ $d->counsellorProfile->organization_name }}</td>
                        <td>
                            @if($d->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($d->status === 'approved')
                                <span class="badge badge-approved">Approved</span>
                            @else
                                <span class="badge badge-rejected">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $d->created_at->format('M j, Y H:i') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.counsellors.show', $d->counsellorProfile) }}#doc-{{ $d->id }}" class="btn btn-outline btn-sm">View counsellor</a>
                                @if($d->status !== 'approved')
                                    <form method="POST" action="{{ route('admin.documents.review', $d) }}" style="display:inline">@csrf<input type="hidden" name="status" value="approved"><button type="submit" class="btn btn-primary btn-sm">Approve</button></form>
                                @endif
                                @if($d->status !== 'rejected')
                                    <form method="POST" action="{{ route('admin.documents.review', $d) }}" style="display:inline-grid; gap:6px;">@csrf<input type="hidden" name="status" value="rejected"><input type="text" name="rejection_reason" placeholder="Reason (required)" required maxlength="1000" style="padding:6px 8px; border-radius:6px; border:1px solid rgba(0,0,0,0.15); min-width:190px;"><button type="submit" class="btn btn-danger btn-sm">Deny</button></form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--muted); padding: 24px;">No documents found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($documents->hasPages())
            <div class="pagination">
                @if($documents->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $documents->previousPageUrl() }}">Previous</a>
                @endif
                @foreach($documents->getUrlRange(1, $documents->lastPage()) as $page => $url)
                    @if($page == $documents->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if($documents->hasMorePages())
                    <a href="{{ $documents->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
@endsection
