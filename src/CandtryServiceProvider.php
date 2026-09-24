<?php

namespace Candtry\Candtry;

use Candtry\Candtry\Console\Commands\CandtryCommand;
use Illuminate\Support\ServiceProvider;

class CandtryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/candtry.php', 'candtry');

        $this->app->singleton(Candtry::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/candtry.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'candtry');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'candtry');

        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/candtry.php' => config_path('candtry.php'),
        ], ['candtry', 'candtry-config']);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/candtry'),
        ], ['candtry', 'candtry-views']);

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/candtry'),
        ], ['candtry', 'candtry-lang']);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/candtry'),
        ], ['candtry', 'candtry-assets']);

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], ['candtry', 'candtry-migrations']);

        $this->commands([
            CandtryCommand::class,
        ]);
    }
}
