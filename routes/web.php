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
Route::delete('/properties/{property}/{tenant}', 'PropertiesController@removeTenant');
Route::post('/properties/{property}/{tenant}', 'PropertiesController@addTenant');
Route::patch('/properties/{property}/{tenant}', 'PropertiesController@updateTenant');
Route::resource('properties', 'PropertiesController');

Route::resource('tenants', 'TenantsController');