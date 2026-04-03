<p class="role-badge-inline" style="margin-bottom:10px;">{{ $panel === 'student' ? 'Student' : 'Counsellor' }}</p>
<h1>{{ $complaint->subject }}</h1>
<p class="sub">
    {{ \App\Models\Complaint::categories()[$complaint->category] ?? $complaint->category }}
    · Submitted {{ $complaint->created_at->format('M j, Y g:i A') }}
</p>

@php
    $st = $complaint->status;
    $chipClass = $st === 'resolved' ? 'chip--ok' : ($st === 'closed' ? 'chip--muted' : ($st === 'in_review' ? 'chip--warn' : 'chip--danger'));
@endphp
<p style="margin-bottom:16px;"><span class="chip {{ $chipClass }}" style="text-transform:capitalize;">{{ str_replace('_', ' ', $st) }}</span></p>

<div style="padding:16px; border-radius:12px; border:1px solid rgba(0,0,0,0.08); background:#fafafa; margin-bottom:20px;">
    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--muted); margin-bottom:8px;">Your message</div>
    <div style="white-space:pre-wrap; font-size:0.92rem; line-height:1.6;">{{ $complaint->body }}</div>
</div>

@if($complaint->admin_response)
    <div style="padding:16px; border-radius:12px; border:1px solid rgba(74,124,107,0.25); background:rgba(74,124,107,0.06); margin-bottom:20px;">
        <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; color:var(--sage, #4a7c6b); margin-bottom:8px;">Response from EduBridge</div>
        <div style="white-space:pre-wrap; font-size:0.92rem; line-height:1.6;">{{ $complaint->admin_response }}</div>
        @if($complaint->handled_at)
            <div style="font-size:0.8rem; color:var(--muted); margin-top:12px;">Updated {{ $complaint->handled_at->format('M j, Y g:i A') }}</div>
        @endif
    </div>
@else
    <p style="color:var(--muted); font-size:0.9rem; margin-bottom:20px;">No admin response yet. We will update this when we have reviewed your report.</p>
@endif

<a href="{{ route($panel.'.complaints.index') }}" class="toplinks">← All complaints</a>
