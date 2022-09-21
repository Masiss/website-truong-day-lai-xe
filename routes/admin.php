<?php


use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\InstructorControlller;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\AdminController::class, 'index']
)->name('index');
Route::get('/drivers/api', [\App\Http\Controllers\AdminController::class, 'driverAPI'])->name('drivers.api');

Route::resource('drivers', DriverController::class)->except([
    'edit'
]);
Route::get('salaries/calculate', [SalaryController::class, 'monthCalculate'])->name('salaries.calculate');
Route::get('salaries/pending', [SalaryController::class, 'pending'])->name('salaries.pending');
Route::get('salaries/approved', [SalaryController::class, 'approved'])->name('salaries.approved');
Route::get('salaries/{id}/approve', [SalaryController::class, 'approve'])->where('id',
    '[0-9]+')->name('salaries.approve');
Route::get('salaries/lesson/api', [SalaryController::class, 'lessonAPI'])->name('salaries.lessons.api');
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
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
    });
Route::prefix('contact')
    ->controller(ContactController::class)
    ->name('contact.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/api', 'api')->name('api');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/{contact}/reply', 'reply')->name('reply');
        Route::delete('/{contact}', 'destroy')->name('destroy');

    });
Route::prefix('documents')
    ->controller(DocumentController::class)
    ->name('document.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('/{id}/show', 'show')->name('show');
        Route::delete('destroy', 'destroy')->name('destroy');
        Route::post('/upload-image', 'storeImageFromUploaded')->name('upload-image');
        Route::post('/upload-file', 'storeAttachmentFromUploaded')->name('upload-file');
    });
