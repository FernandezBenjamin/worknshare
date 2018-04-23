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

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin','UserController@admin');
    Route::post('/admin','UserController@admin');
});

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');


Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');


Route::get('/ajouter-un-site', 'SitesController@create');
Route::post('/ajouter-un-site', 'SitesController@store');

Route::get('/reserver-un-espace', 'RoomsController@reserve');
Route::post('/reserver-un-espace', 'RoomsController@store');


