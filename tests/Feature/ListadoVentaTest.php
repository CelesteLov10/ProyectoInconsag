<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ListadoVentaTest extends TestCase
{
    public function test_18_acceso_lista_venta_antes_de_logueo()
    {
        $response = $this->get(route('venta.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_19_acceso_lista_venta_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.index'));
        $response->assertStatus(200);
    }

    public function test_20_acceso_nueva_venta_antes_de_logueo()
    {
        $response = $this->get(route('venta.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_21_acceso_nueva_venta_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('venta.create'));
        $response->assertStatus(200);
    }

    public function test_22_acceso_lista_venta_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('venta.index'));
        $response->assertSeeText('Listado');
    }

    public function test_23_acceso_nueva_venta_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('venta.create'));
        $response->assertSeeText('Registro');
    }
}
