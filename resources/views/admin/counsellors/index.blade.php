@extends('layout.admin')

@section('title', 'Counsellors')
@section('header', 'Manage Counsellors')

@section('content')
    <div class="admin-card">
        <form method="GET" action="{{ route('admin.counsellors.index') }}" class="filter-bar">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or organization..." style="padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14); min-width: 200px;">
            <select name="status">
                <option value="">All statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.counsellors.index') }}" class="btn btn-outline">Clear</a>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Organization</th>
                    <th>Experience</th>
                    <th>Verification</th>
                    <th>Assigned students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($counsellors as $p)
                    <tr>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->organization_name }}</td>
                        <td>{{ $p->experience_years }} yrs</td>
                        <td>
                            @if($p->verification_status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($p->verification_status === 'approved')
                                <span class="badge badge-approved">Approved</span>
                            @else
                                <span class="badge badge-rejected">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $p->assignedStudents()->count() }}</td>
                        <td>
                            <a href="{{ route('admin.counsellors.show', $p) }}" class="btn btn-primary btn-sm">Review</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--muted); padding: 24px;">No counsellors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($counsellors->hasPages())
            <div class="pagination">
                @if($counsellors->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $counsellors->previousPageUrl() }}">Previous</a>
                @endif
                @foreach($counsellors->getUrlRange(1, $counsellors->lastPage()) as $page => $url)
                    @if($page == $counsellors->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if($counsellors->hasMorePages())
                    <a href="{{ $counsellors->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
@endsection
