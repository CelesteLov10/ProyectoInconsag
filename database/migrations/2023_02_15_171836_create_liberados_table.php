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
        Schema::create('liberados', function (Blueprint $table) {
            $table->id();
            $table->string('nomBloque');
            $table->string('nomLote');
            $table->string('nomCliente');
            $table->string('fecha');
            $table->string('descripcion');
            // $table->unsignedBigInteger('lote_id');//Relacion con tabla lote
            // $table->foreign('lote_id')->references('id')->on('lotes');
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
        Schema::dropIfExists('liberados');
    }
};
