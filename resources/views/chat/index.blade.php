@extends('layout.auth')

@section('title', 'Chat')

@section('content')
    <h1>Student-Counsellor Chat</h1>
    <p class="sub">Secure direct messaging between assigned students and counsellors.</p>

    @if (session('message'))
        <p class="error" style="background: rgba(74,124,107,0.15); color: var(--sage); border-color: var(--sage);">{{ session('message') }}</p>
    @endif

    <div style="display:grid; grid-template-columns: 220px 1fr; gap:14px;">
        <div style="border:1px solid rgba(0,0,0,0.1); border-radius:8px; padding:10px; background:#fff;">
            <strong style="display:block; margin-bottom:8px;">Contacts</strong>
            @forelse($contacts as $contact)
                <a href="{{ route('chat.show', $contact) }}"
                   style="display:block; margin-bottom:6px; padding:8px; border-radius:6px; text-decoration:none; color:var(--ink); background: {{ $selectedUser && $selectedUser->id === $contact->id ? 'rgba(74,124,107,0.12)' : 'transparent' }};">
                    {{ $contact->name }}
                </a>
            @empty
                <p class="hint">No contact available yet.</p>
            @endforelse
        </div>

        <div style="border:1px solid rgba(0,0,0,0.1); border-radius:8px; padding:10px; background:#fff;">
            @if($selectedUser)
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                    <strong>Conversation with {{ $selectedUser->name }}</strong>
                </div>

                <div style="height:320px; overflow:auto; border:1px solid rgba(0,0,0,0.08); border-radius:8px; padding:10px; margin-bottom:10px; background: #f8f8f8;">
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
