@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Log In — Nono Martínez Alonso';

	if(!$title = Session::get('title')) {
		$title = 'Welcome back, friend.';	
	}

	$error = Session::get('error');
?>

@section('content')	

	@if(isset($error))
	    <p>{{ trans('authenticate::error.'.$error) }}</p>
	@endif

	{{ Form::open(array('url' => $auth_url, 'method' => 'post'))}}

		{{ Form::email('email', Session::get('email'), array('placeholder' => 'Email')) }}
		{{ Form::password('password', array('placeholder' => 'Password')) }}		

		{{ Form::submit('Log In') }}
		
	{{ Form::close(); }}

{{-- View::make('partials.footerSimple') --}}

@endsection