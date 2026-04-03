<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = (bool) $request->boolean('remember');

        if (! Auth::attempt($credentials, $remember)) {
            return back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $user->loadMissing('role');

        $intended = $request->session()->pull('url.intended', null);
        if (is_string($intended) && $intended !== '') {
            $base = rtrim((string) config('app.url'), '/');
            if (str_starts_with($intended, $base) || str_starts_with($intended, '/')) {
                return redirect()->to($intended)->with('message', 'Welcome back. You are logged in.');
            }
        }

        return match ($user->role?->name) {
            'administrator' => redirect()->route('admin.index')->with('message', 'Welcome back, admin.'),
            'counsellor' => redirect()->route('counsellor.index')->with('message', 'Welcome back to your counsellor dashboard.'),
            'student' => redirect()->route('student.index')->with('message', 'Welcome back to your student dashboard.'),
            default => redirect()->route('dashboard')->with('message', 'Welcome back.'),
        };
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'You have logged out successfully.');
    }
}

