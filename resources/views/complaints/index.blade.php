@extends($panel === 'student' ? 'layout.panel' : 'layout.auth')

@section('title', 'My complaints')

@if($panel === 'student')
@section('card_class', 'card--wide')
@section('auth_content')
    @include('complaints.partials.index-inner')
@endsection
@else
@section('content')
    @include('complaints.partials.index-inner')
@endsection
@endif
