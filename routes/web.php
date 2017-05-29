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

Route::get('/unit/{id}', 'HomeController@show')->name('unit');

Route::get('/unit/{unit_id}/section/{section_id}', 'UnitController@show')->name('section');

Route::get('/unit/{unit_id}/info', 'UnitController@info')->name('unit_info');
