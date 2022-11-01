<?php

use Illuminate\Support\Facades\Route;


Route::get('/ekskul','EkskulController@index');


Route::middleware('admin')->group(function(){
    Route::post('/ekskul','EkskulController@store');
    Route::post('/ekskul/{id}','EkskulController@update');
    Route::delete('/ekskul/{id}','EkskulController@destroy');
});

?>
