@extends('layout.auth')

@section('title', 'Edit public profile')

@section('card_class', 'card--xl')

@section('content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Counsellor profile</p>
    <h1>Your public profile</h1>
    <p class="sub">Students see this information on your <strong>dedicated profile page</strong> after you are verified. Keep it accurate to attract the right students.</p>

    @if ($errors->any())
        <div class="alert alert--error" style="margin-bottom:16px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="grid" method="POST" action="{{ route('counsellor.profile.update') }}">
        @csrf
        @method('PUT')

        <div style="padding:18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:linear-gradient(180deg,#fafafa,#fff); margin-bottom:8px;">
            <p style="margin:0 0 12px; font-weight:700; font-size:0.95rem;">Organisation</p>
            <div class="grid">
                <div class="grid">
                    <label for="organization_name">Organisation name</label>
                    <input id="organization_name" name="organization_name" value="{{ old('organization_name', $profile->organization_name) }}" required>
                </div>
                <div class="row">
                    <div class="grid">
                        <label for="city">City / region</label>
                        <input id="city" name="city" value="{{ old('city', $profile->city) }}" placeholder="e.g. Lahore">
                    </div>
                    <div class="grid">
                        <label for="experience_years">Years of experience</label>
                        <input id="experience_years" name="experience_years" type="number" min="0" max="70" value="{{ old('experience_years', $profile->experience_years) }}">
                    </div>
                </div>
            </div>
        </div>

        <div style="padding:18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:linear-gradient(180deg,#fafafa,#fff); margin-bottom:8px;">
            <p style="margin:0 0 12px; font-weight:700; font-size:0.95rem;">About you</p>
            <div class="grid">
                <div class="grid">
                    <label for="bio">Bio (shown to students)</label>
                    <textarea id="bio" name="bio" rows="5" placeholder="Your background, approach, and how you help students.">{{ old('bio', $profile->bio) }}</textarea>
                    <span class="hint">Max 5000 characters. Be clear about who you work best with.</span>
                </div>
                <div class="grid">
                    <label for="specializations">Specializations (comma or new line)</label>
                    <textarea id="specializations" name="specializations" rows="3" placeholder="e.g. UK masters, Canada SDS, scholarships, medicine">{{ old('specializations', $profile->specializations) }}</textarea>
                    <span class="hint">Examples: UK Undergraduate, Canada PGWP, Australia, US F-1</span>
                </div>
            </div>
        </div>

        <div style="padding:18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:linear-gradient(180deg,#fafafa,#fff); margin-bottom:8px;">
            <p style="margin:0 0 12px; font-weight:700; font-size:0.95rem;">Destinations & languages</p>
            <div class="grid">
                <div class="grid">
                    <label for="countries_served">Countries / regions (comma-separated)</label>
                    <input id="countries_served" name="countries_served" value="{{ old('countries_served', $profile->countries_served) }}" placeholder="e.g. United Kingdom, Canada, Australia">
                </div>
                <div class="grid">
                    <label for="languages">Languages (comma-separated)</label>
                    <input id="languages" name="languages" value="{{ old('languages', $profile->languages) }}" placeholder="e.g. English, Urdu">
                </div>
            </div>
        </div>

        <div style="padding:18px; border-radius:14px; border:1px solid rgba(0,0,0,0.08); background:linear-gradient(180deg,#fafafa,#fff); margin-bottom:8px;">
            <p style="margin:0 0 12px; font-weight:700; font-size:0.95rem;">Optional contact</p>
            <div class="row">
                <div class="grid">
                    <label for="phone">Phone (optional)</label>
                    <input id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" placeholder="+92 …">
                </div>
                <div class="grid">
                    <label for="website">Website (optional)</label>
                    <input id="website" name="website" value="{{ old('website', $profile->website) }}" placeholder="https://…">
                </div>
            </div>
        </div>

        <button class="btn btn--sage" type="submit">Save profile</button>
    </form>
    <div class="toplinks" style="margin-top:16px">
        @if($profile->verification_status === 'approved')
            <a href="{{ route('counsellors.show', $profile) }}">Preview public profile</a>
        @else
            <span class="hint" style="display:inline-block;padding-top:4px;">Your public page goes live after verification.</span>
        @endif
        <a href="{{ route('counsellor.index') }}">Counsellor dashboard</a>
    </div>
@endsection
