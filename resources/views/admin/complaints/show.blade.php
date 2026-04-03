@extends('layout.admin')

@section('title', 'Complaint')
@section('header', 'Complaint detail')

@section('content')
    <div class="admin-card">
        <p style="color: var(--muted); font-size: 0.88rem; margin-bottom: 16px;">
            <strong>{{ ucfirst($complaint->submitter_role) }}</strong>
            · Submitted {{ $complaint->created_at->format('M j, Y H:i') }}
            @if($complaint->submitter)
                · <a href="mailto:{{ $complaint->submitter->email }}" class="table-link">{{ $complaint->submitter->name }}</a>
                ({{ $complaint->submitter->email }})
            @endif
        </p>
        <h2 style="font-size: 1.05rem; margin-bottom: 8px;">{{ $complaint->subject }}</h2>
        <p style="color: var(--muted); margin-bottom: 16px;">{{ \App\Models\Complaint::categories()[$complaint->category] ?? $complaint->category }}</p>
        <div style="padding: 16px; border-radius: 10px; background: var(--cream); border: 1px solid rgba(0,0,0,0.06); margin-bottom: 24px;">
            <div style="font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; color: var(--muted); margin-bottom: 8px;">Report</div>
            <div style="white-space: pre-wrap; font-size: 0.9rem; line-height: 1.6;">{{ $complaint->body }}</div>
        </div>

        <h2 style="font-size: 1.05rem; margin-bottom: 12px;">Update status</h2>
        <form method="POST" action="{{ route('admin.complaints.update', $complaint) }}" class="filter-bar" style="flex-direction: column; align-items: stretch; max-width: 640px;">
            @csrf
            <div>
                <label for="status" style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Status</label>
                <select id="status" name="status" style="width:100%; padding: 8px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14);">
                    <option value="pending" @selected($complaint->status === 'pending')>Pending</option>
                    <option value="in_review" @selected($complaint->status === 'in_review')>In review</option>
                    <option value="resolved" @selected($complaint->status === 'resolved')>Resolved</option>
                    <option value="closed" @selected($complaint->status === 'closed')>Closed</option>
                </select>
            </div>
            <div>
                <label for="admin_response" style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:6px;">Response to user (optional, visible in their panel)</label>
                <textarea id="admin_response" name="admin_response" rows="6" maxlength="5000" style="width:100%; padding: 10px 12px; border-radius: 6px; border: 1px solid rgba(0,0,0,0.14);">{{ old('admin_response', $complaint->admin_response) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="align-self: flex-start;">Save</button>
        </form>
    </div>
    <p><a href="{{ route('admin.complaints.index') }}" class="btn btn-outline">← All complaints</a></p>
@endsection
