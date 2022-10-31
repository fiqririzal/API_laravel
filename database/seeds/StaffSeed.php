<?php

use App\Staff;
use Illuminate\Database\Seeder;

class StaffSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();
        for($i = 0; $i <=51 ;$i++){
            $id = Staff::insertGetId([
                'nama'=>$faker->name,
                'jabatan'=>$faker->name,
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }
}
}
