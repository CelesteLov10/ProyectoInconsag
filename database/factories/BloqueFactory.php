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
            'nombreBloque'=>$this->faker->word(),                                  
            'cantidadLotes'=>$this->faker->numberBetween(1,50),
            'colindanciaN'=>$this->faker->address(),
            'colindanciaS'=>$this->faker->address(),
            'colindanciaE'=>$this->faker->address(),
            'colindanciaO'=>$this->faker->address(),
            'subirfoto'=>$this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
    
}
