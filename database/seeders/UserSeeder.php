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
            'password' => bcrypt('12345678'),
            'profile_image' => '1690366661_kuramita.jpg'
        ])->assignRole('Administrador');

        User::create([
            'name' => 'Stefy Avila',
            'email' => 'Stefany@unah.hn',
            'password' => bcrypt('12345678'),
            'profile_image' => ''
        ])->assignRole('Administrador');


        // User::factory(5)->create();
    }
}
