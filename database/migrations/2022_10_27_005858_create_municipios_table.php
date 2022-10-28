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
        Schema::create('municipios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreM');
            $table->unsignedBigInteger('departamento_id');//Relacion con tabla departamento
            $table->foreign('departamento_id')->references('id')->on('departamentos');// Restriccion llave foránea  de departamento
            $table->timestamps();
        });

        DB::table("municipios")
            ->insert([
                "nombreM" => "La ceiba", 
                "departamento_id" => "1",
            ]);
        
            DB::table("municipios")
            ->insert([
                "nombreM" => "El porvenir", 
                "departamento_id" => "1",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Esparta", 
                "departamento_id" => "1",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Jutiapa", 
                "departamento_id" => "1",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Masica", 
                "departamento_id" => "1",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San francisco", 
                "departamento_id" => "1",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Tela", 
                "departamento_id" => "1",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Arizona", 
                "departamento_id" => "1",
            ]);

        DB::table("municipios")
            ->insert([
                "nombreM" => "Choluteca", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Apacilagua", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepci[on de maria", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Duyure", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Corpus", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Triunfo", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Marcovia", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Morolica", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Namasigue", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Orocuina", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Pespire", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio de Flores", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Isidrio", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San José", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Marcos de Colón", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Ana de Yusguare", 
                "departamento_id" => "2",
            ]);

        DB::table("municipios")
            ->insert([
                "nombreM" => "Trujillo", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Balfate", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Iriona", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Limón", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Saba", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Fé", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Rosa de Aguán", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Sonaguera", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Tocoa", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Bonito Oriental", 
                "departamento_id" => "3",
            ]);
        DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Rosa de Copán", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Cabañas", 
                "departamento_id" => "4",
            ]);
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
};
