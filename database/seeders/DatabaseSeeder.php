<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Beneficiario;
use App\Models\Puesto;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\Maquinaria;
use App\Models\Oficina;
use App\Models\Proveedor;
use App\Models\Municipio;
use App\Models\Bloque;
use App\Models\Casa;
use App\Models\Cliente;
use App\Models\Constructora;
use App\Models\Liberado;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\Venta;
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
        Inventario::factory(50)->create();
        Proveedor::factory(10)->create();
        Maquinaria::factory(30)->create();
        Cliente::factory(30)->create();
        Beneficiario::factory(80)->create();
        Bloque::factory(5)->create();
        Lote::factory(25)->create();
        Constructora::factory(25)->create();
        Casa::factory(10)->create();
        Venta::factory(40)->create();
        Pago::factory(150)->create();
        //Liberado::factory(10)->create();
    }
}