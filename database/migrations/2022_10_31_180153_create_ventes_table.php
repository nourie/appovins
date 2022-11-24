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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->date('date_vente');
            $table->integer('nombre_vente');
            $table->integer('nb_male');
            $table->integer('nb_female');
            $table->integer('nb_angeau');
            $table->foreignid('id_acheteur')->references('id')->on('users')->constrained;
            $table->double('prix_vente', 15, 2)->nullable();
            $table->boolean('updatable');
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
        Schema::dropIfExists('ventes');
    }
};
