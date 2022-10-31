<?php

use Illuminate\Support\Facades\Route;


Route::get('/staff','StaffController@index');
Route::get('/staff/{id}','StaffController@show');
Route::post('/staff/{id}','StaffController@update');
Route::delete('/staff/{id}','StaffController@destroy');
