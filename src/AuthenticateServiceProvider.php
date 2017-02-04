<?php namespace Nonoesp\Authenticate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

class AuthenticateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paths
        $path_views = __DIR__.'/../resources/views';
        $path_lang = __DIR__.'/../resources/lang';
        $path_middleware = __DIR__.'/Middleware';
        $path_config = __DIR__.'/../config/config.php';

        // Publish Paths
        $publish_path_views = base_path('resources/views/nonoesp/authenticate');
        $publish_path_middleware = base_path('app/Http/Middleware');
        $publish_path_lang = base_path('resources/lang/nonoesp/authenticate');
        $publish_path_config = config_path('authenticate.php');

        // Publish Stuff
        $this->publishes([$path_views => $publish_path_views,], 'views');
        $this->publishes([$path_lang => $publish_path_lang,], 'lang');
        $this->publishes([$path_middleware => $publish_path_middleware,], 'middleware');
        $this->publishes([$path_config => $publish_path_config,], 'config');

        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'authenticate');

        // Views
        if (is_dir($publish_path_views)) {
            $this->loadViewsFrom($publish_path_views, 'authenticate'); // Load published views
        } else {
            $this->loadViewsFrom($path_views, 'authenticate');
        }

        // Translations
        if (is_dir($publish_path_lang)) {
            $this->loadTranslationsFrom($publish_path_lang, 'authenticate'); // Load published lang
        } else {
            $this->loadTranslationsFrom($path_lang, 'authenticate');
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
        // $this->app['authenticate'] = $this->app->share(function($app)
        // {
        // return new Authenticate;
        // });

        $this->app->singleton('authenticate', function (Container $app) {
               return new Authenticate();
           });

        $this->app->alias('authenticate', Authenticate::class);

    }
}
