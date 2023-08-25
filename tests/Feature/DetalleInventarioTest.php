<?php
namespace Tests\Feature;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class DetalleInventarioTest extends TestCase
{
    public function test_Validar_ruta_del_boton_atras_de_detalle_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario');
        $response->assertStatus(200);
    }

    
    public function test_Validar_ruta_invalida_del_boton_atras_de_detalle_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventariooo');
        $response->assertStatus(404);
    }

}