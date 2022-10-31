<?php

use App\Produk;
use App\Produk_galeris;
use Illuminate\Database\Seeder;

class ProdukSeed extends Seeder
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
            $id = Produk::insertGetId([
                'item'=>$faker->name,
                'harga'=>$faker->numberBetween(1, 20),
                'stok'=>$faker->name,
                'keterangan'=>$faker->name,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            Produk_galeris::insert([
                'produk_id'=>$id,
                'galeri'=>$faker->name,
            ]);

        }
    }
}
