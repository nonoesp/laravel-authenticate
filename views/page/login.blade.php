@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Log In — Nono Martínez Alonso';
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

			{{ Form::submit('Log In') }}
			
		{{ Form::close(); }}

		{{-- View::make('partials.footerSimple') --}}

		{{ HTML::link('/twitter/login', 'Log in with Twitter') }}

		<br><br>

		{{ Session::get('twitter_intended') }}

	@else

		{{ '@'.Session::get('twitter_handle') }} doesn't have privileges.
		{{ HTML::link('/logout', 'Logout') }}

	@endif

@endsection