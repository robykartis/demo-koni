<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Club extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_club', function (Blueprint $table) {

            $table->id();
            $table->string('id_cabor');
            $table->string('club')->nullable();
            $table->string('alamat')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('sk')->nullable();

            $table->string('logo')->nullable();





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
