<?php
namespace Tests\Feature;
use App\Models\User;
use App\Models\Planilla;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ListadoPlanillaTest extends TestCase
{


public function test_Validar_Controlador_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/planilla');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_listado_de_empleados()
    {
        $response = $this->get('/planillass');
        $response->assertStatus(404);
    }


    public function test_Validar_ruta_del_boton_registrar_planilla_de_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/planilla/create');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_del_boton_registrar_planilla_de_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/planilla/createeee');
        $response->assertStatus(404);
    }


    public function test_Validar_ruta_del_boton_detalles_planilla_de_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/tablaplanilla/1');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_del_boton_detalles_planilla_de_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/tablaplanilla/100');
        $response->assertStatus(404);
    }




    public function test_Validar_ruta_del_boton_imprimir_planilla_de_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/tablaplanilla/pdf/1');
        $response->assertStatus(200);
    }

    public function test_Validar_ruta_invalida_del_boton_imprimir_planilla_de_listado_de_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/tablaplanilla/pdf/1000');
        $response->assertStatus(404);
    }

}