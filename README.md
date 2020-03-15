# Laravel authentication package

Simple authentication for Laravel.

## Installation

```
composer require nonoesp/authenticate
```

Next, publish the package’s middlewares and add them to the Kernel.php

```
php artisan vendor:publish --provider="Nonoesp\Authenticate\AuthenticateServiceProvider" --tag=middleware
```

Lastly, add the following middlewares to your `app/Http/Kernel.php` file.

- `LoginMiddleware` · restricts routes to logged users
- `RememberMiddleware` · remembers logged users

```php
protected $middleware = [
        /// nonoesp/authenticate
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,			
        \App\Http\Middleware\RememberLogin::class,        
        /// ...
];

protected $routeMiddleware = [
        /// nonoesp/authenticate
        'login' => \App\Http\Middleware\RequireLogin::class,
        /// ...
];
```

Optionally, publish and customize [configuration file](config/config.php).

```
php artisan vendor:publish --provider="Nonoesp\Authenticate\AuthenticateServiceProvider" --tag=config
```

<!--

A dependency of this package is `thujon/twitter`, so you will have to publish its config and add your Twitter credentials to `config/ttwitter.php` if you want to be able to log in with Twitter.

```
php artisan vendor:publish --provider="Thujohn\Twitter\TwitterServiceProvider"
```

-->

## License

Authenticate is licensed under the MIT license. (http://opensource.org/licenses/MIT)

## Me

Hi. I'm [Nono Martínez Alonso](https://nono.ma/about) (Nono.MA), a computational designer with a penchant for simplicity.

I host [Getting Simple](https://gettingsimple.com)—a podcast about how you can live a meaningful, creative, simple life—[sketch](https://sketch.nono.ma) things that call my attention, and [write](https://gettingsimple.com/writing) about enjoying a slower life.

If you find this pacakge useful in any way, reach out on Twitter at [@nonoesp](https://twitter.com/nonoesp). Cheers!
