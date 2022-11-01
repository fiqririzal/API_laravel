<?php

use App\Kelas;
use Illuminate\Database\Seeder;

class KelasSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $id = Kelas::insertGetId([
            'kelas'=>'coding',
            'keterangan'=>'mantap',
            'harga'=>10000,
            'created_at' => date('Y-m-d H:i:s')

        ]);
        for($i = 0; $i <=51 ;$i++){
            $id = Kelas::insertGetId([
                'kelas'=>$faker->name,
                'keterangan'=>$faker->name,
                'harga'=>10000,
                'created_at' => date('Y-m-d H:i:s')

            ]);
        }
    }
}
