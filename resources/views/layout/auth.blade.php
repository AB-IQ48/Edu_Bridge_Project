<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Auth') | EduBridge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap" rel="stylesheet">
    <style>
        @include('partials.auth-inline-styles')
    </style>
    @include('partials.back-button-styles')
    @stack('auth_styles')
</head>
<body>
@php
    $flashItems = [];
    if (session('message')) $flashItems[] = ['text' => session('message'), 'type' => 'success'];
    if (session('success')) $flashItems[] = ['text' => session('success'), 'type' => 'success'];
    if (session('error')) $flashItems[] = ['text' => session('error'), 'type' => 'error'];
    if (session('warning')) $flashItems[] = ['text' => session('warning'), 'type' => 'info'];
@endphp
@if(!empty($flashItems))
    <div class="flash-stack" id="flashStack">
        @foreach($flashItems as $item)
            <div class="flash-toast flash-toast--{{ $item['type'] }}">{{ $item['text'] }}</div>
        @endforeach
    </div>
@endif
<div class="wrap">
    <div class="card @yield('card_class')">
        @unless(View::hasSection('no_back'))
            <div class="eb-back-wrap--auth">
                @include('partials.back-button')
            </div>
        @endunless
        @yield('content')
        @hasSection('trust_footer')
            <p class="trust-note">@yield('trust_footer')</p>
        @else
            <p class="trust-note">Secure login. Clear rules for verification and visa scoring. No black-box AI.</p>
        @endif
    </div>
</div>
<script>
  const flashStack = document.getElementById('flashStack');
  if (flashStack) {
    setTimeout(() => {
      flashStack.querySelectorAll('.flash-toast').forEach((node, i) => {
        setTimeout(() => node.remove(), i * 120);
      });
    }, 3800);
  }
</script>
</body>
</html>
