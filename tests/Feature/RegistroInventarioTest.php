<?php
namespace Tests\Feature;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistroInventarioTest extends TestCase
{
    

public function test_Validar_Controlador_inventario_store_nuevo_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/inventario',[
            'nombreInv'=>'computadorasf',
            'cantidad'=> 100,
            'precioInv'=>500,
            'descripcion'=>'herramientas de medicion de lotes',
            'fecha' =>'20-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
      
        ]);


        // Traerme el inventario que se registro
        $inventario = Inventario::where('nombreInv','=','computadorasf')->get();

        // comprueba si me trajo el inventario, con la funcion count cuenta los registros si es 1 esque si lo registro
        $this->assertTrue(  count( $inventario) == 1 );

    }

    public function test_Validar_Controlador_inventario_store_nuevo_inventario_repetido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/inventario',[
            'nombreInv'=>'computadorasf',
            'cantidad'=> 100,
            'precioInv'=>500,
            'descripcion'=>'herramientas de medicion de lotes',
            'fecha' =>'20-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
      
        ]);

        $response->assertStatus(302);

    }

    public function test_Validar_ruta_del_boton_atras_de_registro_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario');
        $response->assertStatus(200);
    }

    
    public function test_Validar_ruta_invalida_del_boton_atras_de_registro_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventarioooo');
        $response->assertStatus(404);
    }
  }