@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Dashboard — '.config('folio.title');
	$title = 'Hi there, '.Auth::user()->name.'!';
?>

@section('content')

	<p>This is the dashboard.</p>

	<p>You can logout <a href="/{{config('authenticate.exit')}}">here</a>.</p>

@endsection
