<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bloque>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreCliente'=>$this->faker->unique()->name(),                                  
            'formaVenta'=>$this->faker->paragraph(),
            'fechaVenta'=>$this->faker->date($format = 'd-m-Y'),
        ];
    }
    
}
