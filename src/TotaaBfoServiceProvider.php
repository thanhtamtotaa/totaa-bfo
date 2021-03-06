<?php

namespace Totaa\TotaaBfo;

use Illuminate\Support\ServiceProvider;
use Totaa\TotaaBfo\Http\Livewire\BfoInfoLivewire;
use Livewire\Livewire;

class TotaaBfoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'totaa-bfo');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'totaa-bfo');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            /*$this->publishes([
                __DIR__.'/../config/config.php' => config_path('totaa-bfo.php'),
            ], 'config');*/

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/totaa-bfo'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/totaa-bfo'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/totaa-bfo'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);

            /*
            |--------------------------------------------------------------------------
            | Seed Service Provider need on boot() method
            |--------------------------------------------------------------------------
            */
            $this->app->register(SeedServiceProvider::class);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'totaa-bfo');

        // Register the main class to use with the facade
        $this->app->singleton('totaa-bfo', function () {
            return new TotaaBfo;
        });

        if (class_exists(Livewire::class)) {
            Livewire::component('totaa-bfo::bfo-livewire', BfoInfoLivewire::class);
        }
    }
}
