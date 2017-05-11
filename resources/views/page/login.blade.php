@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Log In — '.Config::get('folio.title');
	$o_band_class = '';

	if(!$title = Session::get('title')) {
		$title = 'Welcome back, friend.';
	}

	$error = Session::get('error');
	$twitter_handle = Session::get('twitter_handle');
?>

@section('content')

	@if(!isset($twitter_handle))

		@if(isset($error))
		    <p>{{ trans('authenticate::error.'.$error) }}</p>
		@endif

		{{ Form::open(array('url' => $auth_url, 'method' => 'post'))}}

			{{ Form::email('email', Session::get('email'), array('placeholder' => 'Email')) }}
			{{ Form::password('password', array('placeholder' => 'Password')) }}

			{{ Form::submit('Sign in') }}

			<a href="/twitter/login">{{ Form::button('Sign in with Twitter', array('class' => 'button--twitter')) }}</a>

		{{ Form::close() }}

		<br><br>

	@else

		{{ '@'.Session::get('twitter_handle') }} doesn't have privileges.
		<a href="/logout">Logout</a>

	@endif

@endsection
