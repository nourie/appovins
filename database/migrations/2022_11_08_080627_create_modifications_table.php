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
        Schema::create('modifications', function (Blueprint $table) {
            $table->id();
            $table->string('cause', 50)->nullable();
            $table->date('date_mod');
            $table->integer('old_num');
            $table->integer('new_num');
            $table->foreignId('id_ovin')->references('id')->on('ovins')->constrained;
            //  $table->foreignid('id_user')->references('id')->on('users')->constrained; loged user
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
        Schema::dropIfExists('modifications');
    }
};
