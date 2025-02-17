<?php

namespace App\Providers;

use App\Actions\GetTitleForUserAction;
use App\Enums\LevelEnum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
            return (auth('instructor')->check() && auth('instructor')->user()->level === LevelEnum::ADMIN->name);
        });
        Blade::if('instructor', function () {
            return (auth('instructor')->check() && auth('instructor')->user()->level === LevelEnum::INSTRUCTOR->name);
        });
        Blade::if('driver', function () {
            return auth('driver')->check();
        });
        Blade::if('hasSidebar', function () {
            $apps = ['contact'];
            $route = Route::getCurrentRoute()->getName();
            $mid = explode('.', $route)[1]??'';
            return in_array($mid, $apps);
        });


        View::composer('*', function ($view) {
            $title = GetTitleForUserAction::handle();
            $route = Route::currentRouteName();
            $breadCrumb = explode('.', $route);
            $pageName = last($breadCrumb);
            View::share('pageName', ucfirst($pageName));
            View::share('breadCrumb', $breadCrumb);
            View::share('title', $title);
        });

    }
}
