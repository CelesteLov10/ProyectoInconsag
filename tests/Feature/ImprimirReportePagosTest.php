<?php

namespace Tests\Feature;

use App\Models\Pago;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ImprimirReportePagosTest extends TestCase
{
    public function test_13_impresion_reporte_pagos_antes_de_logueo()
    {
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.print', ['id' => $pago->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_14_impresion_reporte_pagos_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.print', ['id' => $pago->id]));
        $response->assertStatus(200);
    }

    public function test_15_impresion_reporte_pagos_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('pago.print', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_16_impresion_reporte_pagos_id_texto()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('pago.print', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_17_impresion_reporte_pagos_id_decimales()
    {
        $user = User::find(1);

        Auth::login($user);
        $venta = Venta::all()->first();

        $response = $this->get(route('pago.print', ['id' => 90.898]));
        $response->assertStatus(404);
    }
}
