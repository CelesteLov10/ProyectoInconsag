<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maquinaria>
 */
class MaquinariaFactory extends Factory
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
            'nombreMaquinaria'=>$this->faker->word(),
            'modelo' =>$this->faker->bothify('??###?'),
            'placa' =>$this->faker->unique()->bothify('???####'),
            'descripcion'=>$this->faker->paragraph(), 
            'fechaAdquisicion'=>$this->faker->date($format = 'd-m-Y'),
            'proveedor_id'=>$this->faker->numberBetween(1,10),
            'maquinaria'=>$this->faker->randomElement(['propia', 'alquilada']),
            'cantidadHoraAlquilada' =>$this->faker->randomDigit([1,12]), 
            'valorHora'=>$this->faker->numberBetween(5, 1256), 
            'totalPagar'=>$this->faker->numberBetween(1000, 9000),
         

        ];
    }
}