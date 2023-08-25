<?php

namespace Tests\Feature;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ListadoEmpleadosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
 
    public function test_Validar_Controlador_listado_de_empleados()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_listado_de_empleados()
    {
        $response = $this->get('/empleados');
        $response->assertStatus(404);
    }


    public function test_Validar_ruta_del_boton_nuevo_empleado_de_listado_de_empleados()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado/create');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_del_boton_nuevo_empleado_de_listado_de_empleados()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado/createeee');
        $response->assertStatus(404);
    }


    public function test_Validar_ruta_del_boton_detalle_de_listado_de_empleados_por_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado/1');
        $response->assertStatus(200);
    }


    public function test_Validar_ruta_del_boton_detalle_de_listado_de_empleados_con_empleado_que_no_existe()
    {   $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado/599999999');
        $response->assertStatus(404);
    }

    public function test_validar_controlador_empleado_edit_ruta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado/1/edit');
        $response->assertStatus(200);
    }

    public function test_Validar_Controlador_empleado_edit_ruta_invalida()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado/64435/edit');
        $response->assertStatus(404);
    }

}
