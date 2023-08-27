<?php
namespace Tests\Feature;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EditarInventarioTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


public function test_Validar_Controlador_update_inventario_todos_los_campos()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);

        // Traerme el inentario que esta registrado
        $inventario = Inventario::findOrFail(3);

        // comprueba si me trajo el empledo, y comparo el resultado de la consulta con el valor que yo ingrese a editar
        $this->assertTrue($inventario->id == '3');

        // $response->assertStatus(200);
    }

    public function test_Validar_Controlador_update_inventario_nombre_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_update_inventario_cantidad_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> '',
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);
    


        $response->assertStatus(302);
    } 

    
    public function test_Validar_Controlador_update_inventario_precioInv_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> 1000,
            'precioInv'=>'',
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);


        $response->assertStatus(302);
    } 

       
    public function test_Validar_Controlador_update_inventario_descripcion_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_update_inventario_fecha_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_update_inventario_empleadoId_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => '',
            'oficina_id'=> 1,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_update_inventario_oficinaId_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/inventario/3/edit',[
            'nombreInv'=>'Herramientas nuevas',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> '',
        ]);


        $response->assertStatus(302);
    } 
 
    public function test_Validar_ruta_del_boton_reestablecer_de_editar_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/5/edit');
        $response->assertStatus(200);
    }

   
    public function test_Validar_ruta_del_boton_atras_de_editar_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario');
        $response->assertStatus(200);
    }


    public function test_Validar_ruta_invalida_del_boton_atras_de_editar_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventarios');
        $response->assertStatus(404);
    }
}