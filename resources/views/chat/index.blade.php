@extends('layout.auth')

@section('title', 'Chat')

@push('auth_styles')
<style>
    .chat-shell { display:grid; grid-template-columns: 260px 1fr; gap:14px; }
    .chat-col { border:1px solid rgba(0,0,0,.09); border-radius:12px; padding:12px; background:#fff; box-shadow:0 4px 12px rgba(0,0,0,.05); }
    .chat-contact { display:block; margin-bottom:6px; padding:9px; border-radius:8px; text-decoration:none; color:var(--ink); border:1px solid transparent; }
    .chat-contact:hover { background:#f8fafc; border-color:rgba(74,124,107,.2); }
    .chat-box { height:360px; overflow:auto; border:1px solid rgba(0,0,0,.08); border-radius:10px; padding:12px; margin-bottom:10px; background:#f8faf8; }
    .chat-status { font-size:.75rem; }
    .chat-status--on { color:#15803d; }
    .chat-status--off { color:var(--muted); }
    .chat-unread { float:right; min-width:20px; text-align:center; font-size:.72rem; padding:2px 6px; border-radius:999px; background:#dc2626; color:#fff; font-weight:700; }
    @media (max-width: 860px) { .chat-shell { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
    <h1>Student-Counsellor Chat</h1>
    <p class="sub">Secure direct messaging between assigned students and counsellors.</p>
    @if(($totalUnread ?? 0) > 0)
        <p class="hint" style="margin-bottom:8px;">Unread messages: <strong>{{ $totalUnread }}</strong></p>
    @endif

    <div class="chat-shell">
        <div class="chat-col">
            <strong style="display:block; margin-bottom:8px;">Contacts</strong>
            @forelse($contacts as $contact)
                <a href="{{ route('chat.show', $contact) }}"
                   class="chat-contact"
                   style="background: {{ $selectedUser && $selectedUser->id === $contact->id ? 'rgba(74,124,107,0.12)' : 'transparent' }};">
                    {{ $contact->name }}
                    @if(!empty($onlineMap[$contact->id]))
                        <span class="chat-status chat-status--on">● online</span>
                    @else
                        <span class="chat-status chat-status--off">● offline</span>
                    @endif
                    @if(($unreadByContact[$contact->id] ?? 0) > 0)
                        <span class="chat-unread">
                            {{ $unreadByContact[$contact->id] }}
                        </span>
                    @endif
                </a>
            @empty
                <p class="hint">No contact available yet.</p>
            @endforelse
        </div>

        <div class="chat-col">
            @if($selectedUser)
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                    <strong>Conversation with {{ $selectedUser->name }}</strong>
                    @if(!empty($onlineMap[$selectedUser->id]))
                        <span style="font-size:.78rem; color:#15803d;">● online now</span>
                    @else
                        <span style="font-size:.78rem; color:var(--muted);">● offline</span>
                    @endif
                </div>

                <div class="chat-box">
                    @forelse($messages as $msg)
                        @php $mine = $msg->sender_id === auth()->id(); @endphp
                        <div style="display:flex; justify-content: {{ $mine ? 'flex-end' : 'flex-start' }}; margin-bottom:8px;">
                            <div style="max-width:75%; padding:8px 10px; border-radius:8px; background: {{ $mine ? '#d9f3ea' : '#fff' }}; border:1px solid rgba(0,0,0,0.08);">
                                <div style="font-size:.92rem;">{{ $msg->message }}</div>
                                <div class="hint" style="margin-top:4px; font-size:.75rem;">
                                    {{ $msg->created_at->format('M j, H:i') }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="hint">No messages yet. Start the conversation.</p>
                    @endforelse
                </div>

                <form method="POST" action="{{ route('chat.store', $selectedUser) }}">
                    @csrf
                    <div class="grid">
                        <textarea name="message" rows="3" maxlength="2000" required placeholder="Type your message..."></textarea>
                    </div>
                    <button type="submit" class="btn" style="margin-top:8px;">Send</button>
                </form>
            @else
                <p class="hint">No active chat yet. Students: attach with a counsellor first. Counsellors: wait for students to attach.</p>
            @endif
        </div>
    </div>

    <div class="toplinks" style="margin-top:16px;">
        @if(auth()->user()->isStudent())
            <a href="{{ route('student.index') }}">Back to student dashboard</a>
        @elseif(auth()->user()->isCounsellor())
            <a href="{{ route('counsellor.index') }}">Back to counsellor dashboard</a>
        @endif
    </div>
@endsection
