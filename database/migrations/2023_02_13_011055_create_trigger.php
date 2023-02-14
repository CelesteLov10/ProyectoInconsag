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
    }

    public function down()
    {
        DB::unprepared('DROP TRIGGER "actualizarEstado"');
    }
}