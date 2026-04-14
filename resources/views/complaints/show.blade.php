@extends($panel === 'student' ? 'layout.panel' : 'layout.auth')

@section('title', $complaint->subject)
@section('card_class', 'card--wide')

@if($panel === 'student')
@section('card_class', 'card--wide')
@section('auth_content')
    @include('complaints.partials.show-inner')
@endsection
@else
@section('content')
    @include('complaints.partials.show-inner')
@endsection
@endif
