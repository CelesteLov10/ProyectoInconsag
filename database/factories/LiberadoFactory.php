<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LiberadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nomBloque' =>$this->faker->word(),
            'nomLote' =>$this->faker->word(),
            'nomCliente' =>$this->faker->name(),
            'fecha'=>$this->faker->date($format = 'd-m-Y'),
        ];
    }
}
