<?php

namespace Tests\Feature;

use App\Models\Casa;
use App\Models\User;
use App\Models\Puesto;
use App\Models\Oficina;
use App\Models\Empleado;
use App\Models\Liberado;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;





/*********************************************************************   PUESTO LABORAL  ***************************************************************/

class ExampleTest extends TestCase
{

    //Acceder a as rutas con usuario valido
    public function test_Validar_ruta_home()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    //Validar ruta index del puesto (metodo get)
    public function test_Validar_controller_puesto_index()
    {

        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/puesto');
        $response->assertStatus(200);
    }
    
    
    // Validar ruta del puesto index con datos incorrectos (metodo get)
    public function test_Validar_controller_puesto_index_Con_Valores_incorrectos()
    {
        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/77676A');
        $response->assertStatus(404);
    }

    //Validar ruta create del puesto  (metodo get) 
    public function test_Validar_controller_puesto_create()
    {
        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/puesto/create');
        $response->assertStatus(200);
    }

    // Validar ruta del puesto  create con datos incorrectos (metodo get)(YAA)
    public function test_Validar_controller_puesto_create_Con_Valores_incorrectos()
    {
        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/77676A');
        $response->assertStatus(404);
    }



    // Validacion para Acceder en el de agregar en listado 
   public function test_Validar_boton_nuevo_puesto_en_Listado_puesto_laboral()
   {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/puesto');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('puestoLaboral.create'));

        $response->assertSee('Registro de un nuevo puesto laboral'); //Muestra titulo de la ventana de registro .
         // Verifica que se redirige correctamente a la ruta
         $response->assertStatus(200);
    }

    
    // validar para que se agregue un nuevo puesto laboral
    public function test_Validar_Controller_nuevo_puesto_store()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
                'nombreCargo'   => 'Laura',
                'sueldo' => '5000',
                'descripcion'  => 'Barrio las flores',
              
            ]);
    
            // Trae el nuevo puesto laboral que registre
            $puesto = Puesto::where('nombreCargo','=','Laura')->get();
    
            // comprueba si me agrego el nuevo puesto laboral  con la funcion count
            $this->assertTrue(  count($puesto) == 1 );
    
        }

    //validar para verificar si se me agrega el mismo puesto laboral que ya agregue
    public function test_Validar_Controller_nuevo_puesto_existente_store()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
                'nombreCargo'   => 'Laura',
                'sueldo' => '5000',
                'descripcion'  => 'Barrio las flores',
               
            ]);
            $response->assertStatus(302);
        }



    // Validar el controlador del puesto  para guardar un nuevo puesto laboral con el nombre del cargo vacio
    public function test_Validar_Controller_puesto_con_nombre_del_cargo_vacio()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/puesto',[
            'nombreCargo'   => '',
            'sueldo' => '5000',
            'descripcion'  => 'Barrio las flores',
            
           ]);
           $response->assertStatus(302);
       }

    // Validacion del controlador del puesto  para guardar un nuevo puesto laboral con el sueldo vacio
    public function test_Validar_Controller_puesto_con_sueldo_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
             'nombreCargo'   => 'Laura',
             'sueldo' => '',
             'descripcion'  => 'Barrio las flores',
             
            ]);
            $response->assertStatus(302);
        }

    // Validar el controlador del puesto  para guardar un nuevo puesto laboral con la descripción vacio
    public function test_Validar_Controller_puesto_con_descripcion_vacio()
                {
                    $user = User::findOrFail(1);
                    Auth::login($user);
            
                    $response = $this->post('/puesto',[
                     'nombreCargo'   => 'Laura',
                     'sueldo' => '5000',
                     'descripcion'  => '',
                     
                    ]);
                    $response->assertStatus(302);
                }



    // Validar el controlador del puesto  para guardar un nuevo puesto laboral con la categoría vacio
    public function test_Validar_Controller_puesto_con_la_categoria_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
             'nombreCargo'   => 'Laura',
             'sueldo' => '5000',
             'descripcion'  => 'Barrio las flores',
             
            ]);
            $response->assertStatus(302);
        }

           
    // Validar para verificar si se me agrega el mismo nombre del cargo, que ya esta agregado.
    public function test_Validar_Controller_puesto_con_un_nombre_del_cargo_existente()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/puesto',[
            'nombreCargo'   => 'Laura',
            'sueldo' => '5000',
            'descripcion'  => 'Barrio las flores',
            
           ]);
           
           $response->assertStatus(302);
       }


    // Validar del controlador puesto  para guardar un nuevo puesto con el nombre del cargo incorrecto, solo debe de aceptar letras
    public function test_Validar_Controller_puesto_con_el_nombre_del_cargo_con_numeros_solo_acepta_letras()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/puesto',[
            'nombreCargo'   => '33368113',
            'sueldo' => '5000',
            'descripcion'  => 'Barrio las flores',
            
           ]);
           
           $response->assertStatus(302);
       }

    // Validar el controlador puesto para guardar un nuevo puesto con
    // doble espacio en el nombre del cargo
    public function test_Validar_Controller_puesto_con_doble_espacio_en_el_nombre_del_cargo()
              {
                  $user = User::findOrFail(1);
                  Auth::login($user);
          
                  $response = $this->post('/puesto',[
                   'nombreCargo'   => 'Laura  Daniela',
                   'sueldo' => '5000',
                   'descripcion'  => 'Barrio las flores',
                   
                  ]);
                  
                  $response->assertStatus(302);
              }

    // Validar del controlador puesto  para guardar un nuevo puesto con el nombre del cargo incorrecto( con caracteres especiales), solo debe de aceptar letras 
     public function test_Validar_Controller_puesto_con_el_nombre_del_cargo_con_caracteres_especiales_solo_acepta_letras()
              {
                  $user = User::findOrFail(1);
                  Auth::login($user);
          
                  $response = $this->post('/puesto',[
                   'nombreCargo'   => 'Daniela@',
                   'sueldo' => '5000',
                   'descripcion'  => 'Barrio las flores',
                   
                  ]);
                  
                  $response->assertStatus(302);
              }

    // Validar el controlador puesto  para guardar un nuevo puesto con el nombre del cargo para que inice con mayuscula
    public function test_Validar_Controller_puesto_con_el_nombre_del_cargo_que_inicie_con_mayuscula()
                 {
                     $user = User::findOrFail(1);
                     Auth::login($user);
             
                     $response = $this->post('/puesto',[
                      'nombreCargo'   => 'Laura',
                      'sueldo' => '5000',
                      'descripcion'  => 'Barrio las flores',
                     
                     ]);
                     
                     $response->assertStatus(302);
                 }


    // Validar el controlador puesto , en el sueldo ingresare letras
    public function test_Validar_Controller_puesto_con_el_sueldo_letras_solo_acepta_numeros()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->post('/puesto',[
                 'nombreCargo'   => 'Laura',
                 'sueldo' => 'lllll',
                 'descripcion'  => 'Barrio las flores',
                 
                ]);
                
                $response->assertStatus(302);
            }

    // Validar el controlador puesto, en el sueldo ingresare un suledo menor a 4500, para que se cumpla 
    // tiene que estar 4500.00, 20000.00 
    public function test_Validar_Controller_puesto_con_el_sueldo_menor_a_cuatro_mil_quinientos_()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
             'nombreCargo'   => 'Laura',
             'sueldo' => '3500',
             'descripcion'  => 'Barrio las flores',
             
            ]);
            
            $response->assertStatus(302);
        }

    // Validar el controlador puesto , en el sueldo ingresare un suledo mayor a 20000, para que se cumpla 
    // tiene que estar 4500.00, 20000.00 
    public function test_Validar_Controller_puesto_con_el_sueldo_mayor_a_veite_mil()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
             'nombreCargo'   => 'Laura',
             'sueldo' => '25000',
             'descripcion'  => 'Barrio las flores',
             
            ]);
            
            $response->assertStatus(302);
        }

    // Validar el controlador puesto , en la descripción ingresare menos de 10 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
        public function test_Validar_Controller_puesto_con_la_descripcion_menor_a_diez()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
             'nombreCargo'   => 'Laura',
             'sueldo' => '25000',
             'descripcion'  => 'Ba',
             
            ]);
            
            $response->assertStatus(302);
        }


    // Validar el controlador puesto , en la descripción ingresare mas de 150 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
        public function test_Validar_Controller_puesto_con_la_descripcion_mayor_a_ciento_cincuenta()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/puesto',[
             'nombreCargo'   => 'Laura',
             'sueldo' => '25000',
             'descripcion'  => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
             aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
             aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
             
            ]);
            
            $response->assertStatus(302);
        }


    public function test_Validar_Controller_puesto_show_ruta_incorrecta_no_existe()
               {
                   $user = User::findOrFail(1);
                   Auth::login($user);
           
                   $response = $this->get('/puesto/54223');
                   $response->assertStatus(404);
               }

    // Validar de la ruta edit del puesto  
    public function test_Validar_Controller_pruesto_edit_ruta()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->get('/puesto/3/edit');
           $response->assertStatus(200);
       }


    // Validar de la ruta edit del puesto invalida 
    public function test_Validar_Controller_puesto_edit_ruta_incorrecta()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->get('/puesto/1555/edit');
               $response->assertStatus(404);
           }


    // Validar el controlador  para actualizar el nombre del cargo de
    // Laura a Manager of Food Preparation
        public function test_Validar_Controller_puesto_update_nombre_del_cargo()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/puesto/3/edit',[
               
                    'nombreCargo'   => 'Manager of Food Preparation',
                    'sueldo' => '5000',
                    'descripcion'  => 'Barrio las flores',
                    
            ]);

            $puesto1 = Puesto::findOrFail(3);

            $this->assertTrue($puesto1->nombreCargo == 'Manager of Food Preparation');

        }

    // Validar el controlador puesto para actualizar el sueldo  
    public function test_Validar_Controller_puesto_update_sueldo()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/puesto/3/edit',[
           
                'nombreCargo'   => 'Manager of Food Preparation',
                'sueldo' => '5000',
                'descripcion'  => 'Barrio las flores',
                
        ]);

        $puesto1 = Puesto::findOrFail(3);

        $this->assertTrue($puesto1->sueldo == '5000');

    }


    // Validar el controlador puesto para actualizar la descripcion 
    public function test_Validar_Controller_puesto_update_descripcion()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/puesto/3/edit',[
           
                'nombreCargo'   => 'Manager of Food Preparation',
                'sueldo' => '5000',
                'descripcion'  => 'Barrio las flores',
                
        ]);

        $puesto1 = Puesto::findOrFail(3);

        $this->assertTrue($puesto1->descripcion == 'Barrio las flores');

    }

    // Validar el controlador puesto para actualizar con el nombre del cargo vacio
            public function test_Validar_Controller_pruesto_update_con_nombre_del_cargo_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/puesto/3/edit',[
                    'nombreCargo'   => '',
                    'sueldo' => '5000',
                    'descripcion'  => 'Barrio las flores',
                ]);
                
                $response->assertStatus(302);

            }

     // Validar el controlador puesto para actualizar con el sueldo vacio
     public function test_Validar_Controller_pruesto_update_con_el_sueldo_vacio()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->put('/puesto/3/edit',[
             'nombreCargo'   => 'Manager of Food Preparation',
             'sueldo' => '',
             'descripcion'  => 'Barrio las flores',
         ]);
         
         $response->assertStatus(302);

     }

     // Validar el controlador puesto para actualizar con la descripcion vacio
     public function test_Validar_Controller_pruesto_update_con_la_descripcion_vacia()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->put('/puesto/3/edit',[
             'nombreCargo'   => 'Manager of Food Preparation',
             'sueldo' => '5000',
             'descripcion'  => '',
         ]);
         
         $response->assertStatus(302);

     }

     // Validar el controlador puesto para actualizar el nombre del cargo para que no acepte  doble espacio
     public function test_Validar_Controller_puesto_update_no_acepta_doble_espacio_en_el_nombre_del_cargo()
     {
         $user = User::findOrFail(1);
         Auth::login($user);

         $response = $this->put('/puesto/3/edit',[
            'nombreCargo'   => 'Manager   of Food Preparation',
            'sueldo' => '5000',
            'descripcion'  => 'Barrio las flores',
        ]);
         $response->assertStatus(302);
     }


    // Validar el controlador puesto para actualizar el nombre del cargo para que no acepte numeros, solo debe de aceptar letras
    public function test_Validar_Controller_puesto_update_no_acepta_numeros_en_el_nombre_del_cargo()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
    
             $response = $this->put('/puesto/3/edit',[
                'nombreCargo'   => 'Manager  of Food Preparation5',
                'sueldo' => '5000',
                'descripcion'  => 'Barrio las flores',
            ]);
             $response->assertStatus(302);
         }


    // Validar el controlador puesto para actualizar el nombre del cargo con caracteres especiales, solo debe de aceptar letras
    public function test_Validar_Controller_puesto_update_no_acepta_caracteres_especiales_en_el_nombre_del_cargo()
                  {
                      $user = User::findOrFail(1);
                      Auth::login($user);
             
                      $response = $this->put('/puesto/3/edit',[
                         'nombreCargo'   => 'Manager  of Food Preparation@',
                         'sueldo' => '5000',
                         'descripcion'  => 'Barrio las flores',
                     ]);
                      $response->assertStatus(302);
                  }

    // Validar el controlador puesto para actualizar el sueldo que no  sea menor a 4500 , para que sea valido debe de estar entre 4500 y 20000
    public function test_Validar_Controller_puesto_update_con_el_sueldo_menor_a_cuatro_mil_quinientos_()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
   
            $response = $this->put('/puesto/3/edit',[
               'nombreCargo'   => 'Manager   of Food Preparation@',
               'sueldo' => '3000',
               'descripcion'  => 'Barrio las flores',
           ]);
            $response->assertStatus(302);
        }

    // Validar el controlador puesto para actualizar el sueldo que no  sea mayor a veite mil , para que sea valido debe de estar entre 4500 y 20000
    public function test_Validar_Controller_puesto_update_con_el_sueldo_mayor_a_veite_mil()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
   
            $response = $this->put('/puesto/3/edit',[
               'nombreCargo'   => 'Manager   of Food Preparation@',
               'sueldo' => '30000',
               'descripcion'  => 'Barrio las flores',
           ]);
            $response->assertStatus(302);
        }


        // Validar el controlador puesto para actualizar la direcion , para que sea valido debe de estar entre 10 y 150 caracteres
        public function test_Validar_Controller_puesto_update_con_la_descripcion_menor_a_diez()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
   
            $response = $this->put('/puesto/3/edit',[
               'nombreCargo'   => 'Manager   of Food Preparation@',
               'sueldo' => '30000',
               'descripcion'  => 'Barrio',
           ]);
            $response->assertStatus(302);
        }




    

    }

