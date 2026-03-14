@extends('layout.auth')

@section('title', 'Edit profile')

@section('content')
    <h1>Edit profile</h1>
    <form class="grid" method="POST" action="{{ route('counsellor.profile.update') }}">
        @csrf
        @method('PUT')
        <div class="grid">
            <label for="organization_name">Organization name</label>
            <input id="organization_name" name="organization_name" value="{{ old('organization_name', $profile->organization_name) }}" required>
        </div>
        <div class="grid">
            <label for="experience_years">Years of experience</label>
            <input id="experience_years" name="experience_years" type="number" min="0" max="70" value="{{ old('experience_years', $profile->experience_years) }}">
        </div>
        <button class="btn" type="submit">Update</button>
    </form>
    <div class="toplinks" style="margin-top:16px">
        <a href="{{ route('counsellor.index') }}">Back to dashboard</a>
    </div>
@endsection
