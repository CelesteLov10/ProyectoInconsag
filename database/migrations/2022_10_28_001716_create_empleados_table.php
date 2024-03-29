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
            $table->string('identidad')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('telefono');
            $table->string('correo');
            $table->string('fechaNacimiento');
            $table->string('direccion');
            $table->string('fechaIngreso');
            $table->unsignedBigInteger('puesto_id');//Relacion con tabla puesto
            $table->foreign('puesto_id')->references('id')->on('puestos');// Restriccion llave foranea
            $table->unsignedBigInteger('oficina_id');//Relacion con tabla oficina
           
            $table->foreign('estado_id')->references('id')->on('estados');// Restriccion llave foranea
            $table->unsignedBigInteger('estado_id');//Relacion con tabla estado
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
