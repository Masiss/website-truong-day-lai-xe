<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\InstructorController;
use App\Http\Middleware\CheckLogin;
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
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('registering', [AuthController::class, 'registering'])->name('registering');
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware(CheckLogin::class);
Route::post('login_processing', [AuthController::class, 'login_processing'])->name('login_processing');
Route::prefix('instructors')->middleware([
    'web',
    'instructor'
])->controller(InstructorController::class)->name('instructors.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('/', 'updateInfo')->name('updateInfo');
    Route::get('/checkin', 'checkin')->name('checkin');
    Route::get('/checkin/{id}', 'updateStatus')
        ->where('id', '[0-9]+')->name('checkin.update');
    Route::get('/checkinAPI', 'checkinAPI')->name('checkinAPI');
    Route::get('/salaries', 'salaries')->name('salaries');
    Route::get('/salaries/api', 'api')->name('salaries.api');
    Route::get('/salaries/show/{id}', 'show')->where('id',
        '[0-9]+')->name('salaries.show');
    Route::get('/lessons', 'lessons')->name('lessons');
    Route::get('/getLessons', 'getLessons')->name('getLessons');
});
//Route::prefix('drivers')->middleware(['driver'])
//    ->name('drivers.')
//    ->controller(DriverController::class)
//    ->group(function () {
//        Route::get('/', 'index')->name('index');
//    });
Route::resource('drivers', DriverController::class);
