@extends('layout.header')

@section('title', 'Forgot password | EduBridge')

@section('content')
  <div class="page-shell">
    <div class="page-card">
      <h1>Forgot Password</h1>
      <p class="sub">Enter your account email and we will send a password reset link.</p>

      @if (session('status'))
        <div class="hint" style="margin-bottom:12px; color: var(--sage); font-weight: 600;">
          {{ session('status') }}
        </div>
      @endif

      @if (session('dev_reset_link'))
        <div class="hint" style="margin-bottom:12px; padding: 10px 12px; border: 1px solid rgba(74,124,107,0.3); border-radius: 8px; background: rgba(74,124,107,0.08); color: var(--ink);">
          <strong>Reset link (local testing):</strong>
          <a href="{{ session('dev_reset_link') }}" style="word-break: break-all;">{{ session('dev_reset_link') }}</a>
        </div>
      @endif

      @if ($errors->any())
        <div class="error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="grid" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="grid">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
        </div>

        <button class="btn" type="submit">Send Reset Link</button>
      </form>

      <div class="toplinks">
        <a href="{{ route('login') }}">Back to login</a>
        <a href="{{ route('register.student') }}">Register as Student</a>
      </div>
    </div>
  </div>
@endsection
