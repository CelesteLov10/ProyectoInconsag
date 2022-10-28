<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombreD');
            $table->timestamps();
        });

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Atlántida", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Choluteca", 
            ]);
        
        DB::table("departamentos")
            ->insert([
                "nombreD" => "Colón", 
            ]);
        
        DB::table("departamentos")
            ->insert([
                "nombreD" => "Copán", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Comayagua", 
            ]);
        
        DB::table("departamentos")
            ->insert([
                "nombreD" => "Cortés", 
            ]);
            
        DB::table("departamentos")
            ->insert([
                "nombreD" => "El Paraíso", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Francisco Morazán", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Gracias a Dios", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Intibuca", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Islas de a Bahía", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "La paz", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Lempira", 
            ]);
        
        DB::table("departamentos")
            ->insert([
                "nombreD" => "Ocotepeque", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Olancho", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Santa Bárbara", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Valle", 
            ]);

        DB::table("departamentos")
            ->insert([
                "nombreD" => "Yoro", 
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departamentos');
    }
};
