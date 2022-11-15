<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventario>
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
            'cantidadLotes'=>$this->faker->numberBetween(1,100),
            'colindancia'=>$this->faker->text(),
        ];
    }
    
}
