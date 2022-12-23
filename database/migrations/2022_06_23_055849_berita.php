<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Berita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_berita', function (Blueprint $table) {

            $table->id();
            $table->string('judul');
            $table->string('slug');
            $table->string('tgl_berita');
            $table->string('foto');
            $table->string('isi');
            $table->string('tag');
            $table->string('id_katberita');
            $table->string('id_user');
            $table->string('aktif');
            $table->string('status');
            $table->string('visitor');


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
