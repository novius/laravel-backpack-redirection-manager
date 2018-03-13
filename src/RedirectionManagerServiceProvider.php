<?php

namespace Novius\Backpack\RedirectionManager;

use Illuminate\Support\ServiceProvider;

class RedirectionManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $appRootDir = dirname(__DIR__, 1);

        // Setups the routes
        $this->setupRoutes($this->app->router);

        // Publishes the config, routes and lang files
        $this->publishes([$appRootDir.'/config' => config_path('backpack')], 'config');
        $this->publishes([$appRootDir.'/routes' => base_path().'/routes/backpack'], 'routes');
        $this->publishes([$appRootDir.'/resources/lang' => resource_path('lang/vendor/backpack-redirection-manager')], 'lang');
        $this->publishes([$appRootDir.'/resources/views' => resource_path('views/vendor/backpack-redirection-manager')], 'views');

        // Loads the views
        $this->loadViewsFrom($appRootDir.'/resources/views', 'backpack-redirection-manager');

        // Loads the translations
        $this->loadTranslationsFrom($appRootDir.'/resources/lang', 'backpack-redirection-manager');

        // Merges the current package config into the Backpack\Redirection-manager config
        $this->mergeConfigTo($appRootDir.'/config/redirection-manager.php', 'laravel-missing-page-redirector');

        // Merges the Backpack\Redirection-manager local config into the Backpack\Redirection-manager config
        if (file_exists(config_path('laravel-missing-page-redirector.php'))) {
            $this->mergeConfigTo(config_path('laravel-missing-page-redirector.php'), 'laravel-missing-page-redirector');
        }

        // Merges the current local package config into the Backpack\Redirection-manager config
        if (file_exists(config_path('backpack/redirection-manager.php'))) {
            $this->mergeConfigTo(config_path('backpack/redirection-manager.php'), 'laravel-missing-page-redirector');
        }
    }

    /**
     * Merges the specified config from another package. Does the opposite of mergeConfigFrom().
     *
     * @param $path
     * @param $key
     */
    protected function mergeConfigTo($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge($config, require $path));
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function setupRoutes()
    {
        // Loads the route file from the local app if exists
        if (file_exists(base_path('routes/backpack/redirection-manager.php'))) {
            $this->loadRoutesFrom(base_path('routes/backpack/redirection-manager.php'));
        }
        // Otherwise loads the route file from the current package
        else {
            $this->loadRoutesFrom(dirname(__DIR__, 1).'/routes/redirection-manager.php');
        }
    }
}
