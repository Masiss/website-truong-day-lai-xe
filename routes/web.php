<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use App\Models\Lesson;
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

Route::get('/contact', fn() => view('homepage.contact'))->name('contact');
//Route::get('/calendar', function () {
//    return view('apps.calendar',[
//        'pageName'=>'Calendar',
//        'breadCrumb'=>['Calendar'],
//    ]);
//})->name('calendar');
//Route::get('/calendar/api', function () {
//    $events = Lesson::lessonsCalendar();
//    return response()->json($events);
//})->name('calendarAPI');
Route::get('/calendar/api',[\App\Http\Controllers\Controller::class,'calendarAPI'])->name('calendarAPI');
Route::get('/calendar',[\App\Http\Controllers\Controller::class,'calendar'])->name('calendar');
Route::get('/search',[\App\Http\Controllers\TestController::class,'search'])->name('search');

