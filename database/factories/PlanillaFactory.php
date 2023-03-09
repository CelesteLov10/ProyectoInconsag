<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planilla>
 */
class PlanillaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fecha'=>$this->faker->date($format = 'd-m-Y'),        
            'dias'=>$this->faker->numberBetween(1,30),
            'total'=>$this->faker->numberBetween(1,30),
            'empleado_id'=>$this->faker->numberBetween(1,30),
            'puesto_id'=>$this->faker->numberBetween(1,30),
        ];
    }
}
