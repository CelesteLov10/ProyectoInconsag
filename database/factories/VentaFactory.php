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
            'cliente_id'=>$this->faker->numberBetween(1,30),
            'bloque_id'=>$this->faker->numberBetween(1,5),   
            'lote_id'=>$this->faker->numberBetween(1,25),
            'fechaVenta'=>$this->faker->date($format = 'd-m-Y'),
            'valorTerreno'=>$this->faker->numberBetween(250000, 512658),                            
            'formaVenta'=>$this->faker->randomElement(['contado', 'credito']),
            'valorPrima'=>$this->faker->numberBetween(5000, 10125),
            'cantidadCuotas'=>$this->faker->numberBetween(10,20),
            'valorCuotas'=>$this->faker->randomDigit([2500, 1500]),
            'valorRestantePagar'=>$this->faker->numberBetween(240550,451698)

        ];
    }
    
}
