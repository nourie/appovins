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
        Schema::create('temp_ventes', function (Blueprint $table) {
            $table->id();
            $table->date('date_vente');
            $table->date('date_achat')->nullable();
            $table->date('date_naissance')->nullable();
            $table->integer('num')->unique();
            $table->boolean('sexe');
            $table->boolean('taged');
            $table->integer('id_ovin');
            $table->integer('nombre_vente');
            $table->integer('nb_male');
            $table->integer('nb_female');
            $table->integer('nb_angeau');
            $table->foreignid('id_acheteur')->references('id')->on('users')->constrained;
            $table->string('name_acheteur');
            $table->double('prix_vente', 15, 2)->nullable();
            $table->boolean('saved');
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
        Schema::dropIfExists('temp_ventes');
    }
};
