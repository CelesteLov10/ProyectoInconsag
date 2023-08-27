<?php

namespace Tests\Feature;

use App\Models\Casa;
use App\Models\User;
use App\Models\Puesto;
use App\Models\Oficina;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class LoteLiberadoTest extends TestCase
{ 

/*********************************************************************   CASA MODELO  ***************************************************************/

    //Validar ruta index casa (metodo get)
    public function test_Validar_controller_casa_index()
    {
        $user = User::findOrFail(2);
        Auth::login($user);
        $response = $this->get('/casa');
        $response->assertStatus(200);
    }


    // Validar ruta de la casa index con datos incorrectos (metodo get)
    public function test_Validar_controller_casa_index_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/7688864');
            $response->assertStatus(404);
        }


    //Validar ruta show de casa con datos correctos (metodo get)
        public function test_Validar_controller_casa_show()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/casa/1');
            $response->assertStatus(200);
        }

    //Validar ruta show casa con datos incorrectos (metodo get)
    public function test_Validar_controller_casa_show_con_datos_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/casa/v67uhg');
            $response->assertStatus(404);
        }

    //Validar ruta create en casa (metodo get)
    public function test_Validar_controller_casa_create()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/casa/create');
            $response->assertStatus(200);
        }



     //Validar ruta create casa con datos incorrectos (metodo get)
     public function test_Validar_controller_casa_create_Con_Valores_incorrectos()
     {
         $user = User::findOrFail(2);
         Auth::login($user);
         $response = $this->get('/789699754');
         $response->assertStatus(404);
     }



    //Validar ruta store en casa 
    public function test_Validar_controller_casa_store()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/casa');
            $response->assertStatus(200);
        }
    
    //Validar ruta store casa con datos incorrectos
    public function test_Validar_controller_casa_store_Con_Valores_incorrectos()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/99954');
            $response->assertStatus(404);
        }
    

  // Validar de la ruta edit de casa 
    public function test_Validar_Controller_casa_edit_ruta()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->get('/casa/2/edit');
           $response->assertStatus(200);

       }


    // Validar de la ruta edit casa con valores incorrectos
    public function test_Validar_Controller_casa_edit_ruta_valores_concorrectos()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->get('/casa/39778/edit');
            $response->assertStatus(404);
        }


   // Validacion para poder acceder desde el listado en nueva casa 
   public function test_Validar_boton_nueva_casa_en_el_Listado_de_casas_modelos()
   {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/casa');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('casa.create'));

        $response->assertSee('Registro de nueva casa modelo'); 
         $response->assertStatus(200);
    }


    //Acceder a la ruta de Listado  de casas modelos 
    public function test_Validar_listado_casa_modelo()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta Listado de casas modelos
        $response = $this->actingAs($user)->get('/casa');
        $response->assertStatus(200);
        $response->assertSee('Listado de casas modelos');  // Titulo  Listado de casas modelos
        $response->assertSee('Nueva casa'); //campo
        $response->assertSee('Clase de casa'); //campo
        $response->assertSee('Cantidad de habitaciones'); //campo
        $response->assertSee('Nombre de la constructora'); //campo
        $response->assertSee('Detalle');
        $response->assertSee('Actualizar');
    }



