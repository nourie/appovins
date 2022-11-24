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
        Schema::create('avoir_achats', function (Blueprint $table) {
            $table->id();
            $table->foreignid('id_achat')->references('id')->on('achats')->constrained;
            $table->foreignid('id_ovin')->references('id')->on('ovins')->constrained;
            $table->double('prix_achat', 15, 2);
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
        Schema::dropIfExists('avoir_achats');
    }
};
