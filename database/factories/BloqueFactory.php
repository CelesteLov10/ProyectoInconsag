<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bloque>
 */
class BloqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreBloque'=>$this->faker->unique()->bothify('Bloque ?'),                                  
            'nombreBloque'=>$this->faker->unique()->bothify('Bloque ?'),                                
            'cantidadLotes'=>$this->faker->numberBetween(1,100),
            'subirfoto'=>$this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
    
}
