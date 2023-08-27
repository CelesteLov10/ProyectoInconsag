<?php
namespace Tests\Feature;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ListadoInventarioTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_Validar_Controlador_listado_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_listado_de_inventario()
    {
        $response = $this->get('/inventarioo');
        $response->assertStatus(404);
    }


    public function test_Validar_ruta_del_boton_nuevo_inventario_de_listado_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/create');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_del_boton_nuevo_inventario_de_listado_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventariooooo/create');
        $response->assertStatus(404);
    }

    public function test_Validar_ruta_del_boton_detalle_de_inventario_de_listado_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/1');
        $response->assertStatus(200);
    }


    public function test_Validar_ruta_del_boton_detalle_de_listado_de_inventario_con_inventario_que_no_existe()
    {   $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/200000000000');
        $response->assertStatus(404);
    }

    public function test_validar_controlador_inventario_edit_ruta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/1/edit');
        $response->assertStatus(200);
    }

    public function test_Validar_Controlador_inventario_edit_ruta_invalida()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/64435/edit');
        $response->assertStatus(404);
    }







}