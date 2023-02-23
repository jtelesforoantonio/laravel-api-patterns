<?php

namespace Modules\Users;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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
            $this->loadRoutesFrom(__DIR__.'/Http/user.routes.php');
        });
    }

    /**
     * Get the route group configuration array.
     */
    private function routeConfiguration(): array
    {
        return [
            'namespace' => 'Modules\Users\Http\Controllers',
            'middleware' => 'api',
            'prefix' => 'api',
            'as' => 'api.',
        ];
    }
}
