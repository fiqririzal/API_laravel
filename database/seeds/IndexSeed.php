<?php

use App\User;
use App\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class IndexSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = User::insertGetId([
        'name'=> 'Fiqri',
            'email' => 'fiqririzal10@gmail.com',
            'password' => Hash::make('12345678'),
            'role'=>'1',
            'created_at' => date('Y-m-d H:i:s')

        ]);
        UserDetail::insert([
            'user_id'=>$id,
            'kelas_id'=> 1,
            'address' => 'jalan babakan desa01/01',
            'phone' => '081234567',
            'nama_anak'=>'fiqri',
            'kelamin'=>'perempuan',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $faker = \Faker\Factory::create();

        for($i = 0 ; $i <= 51; $i++ ){
            $id =User::insertGetId([
                'name' =>$faker->name,
                'email' =>$faker->unique()->safeEmail,
                'password' =>Hash::make('password'),
                'created_at'=>date('Y-m-d H:i:s')
            ]);
            UserDetail::insert([
                'user_id'=>$id,
                'kelas_id'=> $i + 1,
                'address'=>$faker->address,
                'phone'=>$faker->phoneNumber,
                'nama_anak'=>$faker->name,
                'kelamin'=>'lelaki'
            ]);
        }
        Artisan::call('passport:install');
    }
}
