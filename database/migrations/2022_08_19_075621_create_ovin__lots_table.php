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
        Schema::create('ovin__lots', function (Blueprint $table) {
            $table->id();
            $table->foreignid('id_ovin')->references('id')->on('ovins')->constrained->unique;
            $table->foreignid('id_lot')->references('id')->on('lots')->constrained;
            $table->integer('num_in_lot')->length(3);
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
        Schema::dropIfExists('ovin__lots');
    }
};
