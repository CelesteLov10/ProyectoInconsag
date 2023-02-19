<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pago>
 */
class PagoFactory extends Factory
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
            'venta_id' =>$this->faker->numberBetween(1,25),
            'cliente_id' =>$this->faker->numberBetween(1,30),
            'lote_id' =>$this->faker->numberBetween(1,25),
            'fechaPago' =>$this->faker->date(),
            'cantidadCuotasPagar' =>$this->faker->randomDigit([1,12]),
            'cuotaPagar' =>$this->faker->numberBetween(2500.00, 30000.00),
            'saldoEnCuotas' =>$this->faker->numberBetween(2500.00, 30000.00),
            'valorTerrenoPagar' =>$this->faker->numberBetween(250000.00, 3000000.00),
            //'nuevoSaldo'=>$this->faker->numberBetween(2500,245000 ),


        ];
    }
}
/* $table->unsignedBigInteger('venta_id');//Relacion con tabla bloque
            $table->foreign('venta_id')->references('id')->on('ventas');// Restriccion llave foranea
             $table->unsignedBigInteger('cliente_id');//Relacion con tabla bloque
            $table->foreign('cliente_id')->references('id')->on('clientes');// Restriccion llave foranea
             $table->unsignedBigInteger('lote_id');//Relacion con tabla bloque
            $table->foreign('lote_id')->references('id')->on('lotes');// Restriccion llave foranea
            $table->string('fechaPago');
            $table->number('cantidadCuotasPagar');
            $table->integer('saldoEnCuotas');
            $table->bigInteger('nuevoSaldo'); */