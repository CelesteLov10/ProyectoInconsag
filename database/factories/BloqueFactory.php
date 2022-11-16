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
            'nombreBloque'=>$this->faker->unique()->word(),                                  
            'cantidadLotes'=>$this->faker->numberBetween(1,100),
            'colindanciaN'=>$this->faker->text(),
            'colindanciaS'=>$this->faker->text(),
            'colindanciaE'=>$this->faker->text(),
            'colindanciaO'=>$this->faker->text(),
            'subirfoto'=>$this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
    
}
