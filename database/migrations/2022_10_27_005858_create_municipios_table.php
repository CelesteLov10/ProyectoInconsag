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

        /*ATLANTIDA */
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
                "nombreM" => "San Francisco", 
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
            /*COLON */

            DB::table("municipios")
            ->insert([
                "nombreM" => "Trujillo", 
                "departamento_id" => "2",
            ]);
              DB::table("municipios")
            ->insert([
                "nombreM" => "Balfate", 
                "departamento_id" => "2",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Iriona", 
                "departamento_id" => "2",
            ]);  
             DB::table("municipios")
            ->insert([
                "nombreM" => "Limón", 
                "departamento_id" => "2",
            ]);  
             DB::table("municipios")
            ->insert([
                "nombreM" => "Sabá", 
                "departamento_id" => "2",
            ]);   
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Fe", 
                "departamento_id" => "2",
            ]);   
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Rosa de Aguán", 
                "departamento_id" => "2",
            ]);   
            DB::table("municipios")
            ->insert([
                "nombreM" => "Sonaguera", 
                "departamento_id" => "2",
            ]);   
            DB::table("municipios")
            ->insert([
                "nombreM" => "Tocoa", 
                "departamento_id" => "2",
            ]);  
             DB::table("municipios")
            ->insert([
                "nombreM" => "Bonito Oriental", 
                "departamento_id" => "2",

            ]);   
              /*COMAYAGUA */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Comayagua", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Ajuterique", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Rosario", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Esquías", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Humuya", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Libertad", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lamaní", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Trinidad", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lejamaní", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Meámbar", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Minas de Oro", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Ojos de Agua", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Jerónimo", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San José de Comayagua", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San José del Potrero", 
                "departamento_id" => "3",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Luis", 
                "departamento_id" => "3",
            ]);

            DB::table("municipios")
            ->insert([
                "nombreM" => "San Sebastián", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Siguatepeque", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Villa de San Antonio", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lajas", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Taulabe", 
                "departamento_id" => "4",
            ]);
       
            /*COPAN */
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
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepción", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Copán Ruinas", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Corquín", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Cucuyagua", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Dolores", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Dulce Nombre", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Paraíso ", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Florida", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Jigua", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Unión ", 
                "departamento_id" => "4",
            ]);

            DB::table("municipios")
            ->insert([
                "nombreM" => "Nueva Arcadia", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Agustín", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Jerónimo", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San José", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Juan de Opoa", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Nicolás", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Pedro", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Rita", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Trinidad", 
                "departamento_id" => "4",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Veracruz", 
                "departamento_id" => "4",
            ]);

            /*CORTES */
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Pedro Sula", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Choloma", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Omoa", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Pimienta", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Potrerillos", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Puerto Cortés", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio de Cortés", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco de Yojoa", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Manuel", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Cruz de Yojoa", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Villanueva", 
                "departamento_id" => "5",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Lima", 
                "departamento_id" => "5",
            ]);


            /*CHOLUTECA */
        DB::table("municipios")
            ->insert([
                "nombreM" => "Choluteca", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Apacilagua", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepción de María", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Duyure", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Corpus", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Triunfo", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Marcovia", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Morolica", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Namasigüe", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Orocuina", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Pespire", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio de Flores", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Isidrio", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San José", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Marcos de Colón", 
                "departamento_id" => "6",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Ana de Yusguare", 
                "departamento_id" => "6",
            ]);

            /*EL PARAISO */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yuscarán", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Alauca", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Danlí", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Paraiso", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Güinope", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Jacaleapa", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Liure", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Morocelí ", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Oropolí", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Potrerillos", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio de Flores", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Lucas", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Matías", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Soledad", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Teupasenti", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Texiguat", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Vado Ancho", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yauyupe", 
                "departamento_id" => "7",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Trojes", 
                "departamento_id" => "7",
            ]);

            /*FRANCISCO MORAZAN */

            DB::table("municipios")
            ->insert([
                "nombreM" => "Tegucigalpa", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Alubarén", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Cedros", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Curarén", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Porvenir", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guaimaca", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Libertad", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Venta", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lepaterique", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Maraita", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Marale", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Nueva Armenia", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Ojojona", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Orica", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Reitoca", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Sabanagrande", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio de Oriente", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Buenaventura", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Ignacio", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Juan de Flores", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Miguelito", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Ana", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Lucia", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Talanga", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Tatumbla", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Valle de Angeles", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Villa de San Francisco", 
                "departamento_id" => "8",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Vallecillo", 
                "departamento_id" => "8",
            ]);

            /*GRACIAS A DIOS */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Puerto Lempira", 
                "departamento_id" => "9",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Brus Laguna", 
                "departamento_id" => "9",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Ahuas", 
                "departamento_id" => "9",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Juan Francisco Bulnes", 
                "departamento_id" => "9",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Villeda Morales", 
                "departamento_id" => "9",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Wampusirpi", 
                "departamento_id" => "9",
            ]);

            /*INTIBUCA */
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Esperanza", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Camasca", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Colomoncagua", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepción", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Dolores", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Intibucá", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Jesús de Otoro", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Magdalena", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Masaguara", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Isidro", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Juan de Flores", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Marcos de La Sierra", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Miguel Guancapla", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Lucía", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yamaranguila", 
                "departamento_id" => "10",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco Opalaca", 
                "departamento_id" => "10",
            ]);

            /*ISLAS DE LA BAHIA */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Roatán", 
                "departamento_id" => "11",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guanaja", 
                "departamento_id" => "11",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "José Santos Guardiola ", 
                "departamento_id" => "11",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Utila", 
                "departamento_id" => "11",
            ]);
            /*LA PAZ */
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Paz", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Aguanqueterique", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Cabañas", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Cane", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Chinacla", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guajiquiro", 
                "departamento_id" => "12",
            ]);
           
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lauterique", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Marcala", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Mercedes de Oriente", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Opatoro", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Antonio del Norte", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San José", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Juan", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Pedro de Tutule", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Ana", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Elena", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa María", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santiago Puringla", 
                "departamento_id" => "12",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yarula", 
                "departamento_id" => "12",
            ]);

            /*LEMPIRA */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Gracias", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Belén", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Candelaria", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Cololaca", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Erandique", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Gualcinse", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guarita", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Campa", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Iguala", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Las Flores", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Unión", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Virtud", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lepaera", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Mapulaca", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Piraera", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Andrés", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Juan Guarita", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Manuel Colohete", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Rafael", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Sebastián", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Cruz", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Talgua", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Tambla", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Tomalá", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Valladolid", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Virginia", 
                "departamento_id" => "13",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Marcos de Caiquín", 
                "departamento_id" => "13",
            ]);

            /*OCOTEPEQUE */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Nueva Ocotepeque", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Belén Gualcho", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepción ", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Dolores Merendón", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Fraternidad", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Encarnación", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Labor", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Lucerna", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Mercedes", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Fernando", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco del Valle", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Jorge", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Marcos", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Fé", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Sensenti", 
                "departamento_id" => "14",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Sinuapa", 
                "departamento_id" => "14",
            ]);

            /*Olancho */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Juticalpa", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Campamento", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Catacamas", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concordia", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Dulce Nombre de Culmí", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Rosaria", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Esquipulas del Norte", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Gualaco", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guarizama", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guata", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Guayape", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Jano", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "La Unión", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Mangulile", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Manto", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Salamá", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Esteban", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco de Becerra", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco de La Paz", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa María del Real", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Silca", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yocón", 
                "departamento_id" => "15",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Patuca", 
                "departamento_id" => "15",
            ]);

            /*SANTA BARBARA */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Bárbara", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Arada", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Atima", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Azacualpa", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Ceguaca", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Colinas", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepción del Norte", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Concepción del Sur", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Chinda", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Níspero", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Gualala", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Ilama", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Macuelizo", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Naranjito", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Nueva Celilac", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Petoa", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Protección", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Quimistán", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco de Ojuera", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Luis", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Marcos", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Nicolás", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Pedro Zacapa", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Rita", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Vicente Centenario", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Trinidad", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Las Vegas", 
                "departamento_id" => "16",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Nueva Frontera", 
                "departamento_id" => "16",
            ]);

            /*Valle */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Nacaome", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Alianza", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Amapala", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Aramecina", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Caridad", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Goascorán", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Langue", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Francisco de Coray", 
                "departamento_id" => "17",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "San Lorenzo", 
                "departamento_id" => "17",
            ]);
            /*Yoro */
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yoro", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Arenal", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Negrito", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "El Progreso", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Jocón", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Morazán", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Olanchito", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Santa Rita", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Sulaco", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Victoria", 
                "departamento_id" => "18",
            ]);
            DB::table("municipios")
            ->insert([
                "nombreM" => "Yorito", 
                "departamento_id" => "18",
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
