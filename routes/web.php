<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/note/create', 'NoteController@create')->name('note.create');
    Route::post('/note/store', 'NoteController@store')->name('note.store');
    Route::get('/note/edit/{id}', 'NoteController@edit')->name('note.edit');
    Route::put('/note/update/{id}', 'NoteController@update')->name('note.update');
    Route::delete('/note/delete/{id}', 'NoteController@delete')->name('note.delete');

    Route::get('/categories/{id}', 'DashboardController@index')->name('categories');
    Route::get('/sub-categories/{id}', 'MainController@getSubCategories');

    Route::get('/stats/today', 'StatController@today')->name('stats.today');
    Route::get('/stats/yesterday', 'StatController@yesterday')->name('stats.yesterday');
    Route::get('/stats/last-week', 'StatController@lastWeek')->name('stats.last-week');
    Route::get('/stats/this-year', 'StatController@thisYear')->name('stats.this-year');

    // Route::get('/statistics/{id?}', [StatisticsController::class, 'index'])->name('statistics');
});