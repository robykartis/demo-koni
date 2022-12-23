<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Profil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_profil', function (Blueprint $table) {

            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->string('yt')->nullable();
            $table->string('logo')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('sejarah')->nullable();



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
