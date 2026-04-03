@extends('layout.auth')

@section('title', 'Notifications')

@push('auth_styles')
<style>
    .eb-notify-list { list-style: none; margin: 0; padding: 0; }
    .eb-notify-item {
        display: block;
        padding: 14px 16px;
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.08);
        margin-bottom: 10px;
        text-decoration: none;
        color: inherit;
        background: #fff;
        transition: border-color 0.15s, box-shadow 0.15s;
    }
    .eb-notify-item:hover {
        border-color: rgba(74,124,107,0.35);
        box-shadow: 0 6px 18px rgba(74,124,107,0.08);
    }
    .eb-notify-item--unread {
        background: rgba(74,124,107,0.06);
        border-color: rgba(74,124,107,0.2);
    }
    .eb-notify-item__title { font-weight: 700; font-size: 0.95rem; margin-bottom: 4px; }
    .eb-notify-item__body { font-size: 0.88rem; color: #4b5563; line-height: 1.45; }
    .eb-notify-item__meta { font-size: 0.75rem; color: #9ca3af; margin-top: 8px; }
    .eb-notify-toolbar { display: flex; flex-wrap: wrap; gap: 10px; align-items: center; margin-bottom: 18px; }
    .eb-notify-empty { color: #6b7280; font-size: 0.92rem; padding: 24px 0; text-align: center; }
</style>
@endpush

@section('content')
    <h1>Notifications</h1>
    <p class="sub">Chat, student connections, and verification updates. Unread items are highlighted.</p>

    <div class="eb-notify-toolbar">
        <a href="{{ route('counsellor.index') }}" class="toplinks" style="margin:0">Dashboard</a>
        @if(($counsellorUnreadNotificationsCount ?? 0) > 0)
            <form method="POST" action="{{ route('counsellor.notifications.read-all') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn" style="padding:8px 14px;font-size:0.85rem;cursor:pointer;border-radius:8px;border:1px solid rgba(0,0,0,0.14);background:var(--ink, #0d1117);color:#fff;font-weight:600;">Mark all read</button>
            </form>
        @endif
    </div>

    @if($notifications->isEmpty())
        <p class="eb-notify-empty">No notifications yet. You will see chat messages, student connections, and admin decisions here.</p>
    @else
        <ul class="eb-notify-list">
            @foreach($notifications as $n)
                @php
                    $data = $n->data;
                    $title = data_get($data, 'title', 'Update');
                    $body = data_get($data, 'body', '');
                    $unread = $n->unread();
                @endphp
                <li>
                    <a href="{{ route('counsellor.notifications.open', $n->id) }}" class="eb-notify-item {{ $unread ? 'eb-notify-item--unread' : '' }}">
                        <div class="eb-notify-item__title">{{ $title }}</div>
                        @if($body !== '')
                            <div class="eb-notify-item__body">{{ \Illuminate\Support\Str::limit($body, 220) }}</div>
                        @endif
                        <div class="eb-notify-item__meta">
                            {{ $n->created_at->format('M j, Y g:i A') }}
                            @if($unread)
                                <span> · Unread</span>
                            @endif
                            @if(data_get($data, 'action_label'))
                                <span> · {{ data_get($data, 'action_label') }}</span>
                            @endif
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        @if($notifications->hasPages())
            <div style="margin-top:20px;display:flex;gap:12px;flex-wrap:wrap;">
                @if($notifications->onFirstPage())
                    <span style="color:#9ca3af;">Previous</span>
                @else
                    <a href="{{ $notifications->previousPageUrl() }}">Previous</a>
                @endif
                @if($notifications->hasMorePages())
                    <a href="{{ $notifications->nextPageUrl() }}">Next</a>
                @else
                    <span style="color:#9ca3af;">Next</span>
                @endif
            </div>
        @endif
    @endif
@endsection
