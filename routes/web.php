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
    return redirect('/links');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/links', 'LinksController@create');
Route::post('/links', 'LinksController@store')->middleware('auth');

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
    Route::post('/shorten', 'LinksController@store');
});

Route::get('/{short}', 'LinksController@show');

