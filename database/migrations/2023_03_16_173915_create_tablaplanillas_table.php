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
        Schema::create('tablaplanillas', function (Blueprint $table) {
            $table->id();
            $table->double('totalp')->unsigned()->nullable();
            $table->date('fechap')->unique()->nullable();
            // $table->date('fechap');
            $table->string('canEmpleados')->nullable();

            $table->string('identidad_empleado')->nullable();
            $table->string('nombre_empleado')->nullable();
            $table->string('sueldo_empleado')->nullable();
            $table->string('puesto_empleado')->nullable();
            $table->string('dias_empleado')->nullable();
            $table->string('total_empleado')->nullable();


            // $table->string('dias')->nullable();
            // $table->double('total')->unsigned()->nullable();
            // $table->double('totalp')->nullable();
            // $table->string('numEmpleados')->nullable();
            // $table->date('fecha')->nullable();
            // $table->unsignedBigInteger('empleado_id')->nullable();//Relacion con tabla puesto
            // $table->foreign('empleado_id')->references('id')->on('empleados');// Restriccion llave foranea

            // $table->unsignedBigInteger('planilla_id')->unique();//Relacion con tabla puesto
            // $table->foreign('planilla_id')->references('id')->on('planillas');// Restriccion llave foranea
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
        Schema::dropIfExists('tablaplanillas');
    }
};
