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
        Schema::create('tablaplanillas', function (Blueprint $table) {
            $table->id();
            $table->double('totalp')->unsigned();
            $table->date('fechap')->unique();
            // $table->date('fechap');
            $table->string('canEmpleados');
            // $table->unsignedBigInteger('planilla_id')->unique();//Relacion con tabla puesto
            // $table->foreign('planilla_id')->references('id')->on('planillas');// Restriccion llave foranea
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
        Schema::dropIfExists('tablaplanillas');
    }
};
