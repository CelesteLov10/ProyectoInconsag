<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oficina>
 */
class OficinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreDepto'=>$this->faker->unique()->word(),
            'direccion'=>$this->faker->address(),
            'cantidadInv'=>$this->faker->numberBetween(1,50),
            'inventario_id'=>$this->faker->numberBetween(1,50)
        ];
    }
}
