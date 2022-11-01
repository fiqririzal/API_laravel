<?php

use Illuminate\Support\Facades\Route;


Route::get('/kelas','KelasController@index');
Route::get('/kelas/{id}','KelasController@show');

Route::middleware('admin')->group(function(){
    Route::post('/kelas','KelasController@store');
    Route::post('/kelas/{id}','KelasController@update');
    Route::delete('/kelas/{id}','KelasController@destroy');
});
