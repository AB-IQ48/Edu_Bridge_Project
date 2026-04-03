@extends($panel === 'student' ? 'layout.panel' : 'layout.auth')

@section('title', 'Make a complaint')

@if($panel === 'student')
@section('card_class', 'card--wide')
@section('auth_content')
    @include('complaints.partials.form-inner')
@endsection
@else
@section('content')
    @include('complaints.partials.form-inner')
@endsection
@endif
