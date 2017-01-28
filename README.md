# An Authentication System for Laravel 5

Extremely simple way to authenticate with support for Laravel 5.4.

## Installation

Begin by installing this package through Composer. Edit your project’s `composer.json` file to require `nonoesp/authenticate`.

```
"require": {
	"nonoesp/authenticate": "5.4.*"
}
```

Next, update Composer from the Terminal:

```
composer update
```

Next, add the new providers to the `providers` array of `config/app.php`:

```
	'providers' => [
		// ...
		// nonoesp/authenticate
		Nonoesp\Authenticate\AuthenticateServiceProvider::class,          
		Nonoesp\Thinker\ThinkerServiceProvider::class,  
		Thujohn\Twitter\TwitterServiceProvider::class,
		Collective\Html\HtmlServiceProvider::class,
		// ...
	],
```

Then, add the class aliases to the `aliases` array of `config/app.php`:

```
	'aliases' => [
		// ...
		// nonoesp/authenticate
		'Authenticate' => Nonoesp\Authenticate\Facades\Authenticate::class,
		'Thinker' => Nonoesp\Thinker\Facades\Thinker::class,
		'Twitter'   => Thujohn\Twitter\Facades\Twitter::class,
		'Form' => Collective\Html\FormFacade::class,
		'Html' => Collective\Html\HtmlFacade::class,
		'Input' => Illuminate\Support\Facades\Input::class,
		'User' => 'App\User',     
		// ...
	],
```

Next, publish the package’s middlewares and add them to the Kernel.php

```
php artisan vendor:publish --provider="Nonoesp\Authenticate\AuthenticateServiceProvider" --tag=middleware
```

Use the `NONLoginMiddleware` to the routes you want to restrict to logged-user access.

Inside `app/Http/Kernel.php` add the following to create the `LoginMiddleware` alias, and to make the `NONRememberMiddleware` run before every request:

```php
protected $middlewareGroups = [
		'web' => [
			/// ...
			\App\Http\Middleware\NONRememberMiddleware::class,
			/// ...
		],
];

protected $routeMiddleware = [
		/// ...
		'login' => \App\Http\Middleware\NONLoginMiddleware::class,
		/// ...
];
```

A dependency of this package is `thujon/twitter`, so you will have to publish its config and add your Twitter credentials to `config/ttwitter.php` if you want to be able to log in with Twitter.

```
php artisan vendor:publish --provider="Thujohn\Twitter\TwitterServiceProvider"
```

## License

Authenticate is licensed under the MIT license. (http://opensource.org/licenses/MIT)

## Me

I'm [Nono Martínez Alonso](http://nono.ma) (nono.ma), a computational designer with a penchant for design, code, and simplicity. I tweet at [@nonoesp](http://www.twitter.com/nonoesp) and write at [Getting Simple](http://gettingsimple.com/). If you use this package, I would love to hear about it. Thanks!
