<?php

use Illuminate\Support\Facades\Route;


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
Route::get('change_password','changePassword')->name('changePassword');
Route::put('update_password','updatePassword')->name('updatePassword');

