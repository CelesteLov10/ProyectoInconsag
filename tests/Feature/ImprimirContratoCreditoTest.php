<?php

namespace Tests\Feature;


use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ImprimirContratoCreditoTest extends TestCase
{
    public function test_6_impresion_contrato_al_credito_venta_antes_de_logueo()
    {
        $venta = Venta::all()->first();

        $response = $this->get(route('venta.contrato', ['id' => $venta->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_7_impresion_contrato_al_credito_venta_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('venta.contrato', ['id' => $venta->id]));
        $response->assertStatus(200);
    }

    public function test_8_impresion_contrato_al_credito_venta_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('venta.contrato', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_9_impresion_contrato_al_credito_venta_id_texto()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('venta.contrato', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_10_impresion_contrato_al_credito_venta_id_decimales()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('venta.contrato', ['id' => 90.898]));
        $response->assertStatus(404);
    }

}
