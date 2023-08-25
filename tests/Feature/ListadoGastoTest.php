<?php
namespace Tests\Feature;
use App\Models\User;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ListadoGastoTest extends TestCase
{
    public function test_Validar_Controlador_listado_de_gastos()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gasto');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_listado_de_gastos()
    {
        $response = $this->get('/gastossss');
        $response->assertStatus(404);
    }


    public function test_Validar_ruta_del_boton_nuevo_gasto_de_listado_de_gastos()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gasto/create');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_del_boton_nuevo_gasto_de_listado_de_gastos()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gasto/createeeee');
        $response->assertStatus(404);
    }

    public function test_Validar_ruta_del_boton_detalle_de_listado_de_gasto_por_gasto()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gasto/1');
        $response->assertStatus(200);
    }


    public function test_Validar_ruta_del_boton_detalle_de_listado_de_gasto_con_gasto_que_no_existe()
    {   $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gasto/599999999');
        $response->assertStatus(404);
    }

  



}