<?php namespace Nonoesp\Authenticate;

use Illuminate\Support\ServiceProvider;

class AuthenticateServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('nonoesp/authenticate');

    	include __DIR__.'/routes.php';			
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->booting(function()
		{
		  $loader = \Illuminate\Foundation\AliasLoader::getInstance();
		  $loader->alias('Authenticate', 'Nonoesp\Authenticate\Facades\Authenticate');
		});

		$this->app['authenticate'] = $this->app->share(function($app)
		{
		return new Authenticate;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('authenticate');
	}

}
