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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::get('sample', 'PageController@sample');


Route::get('about', 'PageController@about');

// Route::get('requests/{request}/edit/search', 'RequestController@search');

Route::delete('requests/{request}', 'RequestController@destroy');
Route::get('requests/{request}/edit', 'RequestController@edit');
Route::put('requests/{request}', 'RequestController@update');
Route::post('requests/store', 'RequestController@store');
Route::get('requests/create', 'RequestController@create');
Route::get('requests/{request}', 'RequestController@show');
Route::get('requests', 'RequestController@index');

Route::get('searchitem','RequestController@find');
Route::post('additem', 'RequestController@addToCart');
Route::delete('deleteitem', 'RequestController@deleteCartItem');
Route::post('submitrequest', 'RequestController@submitRequest');


Route::resource('items', 'ItemController');
Route::post('items/modal_store','ItemController@modal_store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('sections', 'SectionController');
Route::get('section/select2-search', 'SectionController@find');


Route::resource('sepp', 'SEPPController');
Route::post('sepp/modal_store','SEPPController@modal_store');
Route::post('sepp/seppsearch','SEPPController@seppsearch');