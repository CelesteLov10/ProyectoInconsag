<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puesto>
 */
class PuestoFactory extends Factory
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
            'nombreCargo'=>$this->faker->unique()->jobTitle(),
            'sueldo'=>$this->faker->numberBetween(5000, 45000),
            'descripcion'=>$this->faker->paragraph()


        ];
    }
}

