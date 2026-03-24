@extends('layout.header')

@section('title', 'Counsellor Registration — EduBridge')

@section('content')
  <div class="page-shell">
    <div class="page-card">
      <h1>Counsellor Registration</h1>
      <p class="sub">Create a counsellor account. Your profile and verification documents will be reviewed by an administrator before you appear as verified — structured workflow for digital trust.</p>

      @if ($errors->any())
        <div class="error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="grid" method="POST" action="{{ route('register.company.store') }}">
        @csrf

        <div class="grid">
          <label for="organization_name">Organization name</label>
          <input id="organization_name" name="organization_name" type="text" value="{{ old('organization_name') }}" required>
        </div>

        <div class="grid">
          <label for="experience_years">Years of experience (optional)</label>
          <input id="experience_years" name="experience_years" type="number" min="0" max="70" value="{{ old('experience_years') }}" placeholder="0">
        </div>

        <hr style="border:none;border-top:1px solid rgba(0,0,0,0.08);margin:8px 0 4px">
        <p class="sub" style="margin:0 0 8px">Account credentials</p>

        <div class="row">
          <div class="grid">
            <label for="name">Contact person name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name">
          </div>
          <div class="grid">
            <label for="email">Login email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
          </div>
        </div>

        <div class="row">
          <div class="grid">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
          </div>
          <div class="grid">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
          </div>
        </div>

        <button class="btn" type="submit">Create Counsellor Account</button>
      </form>

      <div class="toplinks">
        <a href="{{ route('login') }}">Already have an account? Login</a>
        <a href="{{ route('register.student') }}">Register as Student</a>
        <a href="{{ route('password.request') }}">Forgot password?</a>
      </div>
    </div>
  </div>
@endsection

