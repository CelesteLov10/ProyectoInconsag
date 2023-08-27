<?php

namespace Tests\Feature;

use App\Models\Pago;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class ListadoConstructoraTest extends TestCase
{
    public function test_24_acceso_lista_constructora_antes_de_logueo()
    {
        $response = $this->get(route('constructora.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_25_acceso_lista_constructora_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('constructora.index'));
        $response->assertStatus(200);
    }

    public function test_26_acceso_nueva_constructora_antes_de_logueo()
    {
        $response = $this->get(route('constructora.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_27_acceso_nueva_constructora_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('constructora.create'));
        $response->assertStatus(200);
    }

    public function test_28_acceso_lista_constructora_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);
        $response = $this->get(route('constructora.index'));
        $response->assertSeeText('Listado');
    }

    public function test_29_acceso_nueva_constructora_correctamente_con_etiquetas_adecuadas()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->get(route('constructora.create'));
        $response->assertSeeText('Registro');
    }
}
