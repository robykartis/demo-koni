<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prestasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_prestasi', function (Blueprint $table) {

            $table->id();
            $table->string('id_atlet');
            $table->string('kejuaraan')->nullable();
            $table->string('tempat')->nullable();
            $table->string('tahun')->nullable();
            $table->string('medali')->nullable();

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
