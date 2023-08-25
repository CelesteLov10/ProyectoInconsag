<?php

namespace Tests\Feature;

use App\Models\Casa;
use App\Models\User;
use App\Models\Puesto;
use App\Models\Oficina;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class OficinaTest extends TestCase
{

 
    /*********************************************************************   OFICINA  ***************************************************************/

     //Validar ruta index de la oficina (metodo get)
     public function test_Validar_controller_oficina_index()
     {

        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/oficina');
        $response->assertStatus(200);
     }


     // Validar ruta de la oficina index con datos incorrectos (metodo get)
     public function test_Validar_controller_oficina_index_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/7678864');
            $response->assertStatus(404);
        }


    //Validar ruta show de la oficina con datos correctos (metodo get)
    public function test_Validar_controller_oficina_show()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/oficina/2');
            $response->assertStatus(200);
        }


    //Validar ruta show de la oficina con datos incorrectos (metodo get)
     public function test_Validar_controller_oficina_show_con_datos_incorrectos()
     {
         $user = User::findOrFail(2);
         Auth::login($user);
         $response = $this->get('/oficina/vt4567uhg');
         $response->assertStatus(404);
     }

    
    //Validar ruta create en la oficina (metodo get)
    public function test_Validar_controller_oficina_create()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/oficina/create');
            $response->assertStatus(200);
        }


    //Validar ruta create de la oficina con datos incorrectos (metodo get)
    public function test_Validar_controller_oficina_create_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/767899754');
            $response->assertStatus(404);
        }


    //Validar ruta store en la oficina 
    public function test_Validar_controller_oficina_store()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/oficina');
            $response->assertStatus(200);
        }


    //Validar ruta store de la oficina con datos incorrectos 
    public function test_Validar_controller_oficina_store_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/76654');
            $response->assertStatus(404);
        }


    // Validacion para Acceder en el de agregar en listado 
    public function test_Validar_boton_nueva_oficina_en_Listado_de_oficina()
        {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/oficina');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('oficina.create'));

        $response->assertSee('Creación nueva oficina'); //Muestra titulo de la ventana de registro .
         // Verifica que se redirige correctamente a la ruta
         $response->assertStatus(200);
        }


    // Validar de la ruta edit de la oficina 
    public function test_Validar_Controller_oficina_edit_ruta()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->get('/oficina/3/edit');
           $response->assertStatus(200);

       }


    // Validar de la ruta edit de la oficina con valores incorrectos
    public function test_Validar_Controller_oficina_edit_ruta_valores_concorrectos()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->get('/oficina/3678/edit');
            $response->assertStatus(404);
        }


    // validar para que se agregue un nuevo registro de oficina
        public function test_Validar_Controller_nueva_oficina_store()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
                'nombreOficina'   => 'Las florecitas',
                'direccion' => 'Barrio abajo',
                'nombreGerente'  => 'Sasha Godoy',
                'telefono'  => '33368113',
                'departamento_id'  => '7',
                'municipio_id'  => '93',
            
            ]);
    
            // Trae el nuevo registro de oficina
            $oficina = Oficina::where('nombreOficina','=','Las florecitas')->get();
    
            // comprueba si me agrego la nueva oficina
            $this->assertTrue(  count($oficina) == 1 );
    
        }



    // Validar el controlador de oficina  para guardar un nuevo registro de oficina con el nombre de la oficina vacio
    public function test_Validar_Controller_oficina_con_nombre_de_la_oficina_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
                'nombreOficina'   => '',
                'direccion' => 'Barrio abajo',
                'nombreGerente'  => 'Sasha Godoy',
                'telefono'  => '33368113',
                'departamento_id'  => '7',
                'municipio_id'  => '93',
             
            ]);
            $response->assertStatus(302);
        }


    // Validar el controlador de oficina  para guardar un nuevo registro de oficina con la direcion de la oficina vacia
    public function test_Validar_Controller_oficina_con_direccion_de_la_oficina_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
                'nombreOficina'   => 'Las florecitas',
                'direccion' => '',
                'nombreGerente'  => 'Sasha Godoy',
                'telefono'  => '33368113',
                'departamento_id'  => '7',
                'municipio_id'  => '93',
             
            ]);
            $response->assertStatus(302);
        }


    // Validar el controlador de oficina  para guardar un nuevo registro de oficina con el nombre del gerente de la oficina vacio
    public function test_Validar_Controller_oficina_con_nombre_gerente_de_la_oficina_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->post('/oficina',[
                    'nombreOficina'   => 'Las florecitas',
                    'direccion' => 'Barrio abajo',
                    'nombreGerente'  => '',
                    'telefono'  => '33368113',
                    'departamento_id'  => '7',
                    'municipio_id'  => '93',
                 
                ]);
                $response->assertStatus(302);
            }

    // Validar del controlador de oficina  para guardar un nuevo registro de oficina con el telefono  de la oficina vacio
    public function test_Validar_Controller_oficina_con_telefono_de_la_oficina_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->post('/oficina',[
                    'nombreOficina'   => 'Las florecitas',
                    'direccion' => 'Barrio abajo',
                    'nombreGerente'  => 'Sasha Goody',
                    'telefono'  => '',
                    'departamento_id'  => '7',
                    'municipio_id'  => '93',
                 
                ]);
                $response->assertStatus(302);
            }

    // Validar el controlador de oficina  para guardar un nuevo registro de oficina con el departamento  de la oficina vacio
    public function test_Validar_Controller_oficina_con_el_departamento_de_la_oficina_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
                'nombreOficina'   => 'Las florecitas',
                'direccion' => 'Barrio abajo',
                'nombreGerente'  => 'Sasha Goody',
                'telefono'  => '33368113',
                'departamento_id'  => '',
                'municipio_id'  => '93',
             
            ]);
            $response->assertStatus(302);
        }


    // Validar el controlador de oficina  para guardar un nuevo registro de oficina con el municipio de la oficina vacio
    public function test_Validar_Controller_oficina_con_el_municipio_de_la_oficina_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
                'nombreOficina'   => 'Las florecitas',
                'direccion' => 'Barrio abajo',
                'nombreGerente'  => 'Sasha Goody',
                'telefono'  => '33368113',
                'departamento_id'  => '7',
                'municipio_id'  => '',
             
            ]);
            $response->assertStatus(302);
        }


    // Validacion el controlador oficina para guardar un nuevo regitro de oficina, el nombre de oficina que no acepta doble espacio entre palabras
       public function test_Validar_Controlador_oficina_con_el_nombre_oficina_no_acepta_doble_espacio_entre_palabra()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las  florecitas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Goody',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
           ]);
           
           $response->assertStatus(302);

       }

    
    // Validar el controlador oficina  para  guardar un nuevo regitro de oficina,incorrecto, solo debe de aceptar letras
    public function test_Validar_Controller_oficina_con_el_nombre_oficina_con_numeros_solo_acepta_letras()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => '33',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Goody',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
            
           ]);
           
           $response->assertStatus(302);
       }


    // Validar el controlador oficina  para  guardar un nuevo regitro de oficina,incorrecto con caracteres especiales, solo debe de aceptar letras
    public function test_Validar_Controller_oficina_con_el_nombre_oficina_con_caracteres_especiales_solo_acepta_letras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
             'nombreOficina'   => 'Las florecitas@',
             'direccion' => 'Barrio abajo',
             'nombreGerente'  => 'Sasha Goody',
             'telefono'  => '33368113',
             'departamento_id'  => '7',
             'municipio_id'  => '93',
             
            ]);
            
            $response->assertStatus(302);
        }

    // Validar el controlador oficina , en la descripción ingresare menos de 10 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
    public function test_Validar_Controller_oficina_con_la_descripcion_menor_a_diez()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Ba',
            'nombreGerente'  => 'Sasha Goody',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
         
        ]);
        
        $response->assertStatus(302);
    }


    // Validar el controlador oficina , en la descripción ingresare mas de 150 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
    public function test_Validar_Controller_oficina_con_la_descripcion_mayor_a_ciento_cincuenta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Barrio abajoooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo
             ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo',
            'nombreGerente'  => 'Sasha Goody',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
         
        ]);
        
        $response->assertStatus(302);
    }


    // Validacion el controlador oficina para guardar un nuevo regitro de oficina, el nombre de gerente  que no acepta doble espacio entre palabras
    public function test_Validar_Controlador_oficina_con_el_nombre_gerente_no_acepta_doble_espacio_entre_palabra()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/oficina',[
         'nombreOficina'   => 'Las florecitas',
         'direccion' => 'Barrio abajo',
         'nombreGerente'  => 'Sasha  Goody',
         'telefono'  => '33368113',
         'departamento_id'  => '7',
         'municipio_id'  => '93',
        ]);
        
        $response->assertStatus(302);

    }


    // Validar el controlador oficina  para  guardar un nuevo regitro de oficina,incorrecto en el nombre del gerente, solo debe de aceptar letras
    public function test_Validar_Controller_oficina_con_el_nombre_gerente_con_numeros_solo_acepta_letras()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => '444',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
            
           ]);
           
           $response->assertStatus(302);
       }

    // Validar el controlador oficina  para  guardar un nuevo regitro de oficina,incorrecto en el nombre del gerente con caracteres especiales, solo debe de aceptar letras
    public function test_Validar_Controller_oficina_con_el_nombre_gerente_con_caracteres_especiales_solo_acepta_letras()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Godoy@',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
            
           ]);
           
           $response->assertStatus(302);
       }


    // Validar el controlador oficina para guardar un nuevo registo de oficina, y que el nombre del gerente  que inice con mayuscula
    public function test_Validar_Controller_oficina_con_el_nombre_del_gerente_que_inicie_con_mayuscula()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
                'nombreOficina'   => 'Las  florecitas',
                'direccion' => 'Barrio abajo',
                'nombreGerente'  => 'sasha Goody',
                'telefono'  => '33368113',
                'departamento_id'  => '7',
                'municipio_id'  => '93',
            
            ]);
            
            $response->assertStatus(302);
        }



    // Validar el controlador oficina para guardar un nuevo regitro de oficina, el teléfono que solo acepta numeros
    public function test_Validar_Controller_oficina_el_telefono_solo_acepta_numeros()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Godoy',
            'telefono'  => 'hjuyidfg',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
           ]);
           
           $response->assertStatus(302);

       }

    // Validar el controlador oficina para guardar un nuevo registro de oficina con el teléfono, que no acepta mas de 8 numeros
       public function test_Validar_Controlador_oficina_con_el_telefono_solo_acepta_8_numeros()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Godoy',
            'telefono'  => '33368113333',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
           ]);
           
           $response->assertStatus(302);

       }




        // Validar el controlador oficina para guardar un nuevo registro de oficina con el teléfono, que no acepta menos de 8 numeros
        public function test_Validar_Controlador_oficina_con_el_telefono_que_no_acepta__menos_de_8_numeros()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/oficina',[
             'nombreOficina'   => 'Las florecitas',
             'direccion' => 'Barrio abajo',
             'nombreGerente'  => 'Sasha Godoy',
             'telefono'  => '33',
             'departamento_id'  => '7',
             'municipio_id'  => '93',
            ]);
            
            $response->assertStatus(302);
 
        }

    // Validar el controlador oficina para guardar un nuevo registro de oficina el telefono debe inciar con 2, 3, 8 o 9
       public function test_Validar_Controlller_ofocina_con_el_telefono_debe_iniciar_con_2_3_8_9()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/oficina',[
            'nombreOficina'   => 'Las florecitas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Godoy',
            'telefono'  => '67563412',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
           ]);
           
           $response->assertStatus(302);

       }


   // Validar de la ruta del controlador oficina para ver la oficina selecionada
       public function test_Validar_Controller_oficina_show_ruta()
        {
          $user = User::findOrFail(1);
          Auth::login($user);
   
         $response = $this->get('/oficina/1');
         $response->assertStatus(200);
         }



     // Validar el controlador oficina para ver la oficina selecionada, invalida
         public function test_Validar_Controller_oficina_show_ruta_invalida_que_no_existe()
         {
           $user = User::findOrFail(1);
           Auth::login($user);
            
           $response = $this->get('/oficina/892092828');
           $response->assertStatus(404);
        }



         
        //Validacion de oficina para actualizar el nombre de la oficicna de las florecitas a las florecitas lindas
        public function test_Validar_Controller_oficina_update_nombre_oficina()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/oficina/42/edit',[
            'nombreOficina'   => 'Las florecitas lindas',
            'direccion' => 'Barrio abajo',
            'nombreGerente'  => 'Sasha Godoy',
            'telefono'  => '33368113',
            'departamento_id'  => '7',
            'municipio_id'  => '93',
        ]);

        // Traerme la oficina que esta registrado
        $oficina = Oficina::findOrFail(42);

        //comparueba el resultado de la consulta con el valor editado
        $this->assertTrue($oficina->nombreOficina == 'Las florecitas lindas');

    }



    //Validacion de oficina para actualizar direccion, de barrio abajo, a barrio le cramelo
    public function test_Validar_Controller_oficina_update_direccion()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->put('/oficina/42/edit',[
                 'nombreOficina'   => 'Las florecitas lindas',
                 'direccion' => 'Barrio el cramelo',
                 'nombreGerente'  => 'Sasha Godoy',
                 'telefono'  => '33368113',
                 'departamento_id'  => '7',
                 'municipio_id'  => '93',
             ]);
     
             // Traerme la oficina que esta registrado
             $oficina = Oficina::findOrFail(42);
     
            
             //comparueba el resultado de la consulta con el valor editado
             $this->assertTrue($oficina->direccion == 'Barrio el cramelo');
     
         }

        //Validacion de oficina para actualizar el nombre del gerente, de Sasha Godoy a Juanito
        public function test_Validar_Controller_oficina_update_nombre_gerente()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => 'Barrio el cramelo',
                'nombreGerente'  => 'Juanito',
                'telefono'  => '33368113',
                'departamento_id'  => '7',
                'municipio_id'  => '93',
            ]);
    
            // Traerme la oficina que esta registrado
            $oficina = Oficina::findOrFail(42);
    
            
            //comparueba el resultado de la consulta con el valor editado
            $this->assertTrue($oficina->nombreGerente == 'Juanito');
    
        }



    //Validacion de oficina para actualizar el numero de telefono ,33368113 a 36753234
    public function test_Validar_Controller_oficina_update_telefono()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/oficina/42/edit',[
                    'nombreOficina'   => 'Las florecitas lindas',
                    'direccion' => 'Barrio el cramelo',
                    'nombreGerente'  => 'Juanito',
                    'telefono'  => '36753234',
                    'departamento_id'  => '7',
                    'municipio_id'  => '93',
                ]);
        
                // Traerme la oficina que esta registrado
                $oficina = Oficina::findOrFail(42);
        
                
                //comparueba el resultado de la consulta con el valor editado
                $this->assertTrue($oficina->telefono == '36753234');
        
            }


        //Validacion de oficina para actualizar el departamento ,7 
        public function test_Validar_Controller_oficina_update_departamento()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => 'Barrio el cramelo',
                'nombreGerente'  => 'Juanito',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '93',
            ]);
    
            // Traerme la oficina que esta registrado
            $oficina = Oficina::findOrFail(42);
    
            
            //comparueba el resultado de la consulta con el valor editado
            $this->assertTrue($oficina->departamento_id == '7');
    
        }


    //Validacion de oficina para actualizar el municipio ,93 a 109
    public function test_Validar_Controller_oficina_update_municipio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->put('/oficina/42/edit',[
        'nombreOficina'   => 'Las florecitas lindas',
        'direccion' => 'Barrio el cramelo',
        'nombreGerente'  => 'Juanito',
        'telefono'  => '36753234',
        'departamento_id'  => '7',
        'municipio_id'  => '109',
    ]);

    // Traerme la oficina que esta registrado
    $oficina = Oficina::findOrFail(42);

    
    //comparueba el resultado de la consulta con el valor editado
    $this->assertTrue($oficina->municipio_id == '109');

}

    // Validacion del controlador oficina para actualizar con el nombre oficina vacio
    public function test_Validar_Controller_oficina_update_con_nombre_oficina_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/oficina/42/edit',[
                    'nombreOficina'   => '',
                    'direccion' => 'Barrio el cramelo',
                    'nombreGerente'  => 'Juanito',
                    'telefono'  => '36753234',
                    'departamento_id'  => '7',
                    'municipio_id'  => '109',
                ]);
                
                $response->assertStatus(302);

            }
    // Validacion del controlador oficina para actualizar con el nombre oficina, con numeros , datos incorrectos
    public function test_Validar_Controller_oficina_update_con_nombre_oficina_con_numeros()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/oficina/42/edit',[
                    'nombreOficina'   => '123242',
                    'direccion' => 'Barrio el cramelo',
                    'nombreGerente'  => 'Juanito',
                    'telefono'  => '36753234',
                    'departamento_id'  => '7',
                    'municipio_id'  => '109',
                ]);
                
                $response->assertStatus(302);

            }

    // Validacion del controlador oficina para actualizar con el nombre oficina con doble espacio entre palabra, datos incorrectos
    public function test_Validar_Controller_oficina_update_con_nombre_oficina_con_doble_espacio_entre_palabra()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las  florecitas lindas',
                'direccion' => 'Barrio el cramelo',
                'nombreGerente'  => 'Juanito',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }
    
    // Validacion del controlador oficina para actualizar con el nombre oficina con carateres especiales, datos incorrectos
    public function test_Validar_Controller_oficina_update_con_nombre_oficina_con_carcateres_especiales()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/oficina/42/edit',[
            'nombreOficina'   => 'Las  florecitas lindas@',
            'direccion' => 'Barrio el cramelo',
            'nombreGerente'  => 'Juanito',
            'telefono'  => '36753234',
            'departamento_id'  => '7',
            'municipio_id'  => '109',
        ]);
        
        $response->assertStatus(302);
    }


    // Validacion del controlador oficina para actualizar la direccion de oficina dejandola vacia, datos incorrectos
    public function test_Validar_Controller_oficina_update_descripcion_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => '',
                'nombreGerente'  => 'Juanito',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }



    // Validacion del controlador oficina para actualizar la direccion con solo dos letras, debe de tener mas de 10, datos incorrectos 
    public function test_Validar_Controller_oficina_update_descripcion_menos_de_diez_letras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => 'Bar',
                'nombreGerente'  => 'Juanito',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }


     // Validacion del controlador oficina para actualizar la direccion con mas de 150 letras, deben de estar entre 10 y 150 caracteres, datos incorrectos
     public function test_Validar_Controller_oficina_update_descripcion_mayor_a_ciento_cincuenta()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => 'Barrio el cramelovvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
                vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
                vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv',
                'nombreGerente'  => 'Juanito',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }



     // Validacion del controlador oficina para actualizar nombre del gerente vacio
     public function test_Validar_Controller_oficina_update_nombre_gerente_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => 'Barrio el cramelo',
                'nombreGerente'  => '',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }


        // Validacion del controlador oficina para actualizar con el nombre gerente , que no acepte  doble espacio entre palabra
        public function test_Validar_Controller_oficina_update_con_nombre_gerente_con_doble_espacio_entre_palabra()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las  florecitas lindas',
                'direccion' => 'Barrio el cramelo',
                'nombreGerente'  => 'Juanito  ',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }


    // Validacion del controlador oficina para actualizar nombre del gerente con la primera letra miniscula, debe de ser mayuscula
    public function test_Validar_Controller_oficina_update_nombre_gerente_mayuscula()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->put('/oficina/42/edit',[
                 'nombreOficina'   => 'Las florecitas lindas',
                 'direccion' => 'Barrio el cramelo',
                 'nombreGerente'  => 'juanito',
                 'telefono'  => '36753234',
                 'departamento_id'  => '7',
                 'municipio_id'  => '109',
             ]);
             
             $response->assertStatus(302);
         }

     

    // Validacion del controlador oficina para actualizar nombre del gerente con numeros, debe aceptar solo letras
    public function test_Validar_Controller_oficina_update_nombre_gerente_con_numeros()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->put('/oficina/42/edit',[
             'nombreOficina'   => 'Las florecitas lindas',
             'direccion' => 'Barrio el cramelo',
             'nombreGerente'  => '76864',
             'telefono'  => '36753234',
             'departamento_id'  => '7',
             'municipio_id'  => '109',
         ]);
         
         $response->assertStatus(302);
     }


    // Validacion del controlador oficina para actualizar nombre del gerente con carateres especiales, debe aceptar solo letras
    public function test_Validar_Controller_oficina_update_nombre_gerente_con_caracteres_especiales()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
                'nombreOficina'   => 'Las florecitas lindas',
                'direccion' => 'Barrio el cramelo',
                'nombreGerente'  => 'Juanito@',
                'telefono'  => '36753234',
                'departamento_id'  => '7',
                'municipio_id'  => '109',
            ]);
            
            $response->assertStatus(302);
        }




    // Validacion del controlador oficina actualizar, con datos vacios
    public function test_Validar_Controller_oficina_update_para_que_telefono_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
             'nombreOficina'   => 'Las florecitas lindas',
             'direccion' => 'Barrio abajo',
             'nombreGerente'  => 'Sasha Godoy',
             'telefono'  => '',
             'departamento_id'  => '7',
             'municipio_id'  => '93',
            ]);
    
            $oficina = Oficina::findOrFail(42);
    
            $this->assertFalse($oficina->telefono== '33368113');
        }


        // Validacion del controlador oficina actualizar, para ver que telefono no acepte letras
        public function test_Validar_Controller_oficina_update_para_que_telefono_letras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
             'nombreOficina'   => 'Las florecitas lindas',
             'direccion' => 'Barrio abajo',
             'nombreGerente'  => 'Sasha Godoy',
             'telefono'  => 'hyyrf',
             'departamento_id'  => '7',
             'municipio_id'  => '93',
            ]);
    
            $oficina = Oficina::findOrFail(42);
    
            $this->assertFalse($oficina->telefono== '33368113');
        }

    // Validacion del controlador oficina actualizar, para ver que telefono no acepte carcateres especiales
    public function test_Validar_Controller_oficina_update_para_que_telefono_caracteres_especiales()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/oficina/42/edit',[
                 'nombreOficina'   => 'Las florecitas lindas',
                 'direccion' => 'Barrio abajo',
                 'nombreGerente'  => 'Sasha Godoy',
                 'telefono'  => '333681@',
                 'departamento_id'  => '7',
                 'municipio_id'  => '93',
                ]);
        
                $oficina = Oficina::findOrFail(42);
        
                $this->assertFalse($oficina->telefono== '33368113');
            }
        
    // Validacion del controlador oficina actualizar, para ver que telefono empiece con con 2, 3, 8 o 9
    public function test_Validar_Controller_oficina_update_para_que_telefono_debe_inicar_con_2_3_8_9()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/oficina/42/edit',[
                 'nombreOficina'   => 'Las florecitas lindas',
                 'direccion' => 'Barrio abajo',
                 'nombreGerente'  => 'Sasha Godoy',
                 'telefono'  => '45678943',
                 'departamento_id'  => '7',
                 'municipio_id'  => '93',
                ]);
        
                $oficina = Oficina::findOrFail(42);
        
                $this->assertFalse($oficina->telefono== '33368113');
            }


    // Validacion del controlador oficina actualizar, para ver que telefono tenga menos 8 carcateres
        public function test_Validar_Controller_oficina_update_para_que_telefono_menos_de_8_caracteres()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/oficina/42/edit',[
             'nombreOficina'   => 'Las florecitas lindas',
             'direccion' => 'Barrio abajo',
             'nombreGerente'  => 'Sasha Godoy',
             'telefono'  => '333681',
             'departamento_id'  => '7',
             'municipio_id'  => '93',
            ]);
    
            $oficina = Oficina::findOrFail(42);
    
            $this->assertFalse($oficina->telefono== '33368113');
        }



    // Validacion del controlador oficina actualizar, para ver que telefono debe de ser unico
    public function test_Validar_Controller_oficina_update_para_que_telefono_sea_unico()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/oficina/42/edit',[
         'nombreOficina'   => 'Las florecitas lindas',
         'direccion' => 'Barrio abajo',
         'nombreGerente'  => 'Sasha Godoy',
         'telefono'  => '33368113',
         'departamento_id'  => '7',
         'municipio_id'  => '93',
        ]);

        $oficina = Oficina::findOrFail(42);

        $this->assertFalse($oficina->telefono== '33368113');
    }


}