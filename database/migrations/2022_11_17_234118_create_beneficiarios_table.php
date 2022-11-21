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
        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id();
            $table->string('identidadBen')->unique();
            $table->string('nombreCompletoBen');
            $table->string('telefonoBen');
            $table->string('direccionBen');
            $table->unsignedBigInteger('cliente_id');//Relacion con tabla proveedor
            $table->foreign('cliente_id')->references('id')->on('clientes');// Restriccion llave foranea
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
        Schema::dropIfExists('beneficiarios');
    }
};
