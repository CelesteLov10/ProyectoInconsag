<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombreCat');
            $table->timestamps();
        });

        DB::table("categorias")
            ->insert([
                "nombreCat" => "Terreno", 
            ]);
        DB::table("categorias")
            ->insert([
                "nombreCat" => "Maquinaria", 
            ]);
        DB::table("categorias")
            ->insert([
                "nombreCat" => "Inventario", 
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
};
