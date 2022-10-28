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
        Schema::create('oficinas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombreOficina');
            $table->string('direccion');
            $table->string('nombreGerente');
            $table->string('telefono');
            $table->unsignedBigInteger('departamento_id');//Relacion con tabla departamento
            $table->foreign('departamento_id')->references('id')->on('departamentos');// Restriccion llave foranea
            $table->unsignedBigInteger('municipio_id');//Relacion con tabla municipio
            $table->foreign('municipio_id')->references('id')->on('municipios');// Restriccion llave foránea
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
        Schema::dropIfExists('oficinas');
    }
};
