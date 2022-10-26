<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomePageController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [HomePageController::class,'index'])->name('index');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('registering', [AuthController::class, 'registering'])->name('registering');
Route::get('login', [AuthController::class, 'login'])->name('login')->middleware(CheckLogin::class);
Route::post('login_processing', [AuthController::class, 'login_processing'])->name('login_processing');

Route::get('/contact', [HomePageController::class,'contact'])->name('contact');
Route::post('/contact', [HomePageController::class,'contactForm'])->name('contact.create');

Route::get('courses',[HomePageController::class,'courses'])->name('courses');

Route::get('document',[HomePageController::class,'document'])->name('document');
Route::get('document/{id}/show', [HomePageController::class,'show'])->name('document.show');


Route::get('document/api',[Controller::class,'documentAPI'])->name('documentAPI');
Route::get('document/show',[Controller::class,'documentShowAPI'])->name('document.show.api');
Route::get('/calendar/api',[Controller::class,'calendarAPI'])->name('calendarAPI');
Route::get('/calendar',[Controller::class,'calendar'])->name('calendar');
Route::get('/search',[Controller::class,'search'])->name('search');

Route::get('/test',fn()=>view('test'));
