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
        $url = $this->safeInAppRedirectUrl($request, is_string($raw) ? $raw : null);

        return redirect()->to($url);
    }

    public function readAll(Request $request): RedirectResponse
    {
        $request->user()->unreadNotifications->markAsRead();

        return back()->with('message', 'All notifications marked as read.');
    }

    /**
     * Only allow redirects to this application (avoid open redirects from tampered data).
     *
     * Accepts root-relative paths (/chat/1) and full URLs whose host matches this app
     * (fixes subdirectory / APP_URL mismatches where stored URLs no longer prefix-match config).
     */
    private function safeInAppRedirectUrl(Request $request, ?string $url): string
    {
        $fallback = route('counsellor.index');
        if ($url === null || ($url = trim($url)) === '') {
            return $fallback;
        }

        if (str_starts_with($url, '/')) {
            return url($url);
        }

        $appUrl = rtrim((string) config('app.url'), '/');
        if ($appUrl !== '' && str_starts_with($url, $appUrl)) {
            return $url;
        }

        $parsed = parse_url($url);
        if ($parsed === false) {
            return $fallback;
        }

        $appHost = parse_url($appUrl !== '' ? $appUrl : (string) config('app.url'), PHP_URL_HOST);
        $urlHost = isset($parsed['host']) ? (string) $parsed['host'] : null;
        if ($urlHost && $this->notificationUrlHostIsTrusted($request, $urlHost, $appHost)) {
            $path = $parsed['path'] ?? '';
            if ($path === '' || ! str_starts_with($path, '/')) {
                $path = '/'.ltrim((string) $path, '/');
            }
            $pathAndQuery = $path;
            if (isset($parsed['query'])) {
                $pathAndQuery .= '?'.$parsed['query'];
            }
            $target = url($pathAndQuery);
            if (isset($parsed['fragment'])) {
                $target .= '#'.$parsed['fragment'];
            }

            return $target;
        }

        return $fallback;
    }

    /**
     * @param  string|null  $appHost  Host from config('app.url'), if any.
     */
    private function notificationUrlHostIsTrusted(Request $request, string $urlHost, ?string $appHost): bool
    {
        $requestHost = $request->getHttpHost();

        foreach ([$appHost, $requestHost] as $candidate) {
            if ($candidate !== null && $candidate !== '' && strcasecmp($urlHost, $candidate) === 0) {
                return true;
            }
        }

        return $this->isLoopbackDevHost($urlHost)
            && $this->isLoopbackDevHost($requestHost);
    }

    private function isLoopbackDevHost(string $host): bool
    {
        $h = strtolower(str_replace(['[', ']'], '', $host));

        return in_array($h, ['localhost', '127.0.0.1', '::1'], true);
    }
}
