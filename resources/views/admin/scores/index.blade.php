@extends('layout.admin')

@section('title', 'Visa scores')
@section('header', 'Student visa readiness scores')

@section('content')
    <div class="admin-card">
        <p style="color: var(--muted); font-size: 0.9rem; margin-bottom: 16px;">Read-only overview of assessments submitted by students.</p>
        <form method="GET" action="{{ route('admin.scores.index') }}" class="filter-bar">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by student name or email..." style="padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14); min-width: 240px;">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('admin.scores.index') }}" class="btn btn-outline">Clear</a>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Destination</th>
                    <th>Total</th>
                    <th>Band</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($scores as $score)
                    <tr>
                        <td>
                            @if($score->student)
                                <a href="mailto:{{ $score->student->email }}" class="table-link">{{ $score->student->name }}</a>
                            @else
                                <span style="color: var(--muted);">-</span>
                            @endif
                        </td>
                        <td>{{ $score->destination_label ?? '-' }}</td>
                        <td><strong>{{ $score->total_score }}</strong></td>
                        <td><span class="badge badge-approved">{{ $score->band }}</span></td>
                        <td>{{ $score->created_at->format('M j, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--muted); padding: 24px;">No scores found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($scores->hasPages())
            <div class="pagination">
                @if($scores->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $scores->previousPageUrl() }}">Previous</a>
                @endif
                @foreach($scores->getUrlRange(1, $scores->lastPage()) as $page => $url)
                    @if($page == $scores->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
                @if($scores->hasMorePages())
                    <a href="{{ $scores->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
@endsection
