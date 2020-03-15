@extends('authenticate::layout.main')

<?php
	$shouldHideMenu = true;
	$site_title = 'Log In · '.config('folio.title');
	if(!$title = session('title')) $title = 'Welcome back, friend.';
?>

@section('content')

	@if(!session('twitter_handle'))

		@if(session('error'))
		    <p style="color: #e36129">{{ trans('authenticate::error.'.session('error')) }}</p>
		@endif

        <form action="{{ $auth_url }}" method="post" accept-charset="UTF-8">

            @csrf
            <input name="email" type="email" value="{{ session('email') }}" placeholder="Email" @if(!session('email')) autofocus @endif/>
            <input name="password" type="password" placeholder="Password" @if(session('email')) autofocus @endif/>
            <button type="submit">Sign in</button>

        </form>

		<br/><br/>

	@else

		{{ '@'.session('twitter_handle') }} doesn't have privileges.
		<a href="/logout">Logout</a>

	@endif

@endsection
