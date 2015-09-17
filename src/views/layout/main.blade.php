<!DOCTYPE html>
<html lang="{{ \Thinker::getLocaleDisplayed() }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimal-ui"/>
	<title>{{ $site_title or 'Admin' }}</title>

	<!--Icon-->
	<link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon.png" />
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-@2x.png" />
	<meta name="apple-mobile-web-app-title" content="AR-MA" />

	<!--Stylesheets-->
	<link rel="stylesheet" type="text/css" href="/css/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="/css/main.css">

	<!--TypeKit-->
	<script type="text/javascript" src="//use.typekit.net/{{{ \Config::get('services.typekit.main') }}}.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>	
		
</head>

<body>

<div class="[ o-band  {{ $o_band_class or 'o-band--padding-footer' }} ]">
	<div class="[ o-wrap  o-wrap--tiny ]">

	@if(!isset($shouldHideMenu))
		{{ View::make('admin.partials.menu') }}
	@endif

	<h3 class="[ c-admin__title ] [ u-border-bottom ]">{{ $title or 'Admin' }}</h3>

	@yield('content')

	</div>
</div>

</body>
</html>