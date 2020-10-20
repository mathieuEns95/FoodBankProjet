<?php

Route::get('/',"HomeController@index")->name("home.index");
Route::get('/nouveau-migrant',"AdminController@new_migrant")->name("migrants.new");
Route::post('/ajouter-migrant',"AdminController@add_migrant")->name("migrants.add_migrant");
Route::get('/qr-code/{code}',"AdminController@show_qr_code")->name("migrants.show_code");

Auth::routes(['register' => false]);

Route::group(['prefix' => "admin", 'middleware' => "auth"], function(){
	Route::get('/', "AdminController@index")->name('admin.index');
    Route::get('/migrants/edit/{id}',"AdminController@edit_migrant")->name("migrants.edit");
	Route::post('/migrants/update/{id}',"AdminController@update_migrant")->name("migrants.update");
	Route::post('/migrants/delete',"AdminController@delete_migrant")->name("migrants.delete");

	Route::get('/statistiques',"AdminController@statistiques")->name("statistiques");
});
