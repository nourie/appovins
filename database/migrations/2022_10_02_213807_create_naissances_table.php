<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('naissances', function (Blueprint $table) {
            $table->id();
            $table->foreignid('id_mere')->references('id')->on('ovins')->constrained;
            $table->date('date_naissance');
            $table->integer('nombre');
            $table->integer('nombre_en_vie');
            $table->integer('nombre_male');
            $table->integer('nombre_female');
            $table->foreignid('id_user')->references('id')->on('users')->constrained;
            $table->softDeletes();
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
        Schema::dropIfExists('naissances');
    }
};
