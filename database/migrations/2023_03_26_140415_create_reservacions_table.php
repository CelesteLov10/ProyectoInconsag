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
        Schema::create('reservacions', function (Blueprint $table) {
             //$table->engine = 'InnoDB';
            $table->id();
            $table->string('nombreCliente');
            $table->string('identidadCliente')->unique();
            $table->string('telefono');
            $table->string('correoCliente');
            $table->string('fechaCita');
            $table->string('horaCita');
            // $table->unsignedBigInteger('empleado_id');//Relacion con tabla empleado
             //$table->foreign('empleado_id')->references('id')->on('empleados');// Restriccion llave foranea
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
        Schema::dropIfExists('reservacions');
    }
};
