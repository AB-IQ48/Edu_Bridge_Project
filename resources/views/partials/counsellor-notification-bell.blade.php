@php
    $ebNCount = (int) ($counsellorUnreadNotificationsCount ?? (
        auth()->check() && auth()->user()->isCounsellor()
            ? auth()->user()->unreadNotifications()->count()
            : 0
    ));
@endphp
<a href="{{ route('counsellor.notifications.index') }}" class="eb-notify-bell-link" aria-label="Notifications{{ $ebNCount > 0 ? ' ('.$ebNCount.' unread)' : '' }}">
    <span class="eb-notify-bell-text">Notifications</span>
    @if($ebNCount > 0)
        <span class="eb-notify-badge">{{ $ebNCount > 99 ? '99+' : $ebNCount }}</span>
    @endif
</a>
