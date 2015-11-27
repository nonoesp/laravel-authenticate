<?php namespace Nonoesp\Authenticate;

use Illuminate\Support\ServiceProvider;

class AuthenticateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Paths
        $publish_path_views = base_path('resources/views/nonoesp/authenticate');
        $publish_path_middleware = base_path('app/Http/Middleware');
        $publish_path_lang = base_path('resources/lang/nonoesp/authenticate');
        $publish_path_config = config_path('authenticate.php');

        // Publish Stuff
        $this->publishes([__DIR__.'/../views' => $publish_path_views,], 'views');
        $this->publishes([__DIR__.'/Middleware' => $publish_path_middleware,], 'middleware');
        $this->publishes([__DIR__.'/../lang' => $publish_path_lang,], 'lang');
        $this->publishes([__DIR__.'/../config/config.php' => $publish_path_config,], 'config');
        
        // Views
        if (is_dir($publish_path_views)) {
            $this->loadViewsFrom($publish_path_views, 'authenticate'); // Load published views
        } else {
            $this->loadViewsFrom(__DIR__ . '/../views', 'authenticate');
        }

        // Translations
        if (is_dir($publish_path_lang)) {
            $this->loadTranslationsFrom($publish_path_lang, 'authenticate'); // Load published lang
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../lang', 'authenticate');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Controller
        $this->app->make('Nonoesp\Authenticate\Controllers\AuthController');
        $this->app->make('Nonoesp\Authenticate\Controllers\TwitterController');

        // Merge Config
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'authenticate');

        include __DIR__.'/routes.php';

        // Create alias
        $this->app->booting(function()
        {
          $loader = \Illuminate\Foundation\AliasLoader::getInstance();
          $loader->alias('Authenticate', 'Nonoesp\Authenticate\Facades\Authenticate');
        });

        // Return alias
        $this->app['authenticate'] = $this->app->share(function($app)
        {
        return new Authenticate;
        });
    }
}
