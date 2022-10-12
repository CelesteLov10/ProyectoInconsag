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
        Schema::create('empleados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('identidad')->unique;
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('estado');
            $table->string('correo');
            $table->date('fechaNacimiento');
            $table->string('direccion');
            $table->date('fechaIngreso');
            $table->unsignedBigInteger('puesto_id');//Relacion con tabla puesto
            $table->foreign('puesto_id')->references('id')->on('puestos');// Restriccion llave foranea

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
        Schema::dropIfExists('empleados');
    }
};