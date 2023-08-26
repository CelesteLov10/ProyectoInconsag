<?php

namespace Tests\Feature;

use App\Models\Pago;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ImprimirVentasDiaTest extends TestCase
{
    public function test_11_impresion_ventas_por_dia_antes_de_logueo()
    {
        $response = $this->get(route('report.reports_day'));
        $response->assertRedirect(route('login'));
    }

    public function test_12_impresion_ventas_por_dia_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('report.reports_day'));
        $response->assertStatus(200);
    }
}
