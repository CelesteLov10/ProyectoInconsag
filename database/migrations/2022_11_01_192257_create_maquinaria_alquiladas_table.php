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
        Schema::create('maquinaria_alquiladas', function (Blueprint $table) {
            $table->id();
            $table->float('cantidadHoraAlquilada');
            $table->float('valorHora');
            $table->string('fechaAlquiler');
            $table->unsignedBigInteger('maquinaria_id');//Relacion con tabla maquinaria
            $table->foreign('maquinaria_id')->references('id')->on('maquinarias');// Restriccion llave foranea
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
        Schema::dropIfExists('maquinaria_alquiladas');
    }
};
