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


Route::resource('/properties', 'PropertiesController');

// Route::get('/tenants', 'TenantsController@index');
Route::get('/tenants/{property}', 'TenantsController@show');
Route::post('/tenants/{property}', 'TenantsController@store');
Route::patch('/tenants/{property}/{tenant}', 'TenantsController@update');
Route::delete('/tenants/{property}/{tenant}', 'TenantsController@destroy');