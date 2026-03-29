@extends('layout.admin')

@section('title', 'Students')
@section('header', 'Registered students')

@section('content')
    <div class="admin-card">
        <form method="GET" action="{{ route('admin.students.index') }}" class="filter-bar">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name or email..." style="padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14); min-width: 220px;">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline">Clear</a>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $s)
                    <tr>
                        <td><a href="mailto:{{ $s->email }}" class="table-link">{{ $s->name }}</a></td>
                        <td><a href="mailto:{{ $s->email }}" class="table-link">{{ $s->email }}</a></td>
                        <td>{{ $s->created_at->format('M j, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; color: var(--muted); padding: 24px;">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($students->hasPages())
            <div class="pagination">
                @if($students->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $students->previousPageUrl() }}">Previous</a>
                @endif
                @foreach($students->getUrlRange(1, $students->lastPage()) as $page => $url)
                    @if($page == $students->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if($students->hasMorePages())
                    <a href="{{ $students->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
@endsection
