<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProveedoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreProveedor'=>$this->faker->name(),
            'nombreContacto'=>$this->faker->name(),
            'cargoContacto'=>$this->faker->jobTitle(),
            'direccion'=>$this->faker->address(),
            'ciudad'=>$this->faker->city(),
            'telefono'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->unique()->email(),
        ];
    }
}