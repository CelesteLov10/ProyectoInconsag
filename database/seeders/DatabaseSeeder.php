<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Puesto;
use App\Models\Empleado;
use App\Models\Estado;
use App\Models\Inventario;
use App\Models\Oficina;
use App\Models\Proveedore;

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
        Proveedore::factory(10)->create();
    }
}
