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
        Schema::create('ovins', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->boolean('taged');
            $table->date('date_achat')->nullable();
            $table->date('date_naissance')->nullable();
            $table->boolean('sexe');
            $table->integer('poid')->nullable();
            $table->boolean('alive');
            $table->boolean('vendu');  // 0 non . 1 vendu vivante. 3 vendu viande egorge . 
            $table->boolean('invetaire')->nullable();  // 0 non trouver  . 1 trouver. 
            $table->date('date_inventaire')->nullable();
            $table->bigInteger('id_mere')->nullable();
            $table->foreignid('id_achat')->references('id')->on('achats')->nullable()->constrained;
            $table->foreignid('id_source')->references('id')->on('sources')->nullable()->constrained;
            $table->date('die_date')->nullable();
            $table->boolean('die_status')->nullable();// 0 mort 1 egorgé null alive 
            $table->string('die_cause', 80)->nullable();
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
        Schema::dropIfExists('ovins');
    }
};
