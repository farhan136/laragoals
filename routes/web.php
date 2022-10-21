<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('todo')->middleware('auth')->name('todo.')->group(function(){
    Route::get('/', 'App\Http\Controllers\TaskController@index')->name('index');
    // Route::post('/gridview', 'App\Http\Controllers\TaskController@gridview')->name('gridview');
    Route::get('/create', 'App\Http\Controllers\TaskController@form')->name('create')->middleware('role:1');
    Route::post('/store/{task?}', 'App\Http\Controllers\TaskController@store')->name('store');
    Route::get('/edit/{task?}', 'App\Http\Controllers\TaskController@form')->name('edit');
    Route::get('/delete/{task}', 'App\Http\Controllers\TaskController@delete')->name('delete')->middleware('role:1');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
