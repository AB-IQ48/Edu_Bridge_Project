@extends('layout.header')

@section('title', 'Verified Counsellors — EduBridge')

@section('content')
<section class="trust-section" style="padding:80px 0 60px">
  <div class="container">
    <div class="section-eyebrow">
      <span class="eyebrow-num">—</span>
      <span class="eyebrow-line"></span>
      <span class="eyebrow-tag">Find a counsellor</span>
    </div>
    <h2 class="section-title">Verified education counsellors</h2>
    <p class="section-sub" style="margin-bottom:16px">Every counsellor below has passed our verification process. Students can attach to one counsellor to receive guided support for their application.</p>
    <p style="max-width:720px;font-size:0.95rem;color:var(--muted);line-height:1.7">Once you attach to a counsellor, they can access the documents you share and guide you through visa readiness and application steps. You can change your attached counsellor at any time from this page.</p>

    @if (session('message'))
      <div style="margin-top:24px;padding:14px 18px;background:rgba(74,124,107,0.12);border:1px solid rgba(74,124,107,0.3);color:var(--sage);border-radius:8px;font-size:0.9rem">
        {{ session('message') }}
      </div>
    @endif
    @if (session('error'))
      <div style="margin-top:24px;padding:14px 18px;background:rgba(220,38,38,0.08);border:1px solid rgba(220,38,38,0.25);color:var(--danger);border-radius:8px;font-size:0.9rem">
        {{ session('error') }}
      </div>
    @endif

    @auth
      @if(auth()->user()->isStudent() && auth()->user()->assignedCounsellorProfile)
        <p style="margin-top:28px;font-size:0.9rem;color:var(--muted)">
          You are currently connected to <strong style="color:var(--ink)">{{ auth()->user()->assignedCounsellorProfile->user->name }}</strong> ({{ auth()->user()->assignedCounsellorProfile->organization_name }}).
          <form method="POST" action="{{ route('counsellors.detach') }}" style="display:inline">@csrf<button type="submit" onclick="return confirm('Disconnect from this counsellor? You can attach to another anytime.');" style="background:none;border:none;color:var(--sage);cursor:pointer;font-size:0.9rem;padding:0;margin-left:4px">Disconnect</button></form>
        </p>
      @endif
    @endauth
  </div>
</section>

<section class="for-who" style="padding-top:0">
  <div class="container" style="max-width:900px">
    @if($counsellors->isEmpty())
      <div style="background:var(--white);border:1px solid rgba(0,0,0,0.08);border-radius:8px;padding:48px;text-align:center">
        <p style="font-size:1.1rem;color:var(--muted);margin-bottom:16px">No verified counsellors are listed yet.</p>
        <p style="font-size:0.9rem;color:var(--muted)">Counsellors appear here after completing verification. Check back soon or <a href="{{ route('register.company') }}" style="color:var(--sage)">apply as a counsellor</a>.</p>
      </div>
    @else
      <div style="display:flex;flex-direction:column;gap:20px">
        @foreach($counsellors as $profile)
          <div style="background:var(--white);border:1px solid rgba(0,0,0,0.08);border-radius:8px;padding:28px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:20px;box-shadow:0 4px 20px rgba(0,0,0,0.04)">
            <div style="flex:1;min-width:200px">
              <div style="display:flex;align-items:center;gap:12px;margin-bottom:8px">
                <div style="width:48px;height:48px;background:var(--sage);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--white);font-weight:600;font-size:1rem">
                  {{ strtoupper(mb_substr($profile->user->name ?? 'C', 0, 2)) }}
                </div>
                <div>
                  <h3 style="font-size:1.1rem;font-weight:600;color:var(--ink);margin:0">{{ $profile->user->name ?? 'Counsellor' }}</h3>
                  <p style="font-size:0.85rem;color:var(--muted);margin:4px 0 0 0">{{ $profile->organization_name }}</p>
                </div>
              </div>
              <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
                <span style="display:inline-flex;align-items:center;gap:6px;background:rgba(74,124,107,0.12);border:1px solid rgba(74,124,107,0.35);color:var(--sage);font-size:0.72rem;font-weight:600;letter-spacing:0.05em;text-transform:uppercase;padding:4px 10px;border-radius:20px">✓ Verified</span>
                <span style="font-size:0.85rem;color:var(--muted)">{{ $profile->experience_years }} years experience</span>
              </div>
            </div>
            <div style="flex-shrink:0">
              @auth
                @if(auth()->user()->isStudent())
                  @if(auth()->user()->assigned_counsellor_profile_id == $profile->id)
                    <span style="display:inline-block;padding:10px 20px;background:var(--cream);color:var(--muted);font-size:0.875rem;font-weight:500;border-radius:8px">Connected</span>
                  @else
                    <form method="POST" action="{{ route('counsellors.attach', $profile) }}" style="display:inline">
                      @csrf
                      <button type="submit" style="padding:10px 22px;background:var(--ink);color:#fff;border:none;border-radius:8px;font-weight:600;font-size:0.875rem;cursor:pointer">
                        Attach to this counsellor
                      </button>
                    </form>
                  @endif
                @else
                  <span style="font-size:0.85rem;color:var(--muted)">Students can attach from a student account.</span>
                @endif
              @else
                <a href="{{ route('login') }}" class="nav-cta" style="display:inline-block;padding:10px 22px;text-decoration:none;font-size:0.8rem">Login to connect</a>
              @endauth
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

<section class="cta-section" style="margin-top:60px">
  <div class="container">
    <h2>Not a student yet?</h2>
    <p>Register to get your Visa Readiness Score and connect with a verified counsellor.</p>
    <div class="cta-actions">
      <a href="{{ route('register.student') }}" class="cta-btn-white">Register as Student</a>
      <a href="{{ route('login') }}" class="cta-btn-outline">Login</a>
    </div>
  </div>
</section>
@endsection
