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
        Schema::create('detallesplanillas', function (Blueprint $table) {
            $table->id();
            $table->string('dias');
            $table->double('total')->unsigned();
            // $table->double('totalp')->nullable();
            // $table->string('numEmpleados')->nullable();
            $table->string('fecha');
            $table->unsignedBigInteger('empleado_id');//Relacion con tabla puesto
            $table->foreign('empleado_id')->references('id')->on('empleados');// Restriccion llave foranea
            // $table->unsignedBigInteger('puesto_id');//Relacion con tabla puesto
            // $table->foreign('puesto_id')->references('id')->on('puestos');// Restriccion llave foranea
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
        Schema::dropIfExists('detallesplanillas');
    }
};
