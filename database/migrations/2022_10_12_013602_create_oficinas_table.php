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
            $table->string('nombreDepto');
            $table->string('direccion');
            $table->integer('cantidadInv');
            $table->unsignedBigInteger('inventario_id');//Relacion con tabla oficina
            $table->foreign('inventario_id')->references('id')->on('inventarios');// Restriccion llave foranea
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
