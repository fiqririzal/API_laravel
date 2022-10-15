<?php

namespace App\Http\Controllers;

use App\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();

        return apiResponse(200, 'success', 'List user', $kelas);
    }
    public function show($id){
        $kelas = kelas::where('id',$id)->first();

        if($kelas){
            return apiResponse(200,'success', 'data'>$kelas->kelas);
        }
            return apiResponse(400,'success','User Tidak Ditemukan :(');
    }
    public function update(Request $request, $id){
            $rules =[
                'kelas'=>'required',
                'keterangan'=>'required',
                'harga'=>'required',
            ];
            $message =[
                'kelas.required'=>'mohon isikan nama anda',
                'keterangan.required'=>'mohon isikan keterangan kelas nya',
                'harga.required'=>'mohon isikan harga kelas',
            ];
            $validator = Validator::make($request->all(),$rules,$message);
            if($validator->fails()){
                return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
            }
            try{
                DB::transaction(function () use($request,$id) {
                    Kelas::where('id',$id)->update([
                        'kelas'=>$request->kelas,
                        'keterangan'=>$request->keterangan,
                        'harga'=>$request->harga,
                        'updated_at'=>date('Y-m-d H-i-s')
                    ]);

                });
                return apiResponse(202, 'success', 'user berhasil disunting');
            } catch(Exception $e) {
                return apiResponse(400, 'error', 'error', $e);
            }
        }
        public function destroy($id){
            try{
                DB::transaction(function () use ($id){
                    Kelas::where('id', $id)->delete();
                });
                return apiResponse(202,'success','data berhasil dihapus');
            }catch (Exception $e){
                return apiResponse(400,'gagal','error',$e);
            }

        }
    }

