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
        Schema::create('temp_achats', function (Blueprint $table) {
            $table->id();
            $table->date('date_retour');
            $table->date('date_achat')->nullable();
            $table->date('date_naissance')->nullable();
            $table->integer('num')->unique();
            $table->boolean('sexe');
            $table->boolean('taged');
            $table->integer('id_ovin');
            $table->integer('nombre_retour');
            $table->integer('nb_male');
            $table->integer('nb_female');
            $table->integer('nb_angeau');
            $table->foreignid('id_vendeur')->references('id')->on('users')->constrained;
            $table->foreignid('id_achat')->references('id')->on('achats')->constrained;
            $table->string('name_vendeur');
            $table->double('prix_retour', 15, 2)->nullable();
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
        Schema::dropIfExists('temp_achats');
    }
};
