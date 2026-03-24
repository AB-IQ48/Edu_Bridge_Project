<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ForgotPasswordController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        try {
            $status = Password::sendResetLink(
                $request->only('email')
            );
        } catch (TransportExceptionInterface $e) {
            // Student-project friendly local fallback: show direct reset URL if mail server is not configured.
            if (App::environment('local')) {
                $user = User::where('email', $request->input('email'))->first();

                if ($user) {
                    $token = Password::broker()->createToken($user);
                    $resetUrl = route('password.reset', [
                        'token' => $token,
                        'email' => $user->email,
                    ]);

                    return back()->with([
                        'status' => 'Mail server is not configured locally. Use the reset link below for testing.',
                        'dev_reset_link' => $resetUrl,
                    ]);
                }
            }

            return back()->withErrors([
                'email' => 'Unable to send reset email right now. Please check MAIL_HOST / MAIL_MAILER in .env.',
            ]);
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
