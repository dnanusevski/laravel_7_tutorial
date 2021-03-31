
@extends('artisan')

@section('title', 'Dashbord')

@section('content')
	This is the main contend of the child template
@endsection


@include('sign-up-button', ['text' => 'text given in parent template'])

@push('stackDivs')
	<div> Pushed to the bottom of the stack stackDivs </div>
@endpush

@prepend('stackDivs')
	<div> Pushed to the top of the stack stackDivs </div>
@endprepend