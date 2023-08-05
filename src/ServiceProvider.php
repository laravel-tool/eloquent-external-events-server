<?php

namespace LaravelTool\EloquentExternalEventsServer;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelTool\EloquentExternalEventsServer\Http\Controllers\ServerController;
use LaravelTool\EloquentExternalEventsServer\Http\Middleware\ApiMiddleware;

class ServiceProvider extends BaseServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/eloquent_external_events_server.php',
            'eloquent_external_events_server');
    }

    public function boot(): void
    {
        $this->registerPublishes();
        $this->registerRoute();

        $this->app->singleton(EventService::class);
    }

    protected function registerPublishes(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/eloquent_external_events_server.php' => config_path('eloquent_external_events_server.php'),
        ], 'config');
    }

    protected function registerRoute(): void
    {
        Route::middleware(config('eloquent_external_events_server.middleware'))
            ->middleware(ApiMiddleware::class)
            ->post(config('eloquent_external_events_server.endpoint'), ServerController::class)
            ->name('eloquent_external_events.server');
    }
}