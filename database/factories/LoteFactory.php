<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lote>
 */
class LoteFactory extends Factory
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
            'numLote' =>$this->faker->randomDigit(1,40),
            'medidaLateralR' =>$this->faker->numberBetween(12,10),
            'medidaLateralL' =>$this->faker->numberBetween(12,10), 
            'medidaEnfrente' =>$this->faker->numberBetween(12,10),
            'medidaAtras' =>$this->faker->numberBetween(12,10),
            'valorTerreno'=>$this->faker->numberBetween(250000, 512658),                            
            'colindanciaN'=>$this->faker->address(),
            'colindanciaS'=>$this->faker->address(),
            'colindanciaE'=>$this->faker->address(),
            'colindanciaO'=>$this->faker->address(),
            'bloque_id' =>$this->faker->numberBetween(1,5),
        ];
    }
}
