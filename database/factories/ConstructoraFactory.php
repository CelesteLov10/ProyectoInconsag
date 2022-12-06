<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConstructoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreConstructora'=>$this->faker->word(),
            'direccion'=>$this->faker->address(),
            'telefono'=>$this->faker->phoneNumber(),
            'email'=>$this->faker->unique()->email(),
            'fechaContrato'=>$this->faker->date($format = 'd-m-Y',$max = 2001),
            
            //
        ];
    }
}
