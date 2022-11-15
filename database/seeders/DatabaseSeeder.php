<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Puesto;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\Maquinaria;
use App\Models\Oficina;
use App\Models\Proveedor;
use App\Models\Municipio;
use App\Models\Bloque;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Puesto::factory(30)->create();
        Oficina::factory(10)->create();
        Empleado::factory(50)->create();
        Inventario::factory(100)->create();
        Proveedor::factory(10)->create();
        Maquinaria::factory(30)->create();
        Bloque::factory(30)->create();
    }
}