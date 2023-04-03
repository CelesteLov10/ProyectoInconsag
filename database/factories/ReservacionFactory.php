<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombreCliente'=>$this->faker->name(),
            'identidadCliente'=>$this->faker->unique()->numerify('#############'),
            'telefono'=>$this->faker->phoneNumber(),
            'correoCliente'=>$this->faker->email(),
            'fechaCita'=>$this->faker->date($format = 'd-m-Y'),
            'horaCita'=>$this->faker->dateTime($format = 'now', $timezone = null ),
             //'horaCita'=>$this->faker->timezone($max = 'now', $timezone = null),
        // 'empleado_id'=>$this->faker->numberBetween(1,10),
            //
        ];
    }
}
