<?php

use Illuminate\Support\Facades\Route;
 
Route::get('/', function () {
    return view('index');
});

Route::get('/eventos/create', function () {
    return view('create_evento');
});

Route::get('/edit/{id}', 'EventoController@edit')->name('eventos.edit');
Route::get('/view/{id}', 'EventoController@show')->name('eventos.view');
Route::get('/create', 'EventoController@create')->name('eventos.create');

Route::get('/convidado/create/{id}', 'ConvidadoController@create')->name('convidados.create');
Route::get('/convidado/edit/{id}', 'ConvidadoController@edit')->name('convidados.edit');
Route::get('/convidado/view/{id}', 'ConvidadoController@show')->name('convidados.view');