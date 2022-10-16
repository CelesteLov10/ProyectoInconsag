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
        Schema::create('inventarios', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombreInv');
            $table->text('descripcion');
            $table->string('fecha');

            
            $table->unsignedBigInteger('empleado_id');//Relacion con tabla empleado
            $table->foreign('empleado_id')->references('id')->on('empleados');// Restriccion llave foranea

            $table->unsignedBigInteger('oficina_id');//Relacion con tabla oficina
            $table->foreign('oficina_id')->references('id')->on('oficinas');// Restriccion llave foranea
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
        Schema::dropIfExists('inventarios');
    }
};
