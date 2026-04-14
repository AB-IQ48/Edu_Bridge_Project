@extends('layout.header')

{{-- Hide duplicate back control above the card; keep in-card back from partials.back-button --}}
@section('no_back')
@endsection

@push('styles')
    <style>
        @include('partials.auth-inline-styles')
        .flash-stack { top: 88px !important; }
        .panel-auth-wrap .wrap { min-height: auto; padding-bottom: 48px; }
    </style>
@endpush

@section('content')
    <div class="panel-auth-wrap">
        <div class="wrap">
            @auth
                @if(auth()->user()->isCounsellor())
                    <div class="eb-counsellor-notify-bar" style="display:flex;justify-content:flex-end;margin-bottom:12px;">
                        @include('partials.counsellor-notification-bell')
                    </div>
                @endif
            @endauth
            <div class="card @yield('card_class')">
                @unless(View::hasSection('no_card_back'))
                    <div class="eb-back-wrap--auth">
                        @include('partials.back-button')
                    </div>
                @endunless
                @yield('auth_content')
                @hasSection('trust_footer')
                    <p class="trust-note">@yield('trust_footer')</p>
                @else
                    <p class="trust-note">Secure login. Clear rules for verification and visa scoring.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
