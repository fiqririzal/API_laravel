<?php

use Illuminate\Support\Facades\Route;

Route::get('/cart_register','CartRegisterController@index');
Route::post('/cart_register','CartRegisterController@store');

Route::middleware('admin')->group(function(){
    // Route::post('/ekskul/{id}','EkskulController@update');
    // Route::delete('/ekskul/{id}','EkskulController@destroy');
});
