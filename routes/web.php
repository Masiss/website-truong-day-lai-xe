<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\CourseControlller;
use App\Http\Controllers\Admin\InstructorControlller;
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
    Route::get('/', function () {
        $route = Route::currentRouteName();
        $breadCrumb = explode('.', $route);
        $pageName = last($breadCrumb);
        return view('admin.index', [
            'pageName' => $pageName,
            'breadCrumb' => $breadCrumb,
        ]);
    }
    )->name('index');
    Route::get('drivers/api', [DriverController::class, 'api'])->name('drivers.api');
    Route::resource('drivers', DriverController::class)->except([
        'show',
    ]);
    Route::group([
        'as' => 'courses.',
        'prefix' => 'courses',
    ],
        function () {
            Route::get('/', [CourseControlller::class, 'index'])->name('index');
            Route::get('/create', [CourseControlller::class, 'create'])->name('create');
            Route::get('/api', [CourseControlller::class, 'api'])->name('api');
        }
    );
    Route::group([
        'as' => 'instructors.',
        'prefix' => 'instructors',
    ],
        function () {
            Route::get('/', [InstructorControlller::class, 'index'])->name('index');
            Route::get('/create', [InstructorControlller::class, 'create'])->name('create');
            Route::get('/api', [InstructorControlller::class, 'api'])->name('api');
        }
    );
});

