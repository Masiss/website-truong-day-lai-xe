<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstructorController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\InstructorMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
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
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware(RedirectIfAuthenticated::class);
Route::post('login_processing', [AuthController::class, 'login_processing'])->name('login_processing');
//Route::middleware([AdminMiddleware::class])->name('admin.')->prefix('admin')->group(function () {
//
//});
Route::prefix('instructors')->middleware(InstructorMiddleware::class)->name('instructors.')->group(function () {
    Route::get('/', [InstructorController::class, 'index'])->name('index');
    Route::get('/salaries', [InstructorController::class, 'index'])->name('salaries');
});
