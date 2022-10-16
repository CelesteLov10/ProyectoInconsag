<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oficina>
 */
class OficinaFactory extends Factory
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
            'nombreOficina' =>$this->faker->catchPhrase(),
            'municipio'=>$this->faker->state(),
            'direccion'=>$this->faker->address()

        ];
    }
}
/*'nombreOficina');
            $table->string('municipio');
            $table->string('direccion' */