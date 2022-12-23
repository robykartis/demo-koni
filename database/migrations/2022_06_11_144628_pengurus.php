<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pengurus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengurus', function (Blueprint $table) {

            $table->id();
            $table->string('id_kat_peng');
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jk')->nullable();
            $table->string('nohp')->nullable();

            $table->string('foto')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
