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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreGastos');
            $table->bigInteger('montoGastos');
            $table->string('nombreEmpresa');
            $table->string('fechaGastos');
            $table->string('descripcion');
            $table->unsignedBigInteger('empleado_id');//Relacion con tabla empleado
            $table->foreign('empleado_id')->references('id')->on('empleados');// Restriccion llave foranea
            $table->string('baucherRecibo');
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
        Schema::dropIfExists('gastos');
    }
};
