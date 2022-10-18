<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
 */
class InventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreInv'=>$this->faker->word(),
            'cantidad'=>$this->faker->numberBetween(1,100),
            'descripcion'=>$this->faker->paragraph(),
            'fecha'=>$this->faker->date($format = 'd-m-Y'),
            'empleado_id'=>$this->faker->numberBetween(1,50),
            'oficina_id'=>$this->faker->numberBetween(1,10)

        ];
    }
}
