<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukGaleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_galeris', function (Blueprint $table) {
            $table->id();
            $table->text('galeri');
            $table->unsignedBigInteger('produk_id');
            $table->timestamps();

            $table->foreign('produk_id')
            ->references('id')
            ->on('produks')
            ->onUpdate(DB::raw('NO ACTION'))
            ->onDelete(DB::raw('NO ACTION'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_galeri');
    }
}
