<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $user = User::with('user_detail')->get();

        return apiResponse(200, 'success', 'List user', $user);

    }
    public function destroy($id){
        try{
            DB::transaction(function () use ($id){
                User::where('id', $id)->delete();
            });
            return apiResponse(202,'success','data berhasil dihapus');
        }catch (Exception $e){
            return apiResponse(400,'gagal','error',$e);
        }
    }
    public function show($id){
        $user = User::where('id',$id)->first();

        if($user){
            return apiResponse(200,'success', 'data'>$user->name,$user->user_detail);
        }
            return apiResponse(400,'success','User Tidak Ditemukan :(');
    }
    public function update(Request $request, $id){
        $rules =[
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required',
            'address'=>'required',
            'phone'=>'required|min:10',
            'nama_anak'=>'required',
            'kelamin'=>'required',
        ];
        $message =[
            'name.required'=>'mohon isikan nama anda',
            'email.required'=>'mohon isikan email anda',
            'email.email'=>'mohon isikan email valid',
            'email.unique'=>'email sudah terdaftar',
            'password.required'=>'mohon isikan paswwordd anda anda',
            'address.required'=>'mohon isikan alamat anda',
            'phone.required'=>'mohon isikan telepon anda',
            'phone.min'=>'nomor telepon tidak boleh kurang dari 10 angka',
            'nama_anak.required'=>'mohon isikan nama_anak anda',
            'kelamin.required'=>'Mohon isikan Jenis kelamin anak anda'
        ];
        $validator = Validator::make($request->all(),$rules,$message);
        if($validator->fails()){
            return apiResponse(400, 'error', 'Data tidak lengkap ', $validator->errors());
        }
        try{
            DB::transaction(function () use($request,$id) {
                User::where('id',$id)->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'updated_at'=>date('Y-m-d H-i-s')
                ]);
                UserDetail::where('id',$id)->update([
                    'user_id'=>$id,
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'nama_anak'=>$request->nama_anak,
                    'kelamin'=>$request->kelamin,
                    'updated_at'=>date('Y-m-d H-i-s')
                ]);

            });
            return apiResponse(202, 'success', 'user berhasil disunting');
        } catch(Exception $e) {
            return apiResponse(400, 'error', 'error', $e);
        }
    }
}
