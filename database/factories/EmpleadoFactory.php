<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puesto>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'identidad'=>$this->faker->numerify('#############'),
            'nombres'=>$this->faker->name(),
            'apellidos'=>$this->faker->lastname(),
            'telefono'=>$this->faker->phoneNumber(),
            'estado'=>$this->faker->randomElement(['Activo','Inactivo']),
            'correo'=>$this->faker->email(),
            'fechaNacimiento'=>$this->faker->date($format = 'Y/m/d', $max = 2001),
            'direccion'=>$this->faker->address(),
            'fechaIngreso'=>$this->faker->date(),
            'puesto_id'=>$this->faker->numberBetween(1,50)
        ];
    }
}

