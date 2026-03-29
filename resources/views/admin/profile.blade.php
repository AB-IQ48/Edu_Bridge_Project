@extends('layout.admin')

@section('title', 'Profile Settings')
@section('header', 'Admin Profile Settings')

@section('content')
    <div class="admin-card" style="max-width: 760px;">
        <h2><a href="{{ route('admin.index') }}" class="admin-card-title-link">Admin overview</a> · Update profile</h2>
        <p class="hint" style="margin-bottom: 14px; color: var(--muted);">Keep your admin credentials secure. Password change is optional.</p>

        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf
            @method('PUT')

            <div style="display:grid; gap: 14px;">
                <div>
                    <label for="name" style="display:block; font-weight:600; margin-bottom:6px;">Full name</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $admin->name) }}" required
                        style="width:100%; padding: 10px 12px; border:1px solid rgba(0,0,0,.15); border-radius: 6px;">
                </div>

                <div>
                    <label for="email" style="display:block; font-weight:600; margin-bottom:6px;">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $admin->email) }}" required
                        style="width:100%; padding: 10px 12px; border:1px solid rgba(0,0,0,.15); border-radius: 6px;">
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <label for="password" style="display:block; font-weight:600; margin-bottom:6px;">New password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password"
                            style="width:100%; padding: 10px 12px; border:1px solid rgba(0,0,0,.15); border-radius: 6px;">
                    </div>
                    <div>
                        <label for="password_confirmation" style="display:block; font-weight:600; margin-bottom:6px;">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                            style="width:100%; padding: 10px 12px; border:1px solid rgba(0,0,0,.15); border-radius: 6px;">
                    </div>
                </div>
            </div>

            <div class="btn-group" style="margin-top: 18px;">
                <button type="submit" class="btn btn-primary">Save profile</button>
                <a href="{{ route('admin.index') }}" class="btn btn-outline">Admin dashboard</a>
            </div>
        </form>
    </div>
@endsection
