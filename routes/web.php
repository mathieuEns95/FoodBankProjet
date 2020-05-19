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
Auth::routes(['register' => false]);

Route::group(['prefix' => "admin", 'middleware' => "auth"], function(){
	Route::get('/', "AdminController@index")->name('admin.index');
	Route::get('/nouveau-migrant',"AdminController@new_migrant")->name("migrants.new");
	Route::post('/ajouter-migrant',"AdminController@add_migrant")->name("migrants.add_migrant");
	Route::get('/qr-code/{code}',"AdminController@show_qr_code")->name("migrants.show_code");

	Route::get('/migrants/edit/{id}',"AdminController@edit_migrant")->name("migrants.edit");
	Route::post('/migrants/update/{id}',"AdminController@update_migrant")->name("migrants.update");
	Route::get('/migrants/delete/{id}',"AdminController@delete_migrant")->name("migrants.delete");
});