@extends('layout.admin')

@section('title', 'Complaints')
@section('header', 'User complaints')

@section('content')
    <div class="admin-card">
        <form method="GET" action="{{ route('admin.complaints.index') }}" class="filter-bar">
            <select name="status">
                <option value="">All statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_review" {{ request('status') === 'in_review' ? 'selected' : '' }}>In review</option>
                <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search subject, body, user…" style="padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14); min-width: 220px;">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.complaints.index') }}" class="btn btn-outline">Clear</a>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Submitted</th>
                    <th>Role</th>
                    <th>User</th>
                    <th>Subject</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($complaints as $c)
                    <tr>
                        <td>{{ $c->created_at->format('M j, Y H:i') }}</td>
                        <td>{{ ucfirst($c->submitter_role) }}</td>
                        <td>
                            @if($c->submitter)
                                <a href="mailto:{{ $c->submitter->email }}" class="table-link">{{ $c->submitter->name }}</a>
                            @else
                                {{ $c->guest_name ?? 'Guest' }}
                            @endif
                        </td>
                        <td><a href="{{ route('admin.complaints.show', $c) }}" class="table-link">{{ \Illuminate\Support\Str::limit($c->subject, 60) }}</a></td>
                        <td>
                            @if($c->status === 'pending')
                                <span class="badge badge-pending">Pending</span>
                            @elseif($c->status === 'in_review')
                                <span class="badge" style="background: rgba(59,130,246,0.15); color: #1d4ed8;">In review</span>
                            @elseif($c->status === 'resolved')
                                <span class="badge badge-approved">Resolved</span>
                            @else
                                <span class="badge badge-rejected">Closed</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--muted); padding: 24px;">No complaints found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($complaints->hasPages())
            <div class="pagination">
                @if($complaints->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $complaints->previousPageUrl() }}">Previous</a>
                @endif
                @foreach($complaints->getUrlRange(1, $complaints->lastPage()) as $page => $url)
                    @if($page == $complaints->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if($complaints->hasMorePages())
                    <a href="{{ $complaints->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
@endsection
