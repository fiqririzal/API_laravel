<?php

use Illuminate\Support\Facades\Route;

Route::get('/produk','ProdukController@index');
Route::get('/produk/{id}','ProdukController@show');
Route::post('/produk','ProdukController@store');
Route::post('/produk/{id}','ProdukController@update');
Route::delete('/produk/{id}','ProdukController@destroy');
