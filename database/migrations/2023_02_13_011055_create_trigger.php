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


        // AUN NO FUNCIONA CORRECTAMENTE
        DB::unprepared('
        CREATE TRIGGER lotesLiberados BEFORE UPDATE ON `pagos` FOR EACH ROW
            BEGIN

            INSERT INTO liberados (nombreBloque, nombreLote, nombreCliente)
            SELECT nombreBloque, nombreLote, nombreCompleto
            FROM pagos;

            INSERT INTO liberados (fecha)
            VALUES (CURDATE());

            update lotes set status = "Disponible" where id= new.lote_id;

            END
        ');
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER "actualizarEstado"');
        DB::unprepared('DROP TRIGGER "lotesLiberados"');

    }
}