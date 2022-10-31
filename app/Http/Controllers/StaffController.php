<?php

namespace App\Http\Controllers;

use App\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(){
       $staff = Staff::all();

       return apiResponse(200, 'success', 'List user', $staff);

    }
    public function show($id){
        $staff = Staff::where('id', $id)->first();

        if ($staff) {
        return apiResponse(200, 'success', 'data' > $staff->staff);
        }
        return apiResponse(400, 'success', 'User Tidak Ditemukan :(', $staff);
    }
    // public function store(Request $request){
    //     $request->validate([
    //         'nama' => 'required',
    //         'jabatan' => 'required',
    //         ]);
    //     Staff::create($request->all());
    //     if ($staff) {
    //         return apiResponse(200, 'success', 'data' > $staff->staff);
    //         }
    //         return apiResponse(400, 'success', 'User Tidak Ditemukan :(', $staff);
    // }
    public function update(Request $request, $id){
        $rules =[
            'nama'=>'required',
            'jabatan'=>'required',
        ];
        $message =[
            'nama.required'=>'mohon isikan nama anda',
            'jabatan.required'=>'mohon isikan jabatan anda',

        ];

        $validator = Validator::make($request->all(),$rules,$message);
            if($validator->fails()) {
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
            }
        try{
            DB::transaction(function ()use($request,$id) {
                Staff::where('id',$id)->update([
                    'nama'=>$request->nama,
                    'jabatan'=>$request->jabatan,
                    'updated_at'=>date('Y-m-d H-i-s')
                ]);

            });
            $data =Staff::where('id',$id)->first();
            return apiResponse(202, 'success', 'produk berhasil disunting',$data);
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
    public function destroy($id){
        try {
            DB::transaction(function ()use($id) {
                Staff::where('id',$id)->delete();
            });
            return apiResponse(200,'success', 'data berhasil dispoksi');
    } catch (Exception $e) {
        return apiResponse(400, 'error', 'error', $e);
    }
}
}
