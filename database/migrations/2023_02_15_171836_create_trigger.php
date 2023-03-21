<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CreateTrigger extends Migration {

    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER actualizarEstado BEFORE INSERT ON `ventas` FOR EACH ROW
            BEGIN
            update lotes set status = "Vendido" where id= new.lote_id;
            END
        ');

        DB::unprepared('
        CREATE TRIGGER liberarLote AFTER INSERT ON `liberados` FOR EACH ROW
        BEGIN
        
        update lotes set status = "Disponible" where nombreLote = new.nomLote;
        
        END
        ');

        // Trigger que elimina la informacion de la tabla que esta en el create planillas 
        // para pasarla a la tabla de "tablaplanillas"
        // DB::unprepared('
        // CREATE TRIGGER limpiarTabla AFTER INSERT ON `tablaplanillas` FOR EACH ROW
        // BEGIN

        // DELETE FROM planillas;
        
        // END
        // ');
        
        // DB::unprepared('
        // CREATE TRIGGER agregarinfo AFTER INSERT ON `planillas` FOR EACH ROW
        // BEGIN
        
        // INSERT INTO tablaplanillas (identidad_empleado, nombre_empleado, sueldo_empleado, puesto_empleado, total_empleado)
        // VALUES ("0704200100156","Carlos","10000","Drummer","10000");
        
        // END
        // ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER "actualizarEstado"');
        DB::unprepared('DROP TRIGGER "liberarLote"');

    }
}