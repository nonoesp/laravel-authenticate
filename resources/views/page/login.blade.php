@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Log In · '.config('folio.title');
	$o_band_class = '';

	if(!$title = Session::get('title')) $title = 'Welcome back, friend.';

	$error = Session::get('error');
	$twitter_handle = Session::get('twitter_handle');
?>

@section('content')

	@if(!isset($twitter_handle))

		@if(isset($error))
		    <p>{{ trans('authenticate::error.'.$error) }}</p>
		@endif

        <form action="{{ $auth_url }}" method="post" accept-charset="UTF-8">

            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input name="email" type="email" value="{{ session('email') }}" placeholder="Email"/>
            <input name="password" type="password" placeholder="Password"/>
            <button type="submit">Sign in</button>
            
            <a href="/twitter/login">
                <button class="button--twitter" type="button">Sign in with Twitter</button>
            </a>

        </form>

		<br/><br/>

	@else

		{{ '@'.Session::get('twitter_handle') }} doesn't have privileges.
		<a href="/logout">Logout</a>

	@endif

@endsection
