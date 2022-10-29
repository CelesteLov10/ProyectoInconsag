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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombreProveedor');
            $table->string('nombreContacto');
            $table->string('cargoContacto');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->unsignedBigInteger('categoria_id');//Relacion con tabla categoria select
            $table->foreign('categoria_id')->references('id')->on('categorias');// Restriccion llave foranea
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
        Schema::dropIfExists('proveedores');
    }
};
