<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Beneficiario>
 */
class BeneficiarioFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->id();
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identidadBen'=>$this->faker->unique()->numerify('#############'),
            'nombreCompletoBen'=>$this->faker->name(),
            'telefonoBen'=>$this->faker->unique()->phoneNumber(),
            'direccionBen'=>$this->faker->address(),
            'cliente_id'=>$this->faker->numberBetween(1,30),
        ];
    }
}
