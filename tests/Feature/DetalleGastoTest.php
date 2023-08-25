<?php
namespace Tests\Feature;
use App\Models\User;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DetalleNuevoGastoTest extends TestCase
{

    public function test_Validar_ruta_del_boton_atras_de_detalle_de_gasto()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gasto');
        $response->assertStatus(200);
    }

    
    public function test_Validar_ruta_invalida_del_boton_atras_de_detalle_de_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/gastos');
        $response->assertStatus(404);
    }


}