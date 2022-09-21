<?php

use Illuminate\Support\Facades\Route;


Route::get('api', 'newInsApi')->name('newInsApi');
Route::get('lessons', 'lessons')->name('lessons');
Route::put('update', 'update')->name('update');
Route::get('lessons/create', 'create')->name('lessons.create');
Route::post('lessons/', 'store')->name('lessons.store');
Route::put('lessons/{lesson}', 'updateLesson')->name('lessons.update');
Route::put('lessons/{lesson}/instructor', 'updateIns')->name('lessons.update.ins');
Route::get('lessons/{lesson}/edit', 'edit')->name('lessons.edit');
Route::get('lessons/{id}/edit/rating', 'getRating')->name('lessons.rating');
Route::get('lessons/{id}/cancel', 'cancel')->name('lessons.cancel');
Route::get('change_password','changePassword')->name('changePassword');
Route::put('update_password','updatePassword')->name('updatePassword');
Route::get('bill','bill')->name('bill');

Route::get('/', 'index')->name('index');
