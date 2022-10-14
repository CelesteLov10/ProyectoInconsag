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
            'identidad'=>$this->faker->unique()->numerify('#############'),
            'nombres'=>$this->faker->name(),
            'apellidos'=>$this->faker->lastname(),
            'telefono'=>$this->faker->phoneNumber(),
            'estado'=>$this->faker->randomElement(['activo','inactivo']),
            'correo'=>$this->faker->unique()->email(),
            'fechaNacimiento'=>$this->faker->dateTime($max = 2001),
            'direccion'=>$this->faker->address(),
            'fechaIngreso'=>$this->faker->dateTime(),
            'puesto_id'=>$this->faker->numberBetween(1,30)
        ];
    }
}

