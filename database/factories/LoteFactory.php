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
            'nombreLote' =>$this->faker->word(),
            //'status' =>$this->faker->randomElements(['Disponible', 'Vendido', 'Pagando']),
            'status'=>$this->faker->randomElement(['Disponible', 'Vendido']),
            'medidaLateralR' =>$this->faker->numberBetween(12,10),
            'medidaLateralL' =>$this->faker->numberBetween(12,10), 
            'medidaEnfrente' =>$this->faker->numberBetween(12,10),
            'medidaAtras' =>$this->faker->numberBetween(12,10),
            'valorTerreno'=>$this->faker->numberBetween(150000, 300152),                            
            'colindanciaN'=>$this->faker->address(),
            'colindanciaS'=>$this->faker->address(),
            'colindanciaE'=>$this->faker->address(),
            'colindanciaO'=>$this->faker->address(),
            'valorTerreno'=>$this->faker->numberBetween(50000, 500125),
            'bloque_id' =>$this->faker->numberBetween(1,5),
       
           
        ];
    }
}
