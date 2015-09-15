# laravel-authenticate

Extremely simple way to authenticate in Laravel.

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