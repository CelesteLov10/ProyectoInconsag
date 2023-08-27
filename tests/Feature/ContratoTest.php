<?php
namespace Tests\Feature;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ContratoTest extends TestCase
{
 //CONTADO
    public function test_Validar_ruta_del_boton_imprimir_contrato_del_listdo_de_ventas()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('venta/19/pdf');
        $response->assertStatus(200);
    }

    
    public function test_Validar_ruta_invalida_del_boton_imprimir_contrato_del_listdo_de_ventas()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('venta/210000/pdf');
        $response->assertStatus(404);
    }


     //CREDITO
     public function test_Validar_ruta_del_boton_imprimir_credito_del_listdo_de_ventas()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->get('venta/15/pdf');
         $response->assertStatus(200);
     }
 
     
     public function test_Validar_ruta_invalida_del_boton_imprimir_credito_del_listdo_de_ventas()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->get('venta/999900/pdf');
         $response->assertStatus(404);
     }
}