@extends('layout.header')

@section('title', 'Login — EduBridge')

@section('content')
  <div class="page-shell">
    <div class="page-card">
      <h1>Login</h1>
      <p class="sub">Sign in to your account.</p>

      @if ($errors->any())
        <div class="error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="grid" method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="grid">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
        </div>

        <div class="grid">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" required autocomplete="current-password">
        </div>

        <div class="inline">
          <input id="remember" name="remember" type="checkbox" value="1" style="width:auto">
          <label for="remember" style="font-weight:500">Remember me</label>
        </div>

        <button class="btn" type="submit">Login</button>
      </form>

      <div class="toplinks">
        <a href="{{ route('register.student') }}">Register as Student</a>
        <a href="{{ route('register.company') }}">Register as Counsellor</a>
      </div>
    </div>
  </div>
@endsection

