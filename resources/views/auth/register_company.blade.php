@extends('layout.panel')

@section('title', 'Apply as a counsellor | EduBridge')

@section('card_class', 'card--wide card--xl')

@section('auth_content')
    <p class="role-badge-inline" style="margin-bottom:10px;">Counsellor · Application</p>
    <h1>Apply as a counsellor</h1>
    <p class="sub">Tell us about your organization, how to reach you, and upload company verification documents. An administrator reviews everything before your profile can appear as verified.</p>

    @if ($errors->any())
        <div class="alert alert--error">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.company.store') }}" enctype="multipart/form-data" class="grid" style="gap:0;">
        @csrf

        <div class="form-section" style="margin-bottom:18px;">
            <div class="form-section__head">
                <div class="form-section__icon" style="background: linear-gradient(135deg, #4a7c6b 0%, #2d5a4a 100%); color:#fff;">🏢</div>
                <div>
                    <p class="form-section__title">Organization &amp; contact</p>
                    <p class="form-section__sub">These details appear on your public profile once approved.</p>
                </div>
            </div>
            <div class="q-block">
                <label class="q-label" for="organization_name">Organization name</label>
                <input id="organization_name" name="organization_name" type="text" class="input" value="{{ old('organization_name') }}" required autocomplete="organization" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
            </div>
            <div class="row" style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <div class="q-block" style="margin-bottom:14px;">
                    <label class="q-label" for="city">City / region</label>
                    <input id="city" name="city" type="text" class="input" value="{{ old('city') }}" placeholder="e.g. London, Dubai, Toronto" autocomplete="address-level2" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                </div>
                <div class="q-block" style="margin-bottom:14px;">
                    <label class="q-label" for="experience_years">Years of experience</label>
                    <input id="experience_years" name="experience_years" type="number" min="0" max="70" value="{{ old('experience_years') }}" placeholder="0" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                </div>
            </div>
            <div class="q-block" style="margin-bottom:14px;">
                <label class="q-label" for="phone">Business phone <span style="color:#b91c1c">*</span></label>
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required placeholder="+44 … or +1 …" autocomplete="tel" style="width:100%; max-width:420px; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
            </div>
            <div class="q-block" style="margin-bottom:0;">
                <label class="q-label" for="website">Website <span style="color:#b91c1c">*</span></label>
                <input id="website" name="website" type="text" value="{{ old('website') }}" required placeholder="https://yourcompany.com or yourcompany.com" inputmode="url" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                <p class="hint" style="margin-top:6px;">We will normalize the address to use <code style="font-size:0.85rem;">https://</code> if needed.</p>
            </div>
        </div>

        <div class="form-section" style="margin-bottom:18px;">
            <div class="form-section__head">
                <div class="form-section__icon" style="background: linear-gradient(135deg, #c8a84b 0%, #a67c00 100%); color:#fff;">✨</div>
                <div>
                    <p class="form-section__title">Practice profile</p>
                    <p class="form-section__sub">Optional now. You can refine these later in your dashboard.</p>
                </div>
            </div>
            <div class="q-block" style="margin-bottom:14px;">
                <label class="q-label" for="countries_served">Countries you serve</label>
                <input id="countries_served" name="countries_served" type="text" value="{{ old('countries_served') }}" placeholder="e.g. United Kingdom, Canada, Australia" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
            </div>
            <div class="q-block" style="margin-bottom:14px;">
                <label class="q-label" for="languages">Languages</label>
                <input id="languages" name="languages" type="text" value="{{ old('languages') }}" placeholder="e.g. English, Spanish, Arabic" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
            </div>
            <div class="q-block" style="margin-bottom:14px;">
                <label class="q-label" for="specializations">Specializations</label>
                <textarea id="specializations" name="specializations" rows="3" placeholder="One line or short list (e.g. UK master’s, Canada SDS, foundation pathways)" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem; resize:vertical;">{{ old('specializations') }}</textarea>
            </div>
            <div class="q-block" style="margin-bottom:0;">
                <label class="q-label" for="bio">Short bio</label>
                <textarea id="bio" name="bio" rows="4" placeholder="How you help students and families (optional)." style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem; resize:vertical;">{{ old('bio') }}</textarea>
            </div>
        </div>

        <div class="form-section" style="margin-bottom:18px;">
            <div class="form-section__head">
                <div class="form-section__icon" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color:#fff;">🔐</div>
                <div>
                    <p class="form-section__title">Account credentials</p>
                    <p class="form-section__sub">Primary contact person for this organization.</p>
                </div>
            </div>
            <div class="row" style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <div class="q-block" style="margin-bottom:14px;">
                    <label class="q-label" for="name">Contact person name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                </div>
                <div class="q-block" style="margin-bottom:14px;">
                    <label class="q-label" for="email">Login email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                </div>
            </div>
            <div class="row" style="display:grid; grid-template-columns:1fr 1fr; gap:14px;">
                <div class="q-block" style="margin-bottom:14px;">
                    <label class="q-label" for="password">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                </div>
                <div class="q-block" style="margin-bottom:14px;">
                    <label class="q-label" for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" style="width:100%; padding:11px 14px; border-radius:10px; border:1px solid rgba(0,0,0,0.12); font-size:0.95rem;">
                </div>
            </div>
        </div>

        <div class="form-section" style="margin-bottom:22px;">
            <div class="form-section__head">
                <div class="form-section__icon" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color:#fff;">📎</div>
                <div>
                    <p class="form-section__title">Company verification documents</p>
                    <p class="form-section__sub">PDF or clear images (JPG/PNG), up to 10MB each. Admins use these to verify your business before approval.</p>
                </div>
            </div>
            <div class="q-block" style="margin-bottom:16px;">
                <label class="q-label" for="registration_file">Business registration / licence <span style="color:#b91c1c">*</span></label>
                <input id="registration_file" name="registration_file" type="file" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required style="width:100%; font-size:0.9rem;">
                <p class="hint" style="margin-top:6px;">Certificate of incorporation, business licence, charity registration, or other official proof for <strong>your country or region</strong> (whatever your jurisdiction uses).</p>
            </div>
            <div class="q-block" style="margin-bottom:16px;">
                <label class="q-label" for="certificate_file">Company certificate or accreditation (optional)</label>
                <input id="certificate_file" name="certificate_file" type="file" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" style="width:100%; font-size:0.9rem;">
            </div>
            <div class="q-block" style="margin-bottom:0;">
                <label class="q-label" for="supporting_file">Additional supporting document (optional)</label>
                <input id="supporting_file" name="supporting_file" type="file" accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" style="width:100%; font-size:0.9rem;">
                <p class="hint" style="margin-top:6px;">Partnership deed, tax registration, or other evidence if relevant.</p>
            </div>
        </div>

        <button class="btn btn--sage" type="submit" style="margin-top:4px;">Submit application</button>
    </form>

    <div class="toplinks" style="margin-top:20px;">
        <a href="{{ route('login') }}">Already have an account? Sign in</a>
        <a href="{{ route('register.student') }}">Register as a student</a>
        <a href="{{ route('password.request') }}">Forgot password?</a>
    </div>
@endsection

@push('auth_styles')
<style>
    @media (max-width: 640px) {
        .form-section .row { grid-template-columns: 1fr !important; }
    }
</style>
@endpush
