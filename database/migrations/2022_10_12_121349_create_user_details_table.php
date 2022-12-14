<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id');
            $table->text('address');
            $table->string('phone');
            $table->string('nama_anak');
            $table->enum ('kelamin',['lelaki','perempuan']);

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate(DB::raw('NO ACTION'))
            ->onDelete(DB::raw('NO ACTION'));

            // $table->foreign('kelas_id')
            // ->references('id')
            // ->on('kelas')
            // ->onUpdate(DB::raw('NO ACTION'))
            // ->onDelete(DB::raw('NO ACTION'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
