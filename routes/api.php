<?php

use Illuminate\Support\Facades\Route;

	Route::prefix('eventos')->group(function(){

		Route::get('/', 'EventoController@index')->name('index');
		Route::get('/{id}', 'EventoController@show')->name('show');

		Route::post('/', 'EventoController@store')->name('store');
		Route::put('/{id}', 'EventoController@update')->name('update');

		Route::delete('/{id}', 'EventoController@destroy')->name('destroy');

	});
	Route::prefix('convidados')->group(function(){
		Route::get('/index/{id}', 'ConvidadoController@index')->name('index');
		Route::get('/{id}', 'ConvidadoController@show')->name('show');

		Route::post('/', 'ConvidadoController@store')->name('store');
		Route::put('/{id}', 'ConvidadoController@update')->name('update');

		Route::delete('/{id}', 'ConvidadoController@destroy')->name('destroy');
	});