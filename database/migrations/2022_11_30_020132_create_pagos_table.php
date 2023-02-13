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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');//Relacion con tabla bloque
            $table->foreign('venta_id')->references('id')->on('ventas');// Restriccion llave foranea
            $table->unsignedBigInteger('cliente_id');//Relacion con tabla bloque
            $table->foreign('cliente_id')->references('id')->on('clientes');// Restriccion llave foranea
            $table->unsignedBigInteger('lote_id');//Relacion con tabla bloque
            $table->foreign('lote_id')->references('id')->on('lotes');// Restriccion llave foranea
            $table->string('fechaPago');
            $table->integer('cantidadCuotasPagar');
            $table->double('cuotaPagar', 2);
            $table->double('saldoEnCuotas', 2);
            $table->double('valorTerrenoPagar', 2);
           //$table->bigInteger('nuevoSaldo');
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
        Schema::dropIfExists('pagos');
    }
};
