<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Casa>
 */
class CasaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'claseCasa'=>$this->faker->randomElement(['A','B','C']),   
            'valorCasa'=>$this->faker->numberBetween(5000, 10125),  
            'cantHabitacion'=>$this->faker->numberBetween(1, 3),
            'descripcion'=>$this->faker->word(),                             
            'constructora_id'=>$this->faker->numberBetween(1,25),
        ];
    }
}
