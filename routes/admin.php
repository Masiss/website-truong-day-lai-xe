<?php


use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\InstructorControlller;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SalaryController;
use Illuminate\Support\Facades\Route;

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

Route::get('salaries/api', [SalaryController::class, 'api'])->name('salaries.api');
Route::get('salaries/calculate', [SalaryController::class, 'calculate'])->name('salaries.calculate');
Route::get('salaries/{id}/approve', [SalaryController::class, 'approve'])->where('id',
    '[0-9]+')->name('salaries.approve');
Route::resource('salaries', SalaryController::class)->only([
    'index',
    'update',
    'show',
]);
Route::resource('instructors', InstructorControlller::class)->except([
    'show',
]);
Route::get('instructors/api', [InstructorControlller::class, 'api'])->name('instructors.api');
Route::get('/lessons/{choose?}', [LessonController::class, 'index'])->name('lessons');

Route::prefix('config')
    ->controller(ConfigController::class)
    ->name('config.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store','store')->name('store');
        Route::put('update','update')->name('update');
        Route::delete('destroy','destroy')->name('destroy');
    });
