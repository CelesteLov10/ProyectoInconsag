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
        Schema::create('maquinarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombreMaquinaria');
            $table->string('modelo');
            $table->string('placa')->unique();
            $table->string('descripcion')->nullable();
            $table->string('fechaAdquisicion');
            $table->unsignedBigInteger('proveedor_id');//Relacion con tabla proveedor
            $table->foreign('proveedor_id')->references('id')->on('proveedores');// Restriccion llave foranea
            $table->enum('maquinaria', ['propia', 'alquilada']);
            $table->float('cantidadHoraAlquilada')->nullable();
            $table->float('valorHora')->nullable();
            $table->float('totalPagar')->nullable();
        
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
        Schema::dropIfExists('maquinarias');
    }
};
