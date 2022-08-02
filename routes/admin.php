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
Route::resource('drivers', DriverController::class)->except([
    'edit'
]);

Route::get('salaries/calculate', [SalaryController::class, 'monthCalculate'])->name('salaries.calculate');
Route::get('salaries/pending', [SalaryController::class, 'pending'])->name('salaries.pending');
Route::get('salaries/approved', [SalaryController::class, 'approved'])->name('salaries.approved');
Route::get('salaries/{id}/approve', [SalaryController::class, 'approve'])->where('id',
    '[0-9]+')->name('salaries.approve');
Route::resource('salaries', SalaryController::class)->only([
    'update',
    'show',
]);
Route::resource('instructors', InstructorControlller::class)->except([
]);
Route::get('/lessons/{choose?}', [LessonController::class, 'index'])->name('lessons');

Route::prefix('config')
    ->controller(ConfigController::class)
    ->name('config.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store','store')->name('store');
        Route::put('update','update')->name('update');
    });
