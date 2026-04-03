<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounsellorNotificationController extends Controller
{
    public function index(Request $request): View
    {
        $notifications = $request->user()->notifications()->paginate(25);

        return view('counsellor.notifications.index', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark one notification read and send the user to the related screen.
     */
    public function open(Request $request, string $id): RedirectResponse
    {
        $notification = $request->user()->notifications()->where('id', $id)->first();
        abort_unless($notification, 404);

        if ($notification->unread()) {
            $notification->markAsRead();
        }

        $raw = data_get($notification->data, 'action_url');
        $url = $this->safeInAppRedirectUrl(is_string($raw) ? $raw : null);

        return redirect()->to($url);
    }

    public function readAll(Request $request): RedirectResponse
    {
        $request->user()->unreadNotifications->markAsRead();

        return back()->with('message', 'All notifications marked as read.');
    }

    /**
     * Only allow redirects to this application (avoid open redirects from tampered data).
     */
    private function safeInAppRedirectUrl(?string $url): string
    {
        $fallback = route('counsellor.index');
        if ($url === null || trim($url) === '') {
            return $fallback;
        }

        $appUrl = rtrim((string) config('app.url'), '/');

        if (str_starts_with($url, $appUrl)) {
            return $url;
        }

        if (str_starts_with($url, '/')) {
            return url($url);
        }

        return $fallback;
    }
}
