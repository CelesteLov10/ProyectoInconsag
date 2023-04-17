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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');//Relacion con tabla bloque
            $table->foreign('cliente_id')->references('id')->on('clientes');// Restriccion llave foranea
            $table->unsignedBigInteger('bloque_id');//Relacion con tabla bloque
            $table->foreign('bloque_id')->references('id')->on('bloques');// Restriccion llave foranea
            $table->unsignedBigInteger('lote_id');//Relacion con tabla lote
            $table->foreign('lote_id')->references('id')->on('lotes');
            $table->unsignedBigInteger('casa_id')->nullable();//Relacion con la tabla de casas
            $table->foreign('casa_id')->references('id')->on('casas');
            $table->unsignedBigInteger('beneficiario_id');//Relacion con tabla beneficiario
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios');
            $table->bigInteger('valorTerreno'); 

            $table->double('total')->unsigned();

            $table->string('fechaVenta'); //si lo dejo como dato string no me trae las fechas
            $table->enum('formaVenta', ['contado', 'credito']);
            $table->double('valorPrima',10,1)->nullable();
            $table->double('cantidadCuotas',10,1)->nullable();
            $table->double('valorCuotas', 10,1)->nullable();
            $table->double('valorRestantePagar', 10,1)->nullable();
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
        Schema::dropIfExists('ventas');
    }
};
