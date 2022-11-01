<?php

namespace App\Http\Controllers;

use Exception;
use App\cart_register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartRegisterController extends Controller
{
    public function index(){
        $cart = cart_register::all();

        return apiResponse(200, 'success', 'List kelas', $cart);

    }
    //create transaction for cart register, this transaction from a user with price class and price from ekskul//thanks for watching ,i hope you understand what i mean cause my english not good  hahahahah
    public function store(Request $request){
        try{
            // ambil transaction from user details
            DB::transaction(function ()use($request) {
                $kelas_id = DB::table('user_details')
                    ->where('id', Auth::user()->id)
                    ->first()
                    ->kelas_id;

//get column or field price from table class
                $harga_kelas = DB::table('kelas')->where('id', $kelas_id)->first()->harga;
 //get column or field price from table ekskul

                $harga_ekskul = DB::table('ekskul')->where('id', $request->ekskul_id)->first()->harga;
                $total_pembayaran = ($harga_kelas + $harga_ekskul);

                $cart_id =
                 cart_register::insertGetId([
                    'user_id'=>Auth::user()->id,
                    'ekskul_id'=>$request->ekskul_id,
                    'total_pembayaran'=>$total_pembayaran,
                    'created_at'=>date('Y-m-d H-i-s')
                ]);
            });
            return apiResponse(201, 'success', 'Yeay Berhasil, selanjutnya Anda hanya tinggal bayar');
        } catch(Exception $e) {
            dd($e);
            return apiResponse(400, 'error', 'error', $e);
        }
    }
}
