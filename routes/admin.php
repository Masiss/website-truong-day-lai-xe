<?php


use App\Enums\LevelEnum;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\InstructorControlller;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
//    $route = Route::currentRouteName();
//    $breadCrumb = explode('.', $route);
//    $pageName = last($breadCrumb);
//    if (auth('driver')->check()) {
//        $title = 'Học viên';
//    } elseif (auth('instructor')->check()) {
//        switch (auth('instructor')->user()->level) {
//            case (LevelEnum::ADMIN->name):
//                $title = 'Admin';
//                break;
//            case (LevelEnum::INSTRUCTOR->name):
//                $title = 'Giáo viên';
//                break;
//        }
//    } else {
//        $title = "";
//    }
    return view('admin.index', [
//        'pageName' => $pageName,
//        'breadCrumb' => $breadCrumb,
//        'title'=>$title,
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
Route::prefix('contact')
    ->controller(ContactController::class)
    ->name('contact.')
    ->group(function(){
       Route::get('/','index')->name('index');
       Route::get('/api','api')->name('api');
       Route::get('/{id}','show')->name('show');
       Route::post('/{contact}/reply','reply')->name('reply');
       Route::delete('/{contact}','destroy')->name('destroy');

    });
