<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
require_once('includes/auth.php');

Route::group( ['middleware' => 'auth:api'], function() {

    require_once('includes/cart_register.php');
    require_once('includes/kelas.php');
    require_once('includes/produk.php');
    require_once('includes/ekskul.php');
        Route::middleware('admin')->group(function(){
            require_once('includes/user.php');
            require_once('includes/staff.php');
        });

    }
);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
