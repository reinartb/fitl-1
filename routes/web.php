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

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', 'PageController@about');

Route::delete('requests/{request}', 'RequestController@destroy');
Route::get('requests/{request}/edit', 'RequestController@edit');
Route::put('requests/{request}', 'RequestController@update');
Route::post('requests/store', 'RequestController@store');
Route::get('requests/create', 'RequestController@create');
Route::get('requests/{request}', 'RequestController@show');
Route::get('requests', 'RequestController@index');

Route::resource('items', 'ItemController');