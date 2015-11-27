# Authentication System for Laravel 5

Extremely simple way to authenticate in Laravel 5.

## Usage

Install illuminate/html and add its service and provider.

	composer require nonoesp/thinker:dev

	php artisan vendor:publish --provider="Nonoesp\Authenticate\AuthenticateServiceProvider" --tag=middleware

For some reason, this command does not seem to work anymore in Laravel, I am currently using `php artisan vendor:publish --tag=middleware` — which is annoying because if it clashes with other packages or providers, it will publish their assets too.

Add this middleware to the routes you want to restrict to logged-user access.

Inside `app/Http/Kernel.php` add the following:

```php
protected $routeMiddleware = [
    […]
    'login' => \Arma\Http\Middleware\LoginMiddleware::class,
];
```

*Deprecated notes from Laravel 4 version.*

## Installation

Run `compose require nonoesp/authenticate:dev-master`

Add `'Nonoesp/Authenticate/AuthenticateServiceProvider',` to `providers` in `/app/config/app.php`

## Publish Package Assets while Developing in the Workbench

The following command will copy your assets into `/public/packages/vendor/package/`. Development should be continued on the workbench. Then you can run the command again if you want to update the previously published assets.

`php artisan asset:publish --bench="vendor/package"`

## License

Thinker is licensed under the MIT license. (http://opensource.org/licenses/MIT)

## Me

I tweet at [@nonoesp](http://www.twitter.com/nonoesp) and blog at [nono.ma/says](http://nono.ma/says). If you use this package, I would love to hear about it. Thanks!