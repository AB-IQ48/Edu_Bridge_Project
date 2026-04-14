{{-- Uses $featuredCounsellor from View composer (index, pages.verification) --}}
@php
    $fc = $featuredCounsellor ?? null;
    if (! $fc) {
        $fc = (object) [
            'profile' => null,
            'name' => 'Ayesha Khan',
            'initials' => 'AK',
            'organization' => 'Lahore Global Education',
            'city' => 'Lahore',
            'years' => 9,
            'has_real_profile' => false,
        ];
    }
@endphp
<div class="counsellor-card-demo">
    <div class="counsellor-head">
        <div class="counsellor-avatar">{{ $fc->initials }}</div>
        <div>
            <div class="counsellor-name">{{ $fc->name }}</div>
            <div class="counsellor-org">{{ $fc->organization }} · {{ $fc->city }}</div>
        </div>
    </div>
    <div style="margin-bottom:16px">
        <span class="badge-verified-full">✓ Identity verified</span>
    </div>
    <div class="counsellor-metrics">
        <div class="metric">
            <div class="metric-val">{{ $fc->years }} yrs</div>
            <div class="metric-key">Experience</div>
        </div>
        <div class="metric">
            <div class="metric-val">340</div>
            <div class="metric-key">Students placed*</div>
        </div>
        <div class="metric">
            <div class="metric-val">94%</div>
            <div class="metric-key">Visa success*</div>
        </div>
    </div>
    <p style="font-size:0.7rem;color:rgba(255,255,255,0.45);margin:10px 0 0;line-height:1.5">*Illustrative figures for layout; not live platform statistics.</p>
</div>
<div style="font-size:0.75rem;color:rgba(255,255,255,0.4);line-height:1.6">
    @if($fc->has_real_profile && $fc->profile)
        Verified on EduBridge
        @if($fc->profile->reviewed_at)
            · Last review {{ $fc->profile->reviewed_at->format('F Y') }}
        @endif
        · Counsellor profile #{{ $fc->profile->id }}
    @else
        Illustrative preview — add approved counsellors in the admin panel to show a live profile here.
    @endif
</div>
