<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'TaskController@index')->name('index');
Route::post('task','TaskController@store')->name('task');
Route::get('task/{id}', 'TaskController@edit')->name('task.edit');
Route::put('task/{id}', 'TaskController@update')->name('task.update');
Route::put('task/done/{id}', 'TaskController@done')->name('task.done');
Route::delete('task/{id}', 'TaskController@destroy')->name('task.delete');