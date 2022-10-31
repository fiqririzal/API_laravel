<?php

namespace App\Http\Controllers;

use Exception;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    //show all product
    public function index(){
        $produk = Produk::with('produk_galeris')->get();

        return apiResponse(200, 'success', 'List user', $produk);
    }
    //show product by id
    public function show($id){
        $produk = produk::where('id', $id)->first();

        if ($produk) {
            return apiResponse(200, 'success', 'data' > $produk->item,$produk->produk_galeris);
        }
        return apiResponse(400, 'success', 'Produk Tidak Ditemukan :(');
    }
//create produk
    public function store(Request $request, $id){
        // $request->validated();
        try{
            DB::transaction(function ()use($request, $id) {
                $id = Produk::insertGetId([
                    'produk'=>$request->item,
                    'harga'=>$request->harga,
                    'stok'=>$request->stok,
                    'keterangan'=>$request->keterangan,
                    'created_at'=>date('Y-m-d H-i-s')
                ]);
            });
            return apiResponse(201, 'success', 'berhasil menambah data');
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    public function update(Request $request, $id){
        $rules =[
            'item'=>'required',
            'harga'=>'required',
            'stok'=>'required',
            'keterangan'=>'required',

        ];
        $message =[
            'item.required'=>'mohon isikan item anda',
            'harga.required'=>'mohon isikan harga anda',
            'stok.required'=>'mohon isikan stok valid',
            'keterangan.required'=>'keterangan produk',

        ];

        $validator =Validator::make($request->all(),$rules,$message);
            if($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
            }
        try{
            DB::transaction(function ()use($request,$id) {
                Produk::where('id',$id)->update([
                    'item'=>$request->item,
                    'harga'=>$request->harga,
                    'stok'=>$request->stok,
                    'keterangan'=>$request->keterangan,
                    'updated_at'=>date('Y-m-d H-i-s')
                ]);

            });
            $data =Produk::where('id',$id)->first();
            return apiResponse(202, 'success', 'produk berhasil disunting',$data);
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
}
