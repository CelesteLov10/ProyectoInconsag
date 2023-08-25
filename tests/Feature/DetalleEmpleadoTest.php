<?php
namespace Tests\Feature;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DetalleEmpleadosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     public function test_Validar_ruta_del_boton_detalle_de_listado_de_empleado()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->get('/empleado/6');
         $response->assertStatus(200);
     }

     public function test_Validar_ruta_invalida_del_boton_detalle_de_listado_de_empleado()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->get('/empleado/9999999');
         $response->assertStatus(404);
     }

    public function test_Validar_ruta_del_boton_atras_de_detalle_de_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado');
        $response->assertStatus(200);
    }

    
    public function test_Validar_ruta_invalida_del_boton_atras_de_detalle_de_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleadosss');
        $response->assertStatus(404);
    }

}