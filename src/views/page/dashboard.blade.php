@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Dashboard — Nono Martínez Alonso';
	$title = 'Hi there, '.Auth::user()->name.'!';
?>

@section('content')

	<p>This is the dashboard. Check out how AR-MA's {{ HTML::link('/', 'homepage') is looking.</p>

	<p>You can logout {{ HTML::link('/logout', 'here') }}.</p>

@endsection