<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CourseControlller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now ins something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
], function () {
    Route::group([
        'as' => 'drivers.',
        'prefix' => 'drivers',
    ],
        function () {
            Route::get('/', [DriverController::class, 'index'])->name('index');
            Route::get('/create', [DriverController::class, 'create'])->name('create');
            Route::get('/api', [DriverController::class, 'api'])->name('api');
        });
    Route::group([
        'as' => 'course.',
        'prefix' => 'course',
    ],
        function () {
            Route::get('/', [CourseControlller::class, 'index'])->name('index');
            Route::get('/create', [CourseControlller::class, 'create'])->name('create');
            Route::get('/api', [CourseControlller::class, 'api'])->name('api');
        }
    );
    Route::group([
        'as' => 'driver.',
        'prefix' => 'drivẻ',
    ],
        function () {
            Route::get('/', [DriverController::class, 'index'])->name('index');
            Route::get('/create', [DriverController::class, 'create'])->name('create');
            Route::get('/api', [DriverController::class, 'api'])->name('api');
        }
    );
});

