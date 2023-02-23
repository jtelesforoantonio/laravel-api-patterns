<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Request::macro('sortBy', function (array $columns, string $default) {
            $values = array_values($columns);
            $columns = array_combine($values, $values);

            return Arr::get($columns, $this->query('sortBy', $default), $default);
        });

        Request::macro('sortDir', function (string $default = 'desc') {
            $dirs = ['asc' => 'asc', 'desc' => 'desc'];

            return Arr::get($dirs, $this->query('sortDir', $default), $default);
        });
    }
}
