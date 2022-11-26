<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identidadC'=>$this->faker->unique()->numerify('#############'),
            'nombreCompleto'=>$this->faker->name(),
            'telefono'=>$this->faker->unique()->phoneNumber(),
            'direccion'=>$this->faker->address(),
            'fechaNacimiento'=>$this->faker->date($format = 'd-m-Y',$max = 2001),
        ];
    }
}
