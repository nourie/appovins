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
        Schema::create('avorters', function (Blueprint $table) {
            $table->id();
            $table->foreignid('id_user')->references('id')->on('users')->constrained;
            $table->foreignid('id_mere')->references('id')->on('ovins')->constrained;
            $table->date('date_avorter');
            $table->integer('nombre');
            $table->boolean('naissance');// 0= avorter 1 =naissance
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
        Schema::dropIfExists('avorters');
    }
};
