@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Dashboard — Nono Martínez Alonso';
	$title = 'Hi there, '.Auth::user()->name.'!';
?>

@section('content')

	<p>This is the dashboard.</p>

	<p>You can logout {{ HTML::link('/logout', 'here') }}.</p>

@endsection