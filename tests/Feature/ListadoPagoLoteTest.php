<?php

namespace Tests\Feature;


use App\Models\Pago;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class ListadoPagoLoteTest extends TestCase
{
    public function test_83_acceso_listado_pagos_por_lote_antes_de_logueo()
    {
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.show', ['id' => $pago->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_84_acceso_listado_pagos_por_lote_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.show', ['id' => $pago->id]));
        $response->assertStatus(200);
    }

    public function test_85_acceso_listado_pagos_por_lote_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.show', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_86_acceso_listado_pagos_por_lote_id_texto()
    {
        $user = User::find(1);
        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.show', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_87_acceso_listado_pagos_por_lote_id_decimales()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.show', ['id' => 90.898]));
        $response->assertStatus(404);
    }

}
