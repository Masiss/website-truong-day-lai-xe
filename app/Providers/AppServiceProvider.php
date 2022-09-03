<?php

namespace App\Providers;

use App\Enums\LevelEnum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Blade::if('admin', function () {
            return auth('instructor')->user()->level === LevelEnum::ADMIN->name;
        });
        Blade::if('instructor', function () {
            return auth('instructor')->user()->level === LevelEnum::INSTRUCTOR->name;
        });
        Blade::if('driver', function () {
            return auth('driver')->check();
        });
    }
}
