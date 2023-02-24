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
        Schema::create('casas', function (Blueprint $table) {
            $table->id();
            $table->string('claseCasa');
            $table->string('valorCasa');
            $table->string('cantHabitacion');
            $table->string('descripcion');
            $table->unsignedBigInteger('constructora_id');//Relacion con tabla constructora
            $table->foreign('constructora_id')->references('id')->on('constructoras');// Restriccion llave foranea
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
        Schema::dropIfExists('casas');
    }
};
