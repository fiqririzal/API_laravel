<?php

use Illuminate\Support\Facades\Route;

Route::get('/produk','ProdukController@index');
Route::post('/produk/{id}','ProdukController@update');
Route::delete('/produk/{id}','ProdukController@destroy');
