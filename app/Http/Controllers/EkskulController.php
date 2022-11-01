<?php

namespace App\Http\Controllers;

use Exception;

use App\Ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class EkskulController extends Controller
{
    public function index(){
        $ekskul = Ekskul::all();

        return apiResponse(200, 'success', 'List kelas', $ekskul);
    }
    public function store(Request $request){
        try{
            DB::transaction(function ()use($request) {
                Ekskul::insertGetId([
                    'ekskul'=>$request->ekskul,
                    'deskripsi'=>$request->deskripsi,
                    'harga'=>$request->harga,
                    'created_at'=>date('Y-m-d H-i-s')
                ]);

            });
            return apiResponse(201, 'success', 'berhasil menambah data');
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    public function update(Request $request, $id){
        $rules = [
            'ekskul' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ];
        $message = [
            'ekskul.required' => 'mohon isikan ekskul anda',
            'deskrispi.required' => 'mohon isikan keterangan kelas nya',
            'harga.required' => 'mohon isikan harga kelas',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return apiResponse(400, 'error', 'Lenkgapin dong ekskulnya teman ku', $validator->errors());
        }
        try  {
            DB::transaction(function () use ($request, $id) {
                Ekskul::where('id', $id)->update([
                    'ekskul' => $request->ekskul,
                    'deskripsi' => $request->deskripsi,
                    'harga' => $request->harga,
                    'updated_at' => date('Y-m-d H-i-s')
                ]);

            });
            return apiResponse(202, 'success', 'Selamat, berhasil menambah data ekskul');
        } catch (Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                Ekskul::where('id', $id)->delete();
            });
            return apiResponse(202, 'success', 'data berhasil dihapus');
        } catch (Exception $e) {
            return apiResponse(400, 'gagal', 'error', $e);
        }
    }
}
