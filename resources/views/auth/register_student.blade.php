@extends('layout.header')

@section('title', 'Student registration | EduBridge')

@section('content')
  <div class="page-shell">
    <div class="page-card">
      <h1>Student Registration</h1>
      <p class="sub">Create a student account. You will have role-based access as a Student: visa scoring, documents, and verified counsellor matching.</p>

      @if ($errors->any())
        <div class="error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form class="grid" method="POST" action="{{ route('register.student.store') }}">
        @csrf

        <div class="grid">
          <label for="name">Name</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name">
        </div>

        <div class="grid">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">
        </div>

        <div class="row">
          <div class="grid">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
            <div class="hint">Use a strong password (Laravel default complexity).</div>
          </div>
          <div class="grid">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
          </div>
        </div>

        <button class="btn" type="submit">Create Student Account</button>
      </form>

      <div class="toplinks">
        <a href="{{ route('login') }}">Already have an account? Login</a>
        <a href="{{ route('register.company') }}">Register as Counsellor</a>
        <a href="{{ route('password.request') }}">Forgot password?</a>
      </div>
    </div>
  </div>
@endsection

