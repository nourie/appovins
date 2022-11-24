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
        Schema::create('achats', function (Blueprint $table) {
            $table->id();
            $table->date('date_achat');
            $table->integer('nombre_achat');
            $table->integer('nb_male');
            $table->integer('nb_female');
            $table->integer('nb_angeau');
            $table->foreignid('id_vendeur')->references('id')->on('users')->constrained;
            $table->double('prix_achat', 15, 2)->nullable();
            $table->boolean('updatable');
            $table->boolean('numerotable');
            $table->boolean('type');// 0 achat 1=avoir
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
        Schema::dropIfExists('achats');
    }
};
