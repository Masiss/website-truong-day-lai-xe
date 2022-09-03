<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $adminMenuJson = file_get_contents(base_path('resources/data/menu-data/adminMenu.json'));
        $adminMenuData = json_decode($adminMenuJson);
        $instructorMenuJson = file_get_contents(base_path('resources/data/menu-data/instructorMenu.json'));
        $instructorMenuData = json_decode($instructorMenuJson);
        $driverMenuJson = file_get_contents(base_path('resources/data/menu-data/driverMenu.json'));
        $driverMenuData = json_decode($driverMenuJson);

        // Share all menuData to all the views
        View::share('menuData', [$adminMenuData, $instructorMenuData,$driverMenuData]);
    }
}
