<?php

namespace Modules\Posts;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerRoutes();
    }

    /**
     * Register the module routes.
     */
    private function registerRoutes(): void
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/post.routes.php');
        });
    }

    /**
     * Get the route group configuration array.
     */
    private function routeConfiguration(): array
    {
        return [
            'namespace' => 'Modules\Posts\Http\Controllers',
            'middleware' => 'api',
            'prefix' => 'api',
            'as' => 'api.',
        ];
    }
}
