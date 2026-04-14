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

<div class="eb-complaint-box">
    <div class="eb-complaint-box__label">Your message</div>
    <div class="eb-complaint-box__text">{{ $complaint->body }}</div>
</div>

@if($complaint->admin_response)
    <div class="eb-complaint-box eb-complaint-box--response">
        <div class="eb-complaint-box__label">Response from EduBridge</div>
        <div class="eb-complaint-box__text">{{ $complaint->admin_response }}</div>
        @if($complaint->handled_at)
            <div class="hint" style="margin-top:12px;">Updated {{ $complaint->handled_at->format('M j, Y g:i A') }}</div>
        @endif
    </div>
@else
    <p class="eb-complaint-note">No admin response yet. We will update this when we have reviewed your report.</p>
@endif

<a href="{{ route($panel.'.complaints.index') }}" class="toplinks">← All complaints</a>
