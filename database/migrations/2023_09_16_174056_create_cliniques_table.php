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
        Schema::create('cliniques', function (Blueprint $table) {
            $table->id();
            $table->foreignid('id_ovin')->references('id')->on('ovins')->constrained;
            $table->string('nomcode')->nullable();
            $table->date('date_hosp');
            $table->text('Symptomes');
            $table->real('temperature')->nullable();
            $table->real('poids')->nullable();
            $table->real('age')->nullable();
            $table->text('traitement');
            $table->integer('duree');
            $table->date('verifecation');
            $table->date('guerison')->nullable();
            $table->text('Autopsie')->nullable();
            $table->text('remarque')->nullable();
            $table->foreignid('id_status')->references('id')->on('status')->constrained;
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
        Schema::dropIfExists('cliniques');
    }
};
