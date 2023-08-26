<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class ListadoLoteVendidoTest extends TestCase
{
    public function test_79_acceso_listado_lotes_vendidos_antes_de_logueo()
    {

        $response = $this->get(route('pago.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_80_acceso_listado_lotes_vendidos_despues_de_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->get(route('pago.index'));
        $response->assertViewIs('pago.index');
    }

    public function test_82_acceso_listado_lotes_vendidos_con_etiquetas_adecuadas()
    {
        $user = User::find(1);
        Auth::login($user);

        $response = $this->get(route('pago.index'));
        $response->assertSeeText('Listado');
    }

}
