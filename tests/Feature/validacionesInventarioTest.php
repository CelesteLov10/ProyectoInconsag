<?php
namespace Tests\Feature;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ValidacionesInventarioTest extends TestCase
{


    //NOMBRE INV
    public function test_Validar_Controlador_inventario_store_nuevo_nombreInv_con_numeros()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/inventario',[
            'nombreInv'=>'999999999999999999',
            'cantidad'=> 1000,
            'precioInv'=>5000,
            'descripcion'=>'herramientas de medicion de terrenos',
            'fecha' =>'22-08-2023',
            'empleado_id' => 1,
            'oficina_id'=> 1,
        ]);

        $response->assertStatus(302);
    }

        //IDENTIDAD
        public function test_Validar_Controlador_inventario_store_nuevo_cantidad_con_letras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/inventario',[
                'nombreInv'=>'Herramientas',
                'cantidad'=> 'yyyyyyyyyy',
                'precioInv'=>5000,
                'descripcion'=>'herramientas de medicion de terrenos',
                'fecha' =>'22-08-2023',
                'empleado_id' => 1,
                'oficina_id'=> 1,
            ]);
    
            $response->assertStatus(302);
        }


        public function test_Validar_Controlador_inventario_store_nuevo_cantidad_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/inventario',[
                'nombreInv'=>'Herramientas',
                'cantidad'=> '',
                'precioInv'=>5000,
                'descripcion'=>'herramientas de medicion de terrenos',
                'fecha' =>'22-08-2023',
                'empleado_id' => 1,
                'oficina_id'=> 1,
            ]);
    
            $response->assertStatus(302);
        }


        public function test_Validar_Controlador_inventario_store_nuevo_descripcion_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/inventario',[
                'nombreInv'=>'Herramientas',
                'cantidad'=> 100,
                'precioInv'=>5000,
                'descripcion'=>'',
                'fecha' =>'22-08-2023',
                'empleado_id' => 1,
                'oficina_id'=> 1,
            ]);
    
            $response->assertStatus(302);
        }

//hace la validacion, pero igual lo guarda
        public function test_Validar_Controlador_inventario_store_nuevo_fecha_anterior_a_la_actual()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/inventario',[
                'nombreInv'=>'Herramienta',
                'cantidad'=> 1000,
                'precioInv'=>5000,
                'descripcion'=>'herramientas de medicion de terrenos',
                'fecha' =>'19-08-2023',
                'empleado_id' => 1,
                'oficina_id'=> 1,
            ]);
    
            $response->assertStatus(302);
        }

        public function test_Validar_Controlador_inventario_store_nuevo_empleadId_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/inventario',[
                'nombreInv'=>'Herramienta',
                'cantidad'=> 1000,
                'precioInv'=>5000,
                'descripcion'=>'herramientas de medicion de terrenos',
                'fecha' =>'22-08-2023',
                'empleado_id' => '',
                'oficina_id'=> 1,
            ]);
    
            $response->assertStatus(302);
        }

        public function test_Validar_Controlador_inventario_store_nuevo_oficinaId_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/inventario',[
                'nombreInv'=>'Material',
                'cantidad'=> 1000,
                'precioInv'=>5000,
                'descripcion'=>'herramientas de medicion de terrenos',
                'fecha' =>'22-08-2023',
                'empleado_id' => 1,
                'oficina_id'=> '',
            ]);
    
            $response->assertStatus(302);
        }
}