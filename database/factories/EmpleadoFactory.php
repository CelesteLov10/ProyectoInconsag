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
            'identidad'=>$this->faker->numberBetween(0, 13),
            'nombres'=>$this->faker->name(),
            'apellidos'=>$this->faker->name(),
            'teléfono'=>$this->faker->numberBetween(0, 8),
            'correo'=>$this->faker->email(),
            'fechaNacimiento'=>$this->faker->date(),
            'dirección'=>$this->faker->string(),
            'fechaIngreso'=>$this->faker->date()

        ];
    }
}

