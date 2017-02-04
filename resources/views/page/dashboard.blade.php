@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Dashboard — '.Config::get('space.title');
	$title = 'Hi there, '.Auth::user()->name.'!';
?>

@section('content')

	<p>This is the dashboard.</p>

	<p>You can logout {{ Html::link('/'.config('authenticate.exit'), 'here') }}.</p>

@endsection
