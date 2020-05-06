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

Route::get('/',"HomeController@index")->name("home.index");
Route::get('/nouveau-migrant',"HomeController@new_migrant")->name("home.new");
Route::post('/ajouter-migrant',"HomeController@add_migrant")->name("home.add_migrant");
Route::get('/qr-code/{code}',"HomeController@show_qr_code")->name("home.show_code");
Route::get('/test',"HomeController@test");