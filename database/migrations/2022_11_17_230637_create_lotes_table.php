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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->integer('numLote');
            $table->double('medidaLateralR');
            $table->double('medidaLateralL');
            $table->double('medidaEnfrente');
            $table->double('medidaAtras');
            $table->string('colindanciaN');
            $table->string('colindanciaS');
            $table->string('colindanciaE');
            $table->string('colindanciaO');
            $table->unsignedBigInteger('bloque_id')->nullable();//Relacion con tabla bloque
            $table->foreign('bloque_id')->references('id')->on('bloques');
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
        Schema::dropIfExists('lotes');
    }
};
