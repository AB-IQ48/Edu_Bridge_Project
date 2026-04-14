<p class="role-badge-inline" style="margin-bottom:10px;">{{ $panel === 'student' ? 'Student' : 'Counsellor' }}</p>
<h1>My complaints</h1>
<p class="sub">Reports you have sent to EduBridge. We review them in line with our <a href="{{ route('pages.complaints') }}">complaint policy</a>.</p>

<div class="eb-complaints-actions">
    <a href="{{ route($panel.'.complaints.create') }}" class="btn btn--sage" style="width:auto; padding:10px 18px; font-size:0.88rem;">+ New complaint</a>
    <a href="{{ $panel === 'student' ? route('student.index') : route('counsellor.index') }}" class="toplinks" style="margin:0; align-self:center;">Back to dashboard</a>
</div>

@forelse($complaints as $c)
    @php
        $st = $c->status;
        $chipClass = $st === 'resolved' ? 'chip--ok' : ($st === 'closed' ? 'chip--muted' : ($st === 'in_review' ? 'chip--warn' : 'chip--danger'));
    @endphp
    <a href="{{ route($panel.'.complaints.show', $c) }}" class="eb-complaint-card">
        <div class="eb-complaint-top">
            <div style="min-width:0; flex: 1;">
                <div class="eb-complaint-title" style="white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $c->subject }}</div>
                <div class="eb-complaint-meta">
                    {{ \App\Models\Complaint::categories()[$c->category] ?? $c->category }}
                    · {{ $c->created_at->format('M j, Y') }}
                </div>
            </div>
            <span class="chip {{ $chipClass }}" style="text-transform:capitalize; white-space:nowrap;">{{ str_replace('_', ' ', $st) }}</span>
        </div>
        @if($c->admin_response)
            <div class="eb-complaint-body">Admin response: {{ $c->admin_response }}</div>
        @else
            <div class="eb-complaint-body">No admin response yet.</div>
        @endif
    </a>
@empty
    <p style="color:var(--muted); padding:24px 0;">You have not submitted any complaints yet.</p>
@endforelse

@if($complaints->hasPages())
    <div style="margin-top:16px;">{{ $complaints->links() }}</div>
@endif
