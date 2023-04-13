<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Maria Celeste Lovo',
            'email' => 'celestelovohp@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Stefy Avila',
            'email' => 'Stefany@unah.hn',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::create([
            'name' => 'Empleado',
            'email' => 'celestelovopc11@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Empleado');

        // User::factory(5)->create();
    }
}
