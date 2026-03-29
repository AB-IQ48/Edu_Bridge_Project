@extends('layout.header')

@section('title', 'Reset password | EduBridge')

@section('content')
  <div class="page-shell">
    <div class="page-card">
      <h1>Reset Password</h1>
      <p class="sub">Create a new password for your account.</p>

      @if ($errors->any())
        <div class="error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="grid" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="grid">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email', $email) }}" required autocomplete="email">
        </div>

        <div class="row">
          <div class="grid">
            <label for="password">New Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
          </div>
          <div class="grid">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
          </div>
        </div>

        <button class="btn" type="submit">Reset Password</button>
      </form>

      <div class="toplinks">
        <a href="{{ route('login') }}">Back to login</a>
        <a href="{{ route('password.request') }}">Request a new reset link</a>
      </div>
    </div>
  </div>
@endsection
