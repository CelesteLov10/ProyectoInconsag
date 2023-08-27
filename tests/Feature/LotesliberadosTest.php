<?php

namespace Tests\Feature;

use App\Models\Casa;
use App\Models\User;
use App\Models\Liberado;
use App\Models\Oficina;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class LotesliberadosTest extends TestCase
{ 


/*********************************************************************  LOTES LIBERADOS  ***************************************************************/

     //Validar ruta index de lote liberado (metodo get)
     public function test_Validar_controller_liberado_index()
     {
        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/liberado');
        $response->assertStatus(200);
     }

    // Validar ruta de lote liberado index con datos incorrectos (metodo get)
    public function test_Validar_controller_liberado_index_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/76856774');
            $response->assertStatus(404);
        }

     //Validar ruta create de lote liberado  (metodo get) 
      public function test_Validar_controller_liberado_create()
      {
      $user = User::findOrFail(2);
      Auth::login($user);
      $response = $this->get('/liberado/create/1');
      $response->assertStatus(200);

    }

    // Validar ruta de lote liberado create con datos incorrectos (metodo get)
    public function test_Validar_controller_liberado_create_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/6786856774');
            $response->assertStatus(404);
        } 

  //Acceder a la ruta de Listado de lotes liberados
    public function test_Validar_listado_lote_liberado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado proveedor
        $response = $this->actingAs($user)->get('/liberado');
        $response->assertStatus(200);
        $response->assertSee('Listado de lotes liberados');  // Verificar que la vista contiene el título "Listado de lotes liberados"
        $response->assertSee('Nombre del bloque'); 
        $response->assertSee('Nombre de lote');
        $response->assertSee('Nombre cliente');
        $response->assertSee('Fecha en que se liberó');
        $response->assertSee('Descripción');
    }  


    // validar para que se agregue un nuevo lote liberado
    public function test_Validar_Controller_lote_liberado_store()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/liberado',[
            'nomCliente'  => 'Earnest Heidenreich',
            'nomBloque'   => 'Bloque w',
            'nomLote' => 'voluptatem',
            'fecha'  => '2023-08-24',
            'descripcion'  => 'El lote esta liberado',
           
        
        ]);

        // Trae el nuevo registro lote liberado
        $liberado = Liberado::where('nomBloque','=','Earnest Heidenreich')->get();

        // comprueba si me agrego el nuevo lote liberado
        $this->assertTrue(  count($liberado) == 1 );

    }


    // Validar el controlador de lote liberado dejando nombre del cliente vacio
    public function test_Validar_Controller_lote_con_nombre_del_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/liberado',[
                'nomCliente'  => '',
                'nomBloque'   => 'Bloque w',
                'nomLote' => 'voluptatem',
                'fecha'  => '2023-08-24',
                'descripcion'  => 'El lote esta liberado',
             
            ]);
            $response->assertStatus(302);
        }



     // Validar el controlador de lote liberado dejando nombre bloque vacio
     public function test_Validar_Controller_lote_con_nombre_del_bloque_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->post('/liberado',[
                    'nomCliente'  => 'Earnest Heidenreich',
                    'nomBloque'   => '',
                    'nomLote' => 'voluptatem',
                    'fecha'  => '2023-08-24',
                    'descripcion'  => 'El lote esta liberado',
                 
                ]);
                $response->assertStatus(302);
            }



         // Validar el controlador de lote liberado dejando nombre lote vacio
         public function test_Validar_Controller_lote_con_nombre_del_lote_vacio()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->post('/liberado',[
                 'nomCliente'  => 'Earnest Heidenreich',
                 'nomBloque'   => 'Bloque w',
                 'nomLote' => '',
                 'fecha'  => '2023-08-24',
                 'descripcion'  => 'El lote esta liberado',
              
             ]);
             $response->assertStatus(302);
         }


    
         // Validar el controlador de lote liberado dejando fecha lote vacio
         public function test_Validar_Controller_lote__fecha_vacio()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->post('/liberado',[
                 'nomCliente'  => 'Earnest Heidenreich',
                 'nomBloque'   => 'Bloque w',
                 'nomLote' => 'voluptatem',
                 'fecha'  => '',
                 'descripcion'  => 'El lote esta liberado',
              
             ]);
             $response->assertStatus(302);
         }




    // Validar el controlador lote , en la descripción ingresare menos de 150 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
    public function test_Validar_Controller_liberado_con_la_descripcion_menor_a_ciento_cincuenta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/liberado',[
            'nomCliente'  => 'Earnest Heidenreich',
            'nomBloque'   => 'Bloque w',
            'nomLote' => 'voluptatem',
            'fecha'  => '2023-08-24',
            'descripcion'  => 'El lote ',
         
        ]);
        
        $response->assertStatus(302);
    }



    // Validar el controlador lote , en la descripción ingresare mayor de 150 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
    public function test_Validar_Controller_liberado_con_la_descripcion_mayor_a_ciento_cincuenta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/liberado',[
            'nomCliente'  => 'Earnest Heidenreich',
            'nomBloque'   => 'Bloque w',
            'nomLote' => 'voluptatem',
            'fecha'  => '2023-08-24',
            'descripcion'  => 'El lote ya esta pagado no tienen ninguna cuota pendiente por
             lo tanto las cuotas que quedaba restando ya están canceladas y esta al corriente con sus pagoos ',
         
        ]);
        
        $response->assertStatus(302);
    }





}