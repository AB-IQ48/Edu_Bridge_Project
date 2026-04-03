<p class="role-badge-inline" style="margin-bottom:10px;">{{ $panel === 'student' ? 'Student' : 'Counsellor' }}</p>
<h1>My complaints</h1>
<p class="sub">Reports you have sent to EduBridge. We review them in line with our <a href="{{ route('pages.complaints') }}">complaint policy</a>.</p>

<div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:18px;">
    <a href="{{ route($panel.'.complaints.create') }}" class="btn btn--sage" style="width:auto; padding:10px 18px; font-size:0.88rem;">+ New complaint</a>
    <a href="{{ $panel === 'student' ? route('student.index') : route('counsellor.index') }}" class="toplinks" style="margin:0; align-self:center;">Back to dashboard</a>
</div>

@forelse($complaints as $c)
    <div style="margin-bottom:12px; padding:16px 18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:#fff;">
        <div style="display:flex; flex-wrap:wrap; justify-content:space-between; gap:10px; align-items:flex-start;">
            <div>
                <strong><a href="{{ route($panel.'.complaints.show', $c) }}" style="color:var(--sage, #4a7c6b); font-weight:700;">{{ $c->subject }}</a></strong>
                <div style="font-size:0.82rem; color:var(--muted); margin-top:6px;">
                    {{ \App\Models\Complaint::categories()[$c->category] ?? $c->category }}
                    · {{ $c->created_at->format('M j, Y') }}
                </div>
            </div>
            @php
                $st = $c->status;
                $chipClass = $st === 'resolved' ? 'chip--ok' : ($st === 'closed' ? 'chip--muted' : ($st === 'in_review' ? 'chip--warn' : 'chip--danger'));
            @endphp
            <span class="chip {{ $chipClass }}" style="text-transform:capitalize;">{{ str_replace('_', ' ', $st) }}</span>
        </div>
    </div>
@empty
    <p style="color:var(--muted); padding:24px 0;">You have not submitted any complaints yet.</p>
@endforelse

@if($complaints->hasPages())
    <div style="margin-top:16px;">{{ $complaints->links() }}</div>
@endif