// validar para que se agregue un nuevo registro de casa
    public function test_Validar_Controller_nueva_casa_store()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/casa',[
            'claseCasa'   => 'Clase baja',
            'valorCasa' => '105000',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Que sea de tres plantas',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            
        
        ]);

        // Trae el nuevo registro casa
        $casa = Casa::where('claseCasa','=','Clase baja')->get();

        // comprueba si me agrego la nueva casa con la funcion count
        $this->assertTrue(  count($casa) == 1 );

    }


    // Validar del controlador de casa  para guardar un nuevo registro de casa modelo, dejando vacia la clase de la casa
    public function test_Validar_Controller_casa_con_clase_de_la_casa_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/casa',[
                'claseCasa'   => '',
                'valorCasa' => '105000',
                'cantHabitacion'  => '3',
                'descripcion'  => 'Que sea de tres plantas',
                'nombreConstructora' => '1',
                'constructora_id'  => '1',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            $response->assertStatus(302);
        }


     // Validar el controlador de casa  para guardar un nuevo registro de casa modelo, dejando vacio el valor de la casa
     public function test_Validar_Controller_casa_con_valor_casa_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/casa',[
                'claseCasa'   => 'Clase baja',
                'valorCasa' => '',
                'cantHabitacion'  => '3',
                'descripcion'  => 'Que sea de tres plantas',
                'nombreConstructora' => '1',
                'constructora_id'  => '1',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            $response->assertStatus(302);
        }

     // Validar el controlador de casa  para guardar un nuevo registro de casa modelo, dejando vacio cantidad de habitaciones de la casa
     public function test_Validar_Controller_casa_cantidad_de_habitaciones_vacia()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->post('/casa',[
                 'claseCasa'   => 'Clase baja',
                 'valorCasa' => '105000',
                 'cantHabitacion'  => '',
                 'descripcion'  => 'Que sea de tres plantas',
                 'nombreConstructora' => '1',
                 'constructora_id'  => '1',
                 'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
             ]);
             $response->assertStatus(302);
         }


     // Validar el controlador de casa  para guardar un nuevo registro de casa modelo, dejando vacio descripcion de la casa
     public function test_Validar_Controller_casa_descripcion_vacia()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->post('/casa',[
                 'claseCasa'   => 'Clase baja',
                 'valorCasa' => '105000',
                 'cantHabitacion'  => '3',
                 'descripcion'  => '',
                 'nombreConstructora' => '1',
                 'constructora_id'  => '1',
                 'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
             ]);
             $response->assertStatus(302);
         }



    // Validar el controlador de casa  para guardar un nuevo registro de casa modelo, dejando vacio nombre de la constructora de la casa
     public function test_Validar_Controller_casa_nombre_constructora_vacia()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->post('/casa',[
             'claseCasa'   => 'Clase baja',
             'valorCasa' => '105000',
             'cantHabitacion'  => '3',
             'descripcion'  => 'Que sea de tres plantas',
             'nombreConstructora' => '',
             'constructora_id'  => '1',
             'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
         ]);
         $response->assertStatus(302);
     }


    // Validar el controlador de casa  para guardar un nuevo registro de casa modelo, dejando vacio imagen de la casa
    public function test_Validar_Controller_casa_imagen_vacia()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/casa',[
            'claseCasa'   => 'Clase baja',
            'valorCasa' => '105000',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Que sea de tres plantas',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> '',
        ]);
        $response->assertStatus(302);
    }


    // Validacion del controlador casa para guardar un nuevo regitro de la casa modelo, el nombre de la casa, no acepta doble espacio entre palabras
    //No la deja pasar pero, me tira una validacion que dice (El nombre de la casa no permite números)
    public function test_Validar_Controlador_casa_clase_de_casa_no_acepta_doble_espacio_entre_palabra()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/casa',[
            'claseCasa'   => 'Clase  baja',
            'valorCasa' => '105000',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Que sea de tres plantas',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);
        
        $response->assertStatus(302);

    }

    // Validacion del controlador casa para guardar un nuevo regitro de la casa modelo, clase de la casa, no acepta numeros, solo letras.
    public function test_Validar_Controlador_casa_con_la_clase_casa_con_numeros_solo_acepta_letras()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/casa',[
            'claseCasa'   => '1111',
            'valorCasa' => '105000',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Que sea de tres plantas',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);
        
        $response->assertStatus(302);

    }


   // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, en clase casa, con caracteres especiales, solo debe de aceptar letras
   public function test_Validar_Controller_casa_clase_de_la_casa_con_caracteres_especiales_solo_acepta_letras()
   {
       $user = User::findOrFail(1);
       Auth::login($user);

       $response = $this->post('/casa',[
            'claseCasa'   => '@@@',
            'valorCasa' => '105000',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Que sea de tres plantas',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);
        
       
       $response->assertStatus(302);
   }


   // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, valor de la casa, con letras , solo debe de aceptar numeros
   public function test_Validar_Controller_casa_valor_casa_con_letras_solo_acepta_numeros()
   {
       $user = User::findOrFail(1);
       Auth::login($user);

       $response = $this->post('/casa',[
            'claseCasa'   => 'Clase baja',
            'valorCasa' => 'yyy',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Que sea de tres plantas',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);
        
       
       $response->assertStatus(302);
   }

    // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, valor de la casa, con caracteres especales , solo debe de aceptar numeros
    public function test_Validar_Controller_casa_valor_casa_con_caracteres_especiales_solo_acepta_numeros()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
 
        $response = $this->post('/casa',[
             'claseCasa'   => 'Clase baja',
             'valorCasa' => '....',
             'cantHabitacion'  => '3',
             'descripcion'  => 'Que sea de tres plantas',
             'nombreConstructora' => '1',
             'constructora_id'  => '1',
             'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
         ]);
         
        
        $response->assertStatus(302);
    }

    // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, valor de la casa, menores a 100,00
    // El valor de la casa no debe ser menor de 100,000.
    public function test_Validar_Controller_casa_valor_casa_menor_a_cien_mil_debe_de_ser_mayor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
 
        $response = $this->post('/casa',[
             'claseCasa'   => 'Clase baja',
             'valorCasa' => '105',
             'cantHabitacion'  => '3',
             'descripcion'  => 'Que sea de tres plantas',
             'nombreConstructora' => '1',
             'constructora_id'  => '1',
             'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
         ]);
         
        
        $response->assertStatus(302);
    }


    // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, cantidad de habitaciones, debe de tener 1 como minimo y masximo 5
    public function test_Validar_Controller_casa_cantidad_de_habitaciones()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
 
        $response = $this->post('/casa',[
             'claseCasa'   => 'Clase baja',
             'valorCasa' => '105',
             'cantHabitacion'  => '6',
             'descripcion'  => 'Que sea de tres plantas',
             'nombreConstructora' => '1',
             'constructora_id'  => '1',
             'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
         ]);
         
        
        $response->assertStatus(302);
    }

        // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, cantidad de habitaciones, solo debe contener numeros
        public function test_Validar_Controller_casa_cantidad_de_habitaciones_solo_debe_contener_numeros()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
     
            $response = $this->post('/casa',[
                 'claseCasa'   => 'Clase baja',
                 'valorCasa' => '105',
                 'cantHabitacion'  => 'dos',
                 'descripcion'  => 'Que sea de tres plantas',
                 'nombreConstructora' => '1',
                 'constructora_id'  => '1',
                 'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
             ]);
             
            
            $response->assertStatus(302);
        }

    // Validar el controlador casa  para  guardar un nuevo regitro de la casa modelo, cantidad de habitaciones,con caracteres especiales, solo debe contener numeros
    public function test_Validar_Controller_casa_cantidad_de_habitaciones_con_caracteres_especiales_solo_debe_contener_numeros()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
         
                $response = $this->post('/casa',[
                     'claseCasa'   => 'Clase baja',
                     'valorCasa' => '105',
                     'cantHabitacion'  => '!',
                     'descripcion'  => 'Que sea de tres plantas',
                     'nombreConstructora' => '1',
                     'constructora_id'  => '1',
                     'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                 ]);
                 
                
                $response->assertStatus(302);
            }

    // Validar el controlador casa , en la descripción ingresare menos de 10 letras, para que se cumpla 
    //tiene que estar entre 10 a 150
    public function test_Validar_Controller_casa_con_la_descripcion_mayor_a_ciento_cincuenta()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/casa',[
            'claseCasa'   => 'Clase baja',
            'valorCasa' => '105000',
            'cantHabitacion'  => '3',
            'descripcion'  => 'Media cuadra al sur de los derechos humanos casa de dos 
             plantas porton color madera, 
             ventanas verdes rojas anaranjadas rosadas gradadas de maderaaaaaaaaa',
            'nombreConstructora' => '1',
            'constructora_id'  => '1',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);
        
        $response->assertStatus(302);
    }




    //Validacion de casa para actualizar la clase de casa de clase baja a clase media
    public function test_Validar_Controller_casa_update_clase_casa()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/casa/2/edit',[
                    'claseCasa'   => 'Casa media',
                    'valorCasa' => '105000',
                    'cantHabitacion'  => '3',
                    'descripcion'  => 'Media cuadra al sur de los derechos humanos casa de dos 
                     plantas porton color madera, 
                     ventanas verdes rojas anaranjadas rosadas gradadas de maderaaaaaaaaa',
                    'nombreConstructora' => '1',
                    'constructora_id'  => '1',
                    'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                ]);


                   // Traerme la casa que esta registrado
                  $casa = casa::findOrFail(2);

                  //comparueba el resultado de la consulta con el valor editado
                $this->assertTrue($casa->claseCasa == 'Casa media');
    }


    //Validacion de casa para actualizar el valor de la casa, de 105000 a 100000
    public function test_Validar_Controller_casa_update_valor_casa()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/casa/2/edit',[
                    'claseCasa'   => 'Casa media',
                    'valorCasa' => '100000',
                    'cantHabitacion'  => '3',
                    'descripcion'  => 'Media cuadra al sur de los derechos humanos casa de dos 
                     plantas porton color madera, 
                     ventanas verdes rojas anaranjadas rosadas gradadas de maderaaaaaaaaa',
                    'nombreConstructora' => '1',
                    'constructora_id'  => '1',
                    'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                ]);


                 // Traerme la casa que esta registrado
                  $casa = casa::findOrFail(2);

                  //comparueba el resultado de la consulta con el valor editado
                $this->assertTrue($casa->valorCasa == '100000');
    }



    //Validacion de casa para actualizar la cantidad de habitaciones, de 3 a 5
    public function test_Validar_Controller_casa_update_cantidad_habitacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa media',
                'valorCasa' => '100000',
                'cantHabitacion'  => '5',
                'descripcion'  => 'Media cuadra al sur de los derechos humanos casa de dos 
                 plantas porton color madera, 
                 ventanas verdes rojas anaranjadas rosadas gradadas de maderaaaaaaaaa',
                'nombreConstructora' => '1',
                'constructora_id'  => '1',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);


               // Traerme la casa que esta registrado
              $casa = casa::findOrFail(2);

              //comparueba el resultado de la consulta con el valor editado
            $this->assertTrue($casa->cantHabitacion == '5');
}

    //Validacion de casa para actualizar la descripcion, de Media cuadra al sur de los derechos humanos casa de dos 
     //plantas porton color madera a amarillo y verde
    public function test_Validar_Controller_casa_update_descripcion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa media',
                'valorCasa' => '100000',
                'cantHabitacion'  => '5',
                'descripcion'  => 'amarillo y verde',
                'nombreConstructora' => '1',
                'constructora_id'  => '1',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);


               // Traerme la casa que esta registrado
              $casa = casa::findOrFail(2);

              //comparueba el resultado de la consulta con el valor editado
            $this->assertTrue($casa->descripcion == 'amarillo y verde');
}


    //Validacion de casa para actualizar la nombre de la costuctora_d de 1 a 11
     public function test_Validar_Controller_casa_update_nombre_constructora()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->put('/casa/2/edit',[
             'claseCasa'   => 'Casa media',
             'valorCasa' => '100000',
             'cantHabitacion'  => '5',
             'descripcion'  => 'amarillo y verde',
             'nombreConstructora' => '1',
             'constructora_id'  => '11',
             'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
         ]);


            // Traerme la casa que esta registrado
           $casa = casa::findOrFail(2);

           //comparueba el resultado de la consulta con el valor editado
         $this->assertTrue($casa->constructora_id == '11');
}


    //Validacion de casa para actualizar constructora_id
    public function test_Validar_Controller_casa_update_constructora_id()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/casa/2/edit',[
            'claseCasa'   => 'Casa media',
            'valorCasa' => '100000',
            'cantHabitacion'  => '5',
            'descripcion'  => 'amarillo y verde',
            'nombreConstructora' => '1',
            'constructora_id'  => '11',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);


           // Traerme la casa que esta registrado
          $casa = casa::findOrFail(2);

          //comparueba el resultado de la consulta con el valor editado
        $this->assertTrue($casa->constructora_id == '11');


}

    // Validacion del controlador casa para actualizar clase casa vacio
    public function test_Validar_Controller_casa_update_clase_casa_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/casa/2/edit',[
                    'claseCasa'   => '',
                    'valorCasa' => '100000',
                    'cantHabitacion'  => '5',
                    'descripcion'  => 'amarillo y verde',
                    'nombreConstructora' => '1',
                    'constructora_id'  => '11',
                    'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                ]);
                
                $response->assertStatus(302);

            }


        // Validacion del controlador casa para actualizar cantidad de habitaciones vacio
        public function test_Validar_Controller_casa_update_cantidad_habitaciones_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa media',
                'valorCasa' => '100000',
                'cantHabitacion'  => '',
                'descripcion'  => 'amarillo y verde',
                'nombreConstructora' => '1',
                'constructora_id'  => '11',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            
            $response->assertStatus(302);

        }

    // Validacion del controlador casa para actualizar descripcion  vacio
    public function test_Validar_Controller_casa_update_descripcion_vacio()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/casa/2/edit',[
                    'claseCasa'   => 'Casa media',
                    'valorCasa' => '100000',
                    'cantHabitacion'  => '5',
                    'descripcion'  => '',
                    'nombreConstructora' => '1',
                    'constructora_id'  => '11',
                    'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                ]);
                
                $response->assertStatus(302);
    
            }


    // Validacion del controlador casa para actualizar nombre costructora  vacio
    public function test_Validar_Controller_casa_update_nombre_costructora_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa media',
                'valorCasa' => '100000',
                'cantHabitacion'  => '5',
                'descripcion'  => 'amarillo y verde',
                'nombreConstructora' => '',
                'constructora_id'  => '11',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            
            $response->assertStatus(302);

        }

    
        // Validacion del controlador casa para actualizar constructora_id vacio
        public function test_Validar_Controller_casa_update_costructora_id_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa media',
                'valorCasa' => '100000',
                'cantHabitacion'  => '5',
                'descripcion'  => 'amarillo y verde',
                'nombreConstructora' => '1',
                'constructora_id'  => '',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            
            $response->assertStatus(302);

        }


    // Validacion del controlador casa para actualizar clase casa, con doble espacio entre palabra
    public function test_Validar_Controller_casa_update_con_clase_casa_con_doble_espacio_entre_palabra()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa  media',
                'valorCasa' => '100000',
                'cantHabitacion'  => '5',
                'descripcion'  => 'amarillo y verde',
                'nombreConstructora' => '1',
                'constructora_id'  => '11',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            
            $response->assertStatus(302);
        }

    // Validacion del controlador casa actualizar, para ver que clase casa debe de ser unico
    public function test_Validar_Controller_casa_update_para_que_clase_casa_sea_unica()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/casa/2/edit',[
            'claseCasa'   => 'Casa media',
            'valorCasa' => '100000',
            'cantHabitacion'  => '5',
            'descripcion'  => 'amarillo y verde',
            'nombreConstructora' => '1',
            'constructora_id'  => '11',
            'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
        ]);

        $casa = casa::findOrFail(42);

        $this->assertFalse($casa->claseCasa== 'Casa media');
    }


        // Validacion del controlador casa para actualizar clase casa, que no acepte numeros
        public function test_Validar_Controller_casa_update_con_clase_casa_con_numeros_solo_acepta_letras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/casa/2/edit',[
                'claseCasa'   => 'Casa1234',
                'valorCasa' => '100000',
                'cantHabitacion'  => '5',
                'descripcion'  => 'amarillo y verde',
                'nombreConstructora' => '1',
                'constructora_id'  => '11',
                'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
            ]);
            
            $response->assertStatus(302);
        }



        // Validacion del controlador casa para actualizar clase casa, que no acepte caracteres especiales
        public function test_Validar_Controller_casa_update_con_clase_casa_caracteres_especialess_solo_acepta_letras()
            {
                $user = User::findOrFail(1);
                Auth::login($user);
        
                $response = $this->put('/casa/2/edit',[
                    'claseCasa'   => 'Casa@@',
                    'valorCasa' => '100000',
                    'cantHabitacion'  => '5',
                    'descripcion'  => 'amarillo y verde',
                    'nombreConstructora' => '1',
                    'constructora_id'  => '11',
                    'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                ]);
                
                $response->assertStatus(302);
            }


         // Validacion del controlador casa para actualizar valor casa, que no acepte letras
         public function test_Validar_Controller_casa_update_con_clase_casa_letras_solo_acepta_numeros()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->put('/casa/2/edit',[
                 'claseCasa'   => 'Casa@@',
                 'valorCasa' => 'cien',
                 'cantHabitacion'  => '5',
                 'descripcion'  => 'amarillo y verde',
                 'nombreConstructora' => '1',
                 'constructora_id'  => '11',
                 'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
             ]);
             
             $response->assertStatus(302);
         }

         // Validacion del controlador casa para actualizar valor casa,  no acepte caracteres especiales
         public function test_Validar_Controller_casa_update_el_valor_de_la_casa_solo_acepta_numeros()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->put('/casa/2/edit',[
                 'claseCasa'   => 'Casa@@',
                 'valorCasa' => 'cien!',
                 'cantHabitacion'  => '5',
                 'descripcion'  => 'amarillo y verde',
                 'nombreConstructora' => '1',
                 'constructora_id'  => '11',
                 'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
             ]);
             
             $response->assertStatus(302);
         }

     // Validacion del controlador casa para actualizar valor casa,  con numeros menor a 100000, debe de ser mayor o igual  a 100000
     public function test_Validar_Controller_casa_update_el_valor_de_la_casa_menor_a_cien_mil()
  {
      $user = User::findOrFail(1);
      Auth::login($user);

      $response = $this->put('/casa/2/edit',[
          'claseCasa'   => 'Casa media',
          'valorCasa' => '500',
          'cantHabitacion'  => '5',
          'descripcion'  => 'amarillo y verde',
          'nombreConstructora' => '1',
          'constructora_id'  => '11',
          'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
      ]);
      
      $response->assertStatus(302);
  }

    // Validacion del controlador casa para actualizar cantidad habitaciones, que no acepte letras
    public function test_Validar_Controller_casa_update_cantidad_habitaciones_solo_acepta_numeros()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
     
           $response = $this->put('/casa/2/edit',[
               'claseCasa'   => 'Casa media',
               'valorCasa' => '100000',
               'cantHabitacion'  => 'tres',
               'descripcion'  => 'amarillo y verde',
               'nombreConstructora' => '1',
               'constructora_id'  => '11',
               'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
           ]);
           
           $response->assertStatus(302);
       }

     // Validacion del controlador casa para actualizar cantidad habitaciones, que no acepte carcateres especiales
     public function test_Validar_Controller_casa_update_cantidad_habitaciones_caracteres_especiales__solo_acepta_numeros()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
   
         $response = $this->put('/casa/2/edit',[
             'claseCasa'   => 'Casa media',
             'valorCasa' => '100000',
             'cantHabitacion'  => 'tres@',
             'descripcion'  => 'amarillo y verde',
             'nombreConstructora' => '1',
             'constructora_id'  => '11',
             'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
         ]);
         
         $response->assertStatus(302);
     }



         // Validacion del controlador casa para actualizar cantidad habitaciones, para que se cumpla no debe de pasar de 5 habitaciones
         public function test_Validar_Controller_casa_update_cantidad_habitaciones_mayor_a_seis_solo_acepta_cinco()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
       
             $response = $this->put('/casa/2/edit',[
                 'claseCasa'   => 'Casa media',
                 'valorCasa' => '100000',
                 'cantHabitacion'  => '6',
                 'descripcion'  => 'amarillo y verde',
                 'nombreConstructora' => '1',
                 'constructora_id'  => '11',
                 'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
             ]);
             
             $response->assertStatus(302);
         }

         // Validacion del controlador casa para actualizar descripcion, debe de estar entre 10 y 150 
         public function test_Validar_Controller_casa_update_descripcion_mayor_a_ciento_cincuenta_debe_de_estar_diez_y_ciento_cincuenta()
             {
                 $user = User::findOrFail(1);
                 Auth::login($user);
           
                 $response = $this->put('/casa/2/edit',[
                     'claseCasa'   => 'Casa media',
                     'valorCasa' => '100000',
                     'cantHabitacion'  => '6',
                     'descripcion'  => 'Media cuadra al sur de los derechos humanos casa de dos 
                     plantas porton color madera, 
                     ventanas verdes rojas anaranjadas rosadas gradadas de maderaaaaaaaaa',
                     'nombreConstructora' => '1',
                     'constructora_id'  => '11',
                     'images'=> 'draw_svg20210507-22909-jwirfm.svg.pn',
                 ]);
                 
                 $response->assertStatus(302);
             }

    

    





    

    
 }