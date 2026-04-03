@extends('layout.header')

@section('content')
    <section class="static-page">
        <div class="container static-inner">
            <h1>@yield('static_title')</h1>
            @hasSection('static_updated')
                <p class="static-updated">@yield('static_updated')</p>
            @endif
            <div class="static-prose">
                @yield('static_body')
            </div>
        </div>
    </section>
@endsection
