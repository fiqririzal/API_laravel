<?php

use Illuminate\Support\Facades\Route;


Route::get('/kelas','KelasController@index');
Route::get('/kelas/{id}','KelasController@show');
Route::post('/kelas/{id}','KelasController@update');
Route::delete('/kelas/{id}','UserController@destroy');
