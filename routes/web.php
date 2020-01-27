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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/properties', 'PropertiesController@index')->name('properties');
Route::get('/properties/create', 'PropertiesController@create');
Route::post('/properties', 'PropertiesController@store');
Route::get('/properties/{property}', 'PropertiesController@show');
Route::get('/properties/{property}/edit', 'PropertiesController@edit');
Route::delete('/properties/{property}/delete', 'PropertiesController@destroy');