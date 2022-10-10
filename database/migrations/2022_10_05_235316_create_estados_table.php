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
        Schema::create('estados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nombreE');
            $table->timestamps();
        });

      /*  DB::table('estados')->insert([
            ['nombreE'=>'Activo'],
            ['nombreE'=>'Inactivo'],  
        ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
};
