<?php

use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\InstructorControlller;
use App\Http\Controllers\Admin\SalaryController;
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
Route::get('index', function () {
    return view('index');
})->name('index');
Route::get('register', function () {
    return view('register');
})->name('register');
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
    Route::resource('salary', SalaryController::class)->except([
        'show',
    ]);
    Route::get('salary/api', [SalaryController::class, 'api'])->name('salary.api');
    Route::get('salary/calculate', [SalaryController::class, 'calculate'])->name('salary.calculate');
    Route::get('salary/{id}/approve', [SalaryController::class, 'approve'])->where('id',
        '[0-9]+')->name('salary.approve');
    Route::resource('instructors', InstructorControlller::class)->except([
        'show',
    ]);
    Route::get('instructors/api', [InstructorControlller::class, 'api'])->name('instructors.api');
});

