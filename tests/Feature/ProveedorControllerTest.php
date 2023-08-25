<?php
        /*
        |--------------------------------------------------------------------------
        |  Elaboradas por Sucelinda Valladares Flores
        |--------------------------------------------------------------------------
        */
namespace Tests\Feature;


use App\Models\User;
use App\Models\Proveedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class ProveedorControllerTest extends TestCase
{
     /*
    |--------------------------------------------------------------------------
    |  Pruebas para proveedor
    |--------------------------------------------------------------------------
    */

    // Validación de la ruta index con el metodo get del proveedor
    public function test_Validar_ruta_proveedor_index()
    {
       $user = User::findOrFail(2);
       Auth::login($user);
        $response = $this->get('/proveedor');
        $response->assertStatus(200);
    }

   // Validación de la ruta index con el metodo get del proveedor con valor incorrecto
   public function test_Validar_ruta_proveedor_index_valor_invalido()
   {
       $user = User::findOrFail(2);
       Auth::login($user);
        $response = $this->get('/7252561');
        $response->assertStatus(404);
   }

   // Validacion para Acceder al boton Nuevo proveedor en el de agregar en listado 
   public function test_Validar_boton_nuevo_proveedor_en_Listado_Proveedor()
   {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/proveedor');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('proveedor.create'));

        $response->assertSee('Registro de un nuevo proveedor'); //Muestra titulo de la ventana de registro proveedor.
         // Verifica que se redirige correctamente a la ruta
         $response->assertStatus(200);
    }

    //Acceder a la ruta de Listado del proveedor GET
    public function test_Validar_listado_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado proveedor
        $response = $this->actingAs($user)->get('/proveedor');
        $response->assertStatus(200);
        $response->assertSee('Listado de proveedores');  // Verificar que la vista contiene el título "Listado de proveedores"
        $response->assertSee('Nuevo proveedor'); 
        $response->assertSee('Nombre del proveedor');
        $response->assertSee('Nombre del contacto');
        $response->assertSee('Teléfono');
        $response->assertSee('Categoría');
        $response->assertSee('Detalle');
        $response->assertSee('Actualizar');
    }

    // Validación de la ruta create con el metodo get del proveedor
    public function test_Validar_ruta_proveedor_create()
    {
        $user = User::findOrFail(2);
        Auth::login($user);
         $response = $this->get('/proveedor/create');
         $response->assertStatus(200);
    }

   // Validación de la ruta create con el metodo get del proveedor con valor incorrecto
   public function test_Validar_ruta_proveedor_create_valor_invalido()
   {
       $user = User::findOrFail(2);
       Auth::login($user);
        $response = $this->get('/proveedor/7252561');
        $response->assertStatus(404);
   }

    //Acceder a la ruta de crear un nuevo proveedor GET
    public function test_Validar_crear_proveedor()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de listado proveedor
        $response = $this->actingAs($user)->get('proveedor/create');
        $response->assertStatus(200);
        $response->assertSee('Registro de un nuevo proveedor');  // Verificar que la vista contiene el título "Listado de proveedores"
        $response->assertSee('Atrás');
        $response->assertSee('Nombre del proveedor:');
        $response->assertSee('Nombre del contacto:'); 
        $response->assertSee('Cargo del contacto:');
        $response->assertSee('Dirección:');
        $response->assertSee('Teléfono:');
        $response->assertSee('Correo:');
        $response->assertSee('Categoría:');
        $response->assertSee('Guardar');
    }

   // Validación para crear un nuevo proveedor con los datos vacios  
   public function test_Validar_Controlador_proveedor_store_nuevo_proveedor_datos_vacios()
   {
       $user = User::findOrFail(1);
       Auth::login($user);

       $response = $this->post('/proveedor',[
           'nombreProveedor'   => '',
           'nombreContacto' => '',
           'cargoContacto'  => '',
           'direccion'    => '',
           'telefono' => '',
           'email'       => '',
           'categoria_id'    => '',
       ]);
       
        // Verifica que se muestren los errores de validación para los campos
       $response->assertSessionHasErrors('nombreProveedor'); 
       $response->assertSessionHasErrors('nombreContacto');
       $response->assertSessionHasErrors('cargoContacto');
       $response->assertSessionHasErrors('direccion');
       $response->assertSessionHasErrors('telefono');
       $response->assertSessionHasErrors('email');
       $response->assertSessionHasErrors('categoria_id');
       $response->assertStatus(302);

   }

   // validar que se agregue un nuevo proveerdor
   public function test_Validar_Controlador_proveedor_store_nuevo_proveedor()
   {
       $user = User::findOrFail(1);
       Auth::login($user);

       $response = $this->post('/proveedor',[
           'nombreProveedor'   => 'La casa de la madera',
           'nombreContacto' => 'Mario Rodriguez',
           'cargoContacto'  => 'distribuidor',
           'direccion'    => 'Barrio, las lomas, El Paraiso',
           'telefono' => '89765489',
           'email'       => 'mario.rodriguez@gmail.com',
           'categoria_id'    => 1,
       ]);

       // Traerme el provvedor que supuestamente se registro
       $proveedor = Proveedor::where('nombreProveedor','=','La casa de la madera')->get();

       // comprueba si me trajo el provvedor, con la funcion count cuenta los registros si es 1 esque si lo registro
       $this->assertTrue(  count($proveedor) == 1 );
    }

   // Validación para crear un nuevo proveedor que ya existe   
     public function test_Validar_Controlador_proveedor_store_nuevo_proveedor_repetido()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->post('/proveedor',[
             'nombreProveedor'   => 'La casa de la madera',
             'nombreContacto' => 'Mario Rodriguez',
             'cargoContacto'  => 'distribuidor',
             'direccion'    => 'Barrio, las lomas, El Paraiso',
             'telefono' => '89765489',
             'email'       => 'mario.rodriguez@gmail.com',
             'categoria_id'    => 1,
         ]);
         
         $response->assertStatus(302);
 
     }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del Proveedor vacio
       public function test_Validar_Controlador_proveedor_con_nombre_proveedor_vacio()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->post('/proveedor',[
               'nombreProveedor'   => '',
               'nombreContacto' => 'Mario Rodriguez',
               'cargoContacto'  => 'distribuidor',
               'direccion'    => 'Barrio, las lomas, El Paraiso',
               'telefono' => '89765489',
               'email'       => 'mario.rodriguez@gmail.com',
               'categoria_id'    => 1,
           ]);
           
           $response->assertSessionHasErrors(['nombreProveedor']); // Verifica que haya error de validación en el nombre del proveedor
           $response->assertStatus(302);
       }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del Contacto vacio
      public function test_Validar_Controlador_proveedor_con_nombre_contacto_vacio()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => '',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);

          $response->assertSessionHasErrors(['nombreContacto']); // Verifica que haya error de validación en el nombre del contacto
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el cargo del Contacto vacio
      public function test_Validar_Controlador_proveedor_con_cargo_contacto_vacio()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => '',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['cargoContacto']); // Verifica que haya error de validación en el cargo del contacto
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // la dirección vacia
      public function test_Validar_Controlador_proveedor_con_direccion_vacia()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => '',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['direccion']); // Verifica que haya error de validación en la direccion
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el teléfono vacio
      public function test_Validar_Controlador_proveedor_con_telefono_vacio()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el correo vacio
      public function test_Validar_Controlador_proveedor_con_correo_vacio()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => '',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['email']); // Verifica que haya error de validación en el email
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // categoría vacia
      public function test_Validar_Controlador_proveedor_con_categoria_vacia()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => '',
          ]);
          
          $response->assertSessionHasErrors(['categoria_id']); // Verifica que haya error de validación en la categoria
          $response->assertStatus(302);

      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // doble espacio en el nombre del proveedor
      public function test_Validar_Controlador_proveedor_con_doble_espacio_en_el_nombre_proveedor()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La  casa de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);

          $response->assertSessionHasErrors(['nombreProveedor']); // Verifica que haya error de validación en el nombre del proveedor
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del proveedor invalido por que solo acepta letras 
      /******En este caso no estoy del todo segura porque si se ingresan solo numeros la validadcion 
       * se cumple, pero si se ingresan letras y numeros conbinados no se cumple la validadcion ******/
      public function test_Validar_Controlador_proveedor_con_el_nombre_proveedor_numerico_solo_acepta_letras()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => '02762282929',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765485',
              'email'       => 'mario.rodriguez1@gmail.com',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['nombreProveedor']); // Verifica que haya error de validación en el nombre del proveedor
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del proveedor invalido por que solo acepta letras no acepta caracteres especiales
      public function test_Validar_Controlador_proveedor_con_el_nombre_proveedor_con_caracter_especial_solo_acepta_letras()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La cas@ de la madera',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'Distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['nombreProveedor']); // Verifica que haya error de validación en el nombre del proveedor
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del Contacto para que inicie con mayuscula
      public function test_Validar_Controlador_proveedor_con_el_nombre_contacto_inicie_con_mayuscula()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la madera',
              'nombreContacto' => 'mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765489',
              'email'       => 'mario.rodriguez@gmail.com',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['nombreContacto']); // Verifica que haya error de validación en el nombre del contacto
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del Contacto que no acepta números
      public function test_Validar_Controlador_proveedor_con_el_nombre_contacto_no_acepta_numeros()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue227',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);

          $response->assertSessionHasErrors(['nombreContacto']); // Verifica que haya error de validación en el nombre del contacto
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el nombre del Contacto que no acepta doble espacio entre palabras
      public function test_Validar_Controlador_proveedor_con_el_nombre_contacto_no_acepta_doble_espacio_entre_palabra()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario  Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          
          $response->assertSessionHasErrors(['nombreContacto']); // Verifica que haya error de validación en el nombre del contacto
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el cargo del Contacto que no acepta doble espacio entre palabras
      public function test_Validar_Controlador_proveedor_con_el_cargo_contacto_no_acepta_doble_espacio_entre_palabra()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor  Molina',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['cargoContacto']); // Verifica que haya error de validación en el cargo del contacto
          $response->assertStatus(302);
      }


       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el cargo del Contacto que no acepta numeros
      public function test_Validar_Controlador_proveedor_con_el_cargo_contacto_no_acepta_numeros()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor12',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '89765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['cargoContacto']); // Verifica que haya error de validación en el cargo del contacto
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor 
      // que la dirección no tiene que tener menos de 10 caracteres
      public function test_Validar_Controlador_proveedor_con_la_direccion_con_menos_de_10_caracteres()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Ba lomas',
              'telefono' => '89765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['direccion']); // Verifica que haya error de validación en la direccion
          $response->assertStatus(302);
      }


        // Validacion del controlador proveedor para guardar un nuevo proveedor 
      // que la dirección no tiene que tener mas de 150 caracteres
      public function test_Validar_Controlador_proveedor_con_la_direccion_con_mas_de_150_caracteres()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio las lomas, el paraiso por pulperia doña blanquira esquina opuesta de la casa de color rosa con zocalo color verde que esta a la par de un arbol grande de guanacaste',
              'telefono' => '89765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['direccion']); // Verifica que haya error de validación en la direccion
          $response->assertStatus(302);
      }

      // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el teléfono que solo acepta numeros
      public function test_Validar_Controlador_proveedor_con_el_telefono_solo_acepta_numeros()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => 'ochenta y nueve, setenta y seis, cincuenta y cuatro, ochenta y tres',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono
          $response->assertStatus(302);

      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el teléfono que no acepta mas de 8 numeros
      public function test_Validar_Controlador_proveedor_con_el_telefono_solo_acepta_8_numeros()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '897654837',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el teléfono con codigo regional 2, 3, 8, 9
      public function test_Validar_Controlador_proveedor_con_el_telefono_con_codigo_regional_2_3_8_9()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '69765483',
              'email'       => 'mario.rodriguez12@gmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono
          $response->assertStatus(302);
      }

       // Validacion del controlador proveedor para guardar un nuevo proveedor con
      // el correo invalido
      public function test_Validar_Controlador_proveedor_con_correo_invalido()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->post('/proveedor',[
              'nombreProveedor'   => 'La casa de la ceramica',
              'nombreContacto' => 'Mario Rodrigue',
              'cargoContacto'  => 'distribuidor',
              'direccion'    => 'Barrio, las lomas, El Paraiso',
              'telefono' => '39765489',
              'email'       => 'rodriguez.mariogmail.com',
              'categoria_id'    => 1,
          ]);
          $response->assertSessionHasErrors(['email']); // Verifica que haya error de validación en el email
          $response->assertStatus(302);

      }

        // Validacion de la ruta del controlador proveedor para ver el proveedor selecionado
      public function test_Validar_Controlador_proveedor_show_ruta()
      {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->get('/proveedor/1');
          $response->assertStatus(200);
      }

         // Validacion del controlador proveedor para ver el proveedor selecionado
         public function test_Validar_Controlador_proveedor_show_ruta_invalida_que_no_existe()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
     
             $response = $this->get('/proveedor/18636892092828');
             $response->assertStatus(404);
         }

        //Validacion para acceder al boton de editar detalles del proveedor seleccionado
        public function test_validar_boton_actualizar_en_detalles_proveedor()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->actingAs($user)->get('/proveedor/15');
            $response->assertStatus(200);;
        
            $response = $this->followingRedirects()->get('/proveedor/15/edit');
            $response->assertStatus(200);
            $response->assertSee('Actualización del proveedor');
            // Obtiene el contenido HTML de la respuesta
            $content = $response->getContent();
            // Verifica que el valor "La casa de la madera" esté presente en el campo nombreProveedor
            $this->assertStringContainsString('La casa de la madera', $content);
        }

        // Validación de la ruta edit del proveedor
        public function test_Validar_Controlador_proveedor_edit_ruta()
        {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->get('/proveedor/13/edit');
          $response->assertStatus(200);
        }

       // Validación de la ruta edit del proveedor invalida
       public function test_Validar_Controlador_proveedor_edit_ruta_invalida()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->get('/proveedor/1398363563830/edit');
           $response->assertStatus(404);
       }

       // Validacion del controlador proveedor para actualizar el nombre del proveedor de
       // La casa de la madera a sherwin williams
       public function test_Validar_Controlador_proveedor_update_nombre_proveedor()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/proveedor/13/edit',[
               'nombreProveedor'   => 'sherwin williams',
               'nombreContacto' => 'Mario Rodriguez',
               'cargoContacto'  => 'distribuidor',
               'direccion'    => 'Barrio, las lomas, El Paraiso',
               'telefono' => '89765489',
               'email'       => 'mario.rodriguez@gmail.com',
               'categoria_id'    => 1,
           ]);

           $proveedor1 = Proveedor::findOrFail(13);
           $this->assertTrue($proveedor1->nombreProveedor == 'sherwin williams');
       }

       // Validacion del controlador proveedor actualizar, para ver que nombre proveedor debe de ser unico
       public function test_Validar_Controlador_proveedor_update_para_que_nombreProveedor_sea_unico()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/proveedor/13/edit',[
               'nombreProveedor'   => 'La casa de la madera',
               'nombreContacto' => 'Mario Rodriguez',
               'cargoContacto'  => 'Analista',
               'direccion'    => 'Barrio, las lomas, Danli',
               'telefono' => '89765489',
               'email'       => 'mario.rodriguez@gmail.com',
               'categoria_id'    => 3,
           ]);

           $proveedor1 = Proveedor::findOrFail(13);

           $this->assertFalse($proveedor1->nombreProveedor== 'La casa de la madera');
       }

       // Validacion del controlador proveedor actualizar, para ver que correo debe de ser unico
       public function test_Validar_Controlador_proveedor_update_para_que_correo_sea_unico()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/proveedor/13/edit',[
               'nombreProveedor'   => 'sherwin williams',
               'nombreContacto' => 'Mario Rodriguez',
               'cargoContacto'  => 'Analista',
               'direccion'    => 'Barrio, las lomas, Danli',
               'telefono' => '89765489',
               'email'       => 'zwill@hotmail.com',
               'categoria_id'    => 3,
           ]);

           $proveedor1 = Proveedor::findOrFail(13);

           $this->assertFalse($proveedor1->email== 'zwill@hotmail.com');

       }

       // Validacion del controlador proveedor actualizar, para ver que telefono debe de ser unico
       public function test_Validar_Controlador_proveedor_update_para_que_telefono_sea_unico()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/proveedor/13/edit',[
               'nombreProveedor'   => 'sherwin williams',
               'nombreContacto' => 'Mario Rodriguez',
               'cargoContacto'  => 'Analista',
               'direccion'    => 'Barrio, las lomas, Danli',
               'telefono' => '89765485',
               'email'       => 'mario.rodriguez@gmail.com',
               'categoria_id'    => 3,
           ]);

           $proveedor1 = Proveedor::findOrFail(13);
           $this->assertFalse($proveedor1->telefono== '89765485');
       }

        // Validacion del controlador proveedor para actualizar el nombre del contacto de Mario Rodriguez 
        // a Mario Jimenez
        public function test_Validar_Controlador_proveedor_update_nombre_contacto()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/proveedor/13/edit',[
                'nombreProveedor'   => 'sherwin williams',
                'nombreContacto' => 'Mario Jimenez',
                'cargoContacto'  => 'distribuidor',
                'direccion'    => 'Barrio, las lomas, El Paraiso',
                'telefono' => '89765489',
                'email'       => 'mario.rodriguez@gmail.com',
                'categoria_id'    => 1,
            ]);

            $proveedor1 = Proveedor::findOrFail(13);
            $this->assertTrue($proveedor1->nombreContacto == 'Mario Jimenez');
         }

        // Validacion del controlador proveedor para actualizar el cargo del contacto de distribuidor 
        // a Vendedor
        public function test_Validar_Controlador_proveedor_update_cargo_contacto()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/proveedor/13/edit',[
               'nombreProveedor'   => 'sherwin williams',
                'nombreContacto' => 'Mario Jimenez',
                'cargoContacto'  => 'Vendedor',
                'direccion'    => 'Barrio, las lomas, El Paraiso',
                'telefono' => '87675489',
                'email'       => 'mario.rodriguez@gmail.com',
                'categoria_id'    => 1,
            ]);

            $proveedor1 = Proveedor::findOrFail(13);

            $this->assertTrue($proveedor1->cargoContacto == 'Vendedor');
         }

         // Validacion del controlador proveedor para actualizar la direccion de Barrio, las lomas, El Paraiso 
         // a Barrio, las colinas, El Paraiso
         public function test_Validar_Controlador_proveedor_update_direccion()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
 
             $response = $this->put('/proveedor/13/edit',[
                'nombreProveedor'   => 'sherwin williams',
                 'nombreContacto' => 'Mario Jimenez',
                 'cargoContacto'  => 'Vendedor',
                 'direccion'    => 'Barrio, las colinas, El Paraiso',
                 'telefono' => '87675489',
                 'email'       => 'mario.rodriguez@gmail.com',
                 'categoria_id'    => 1,
             ]);
 
             $proveedor1 = Proveedor::findOrFail(13);
             $this->assertTrue($proveedor1->direccion == 'Barrio, las colinas, El Paraiso');
         }

         // Validacion del controlador proveedor para actualizar el telefono de 87675489 a 87675482
         public function test_Validar_Controlador_proveedor_update_telefono()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
 
             $response = $this->put('/proveedor/13/edit',[
                'nombreProveedor'   => 'sherwin williams',
                 'nombreContacto' => 'Mario Jimenez',
                 'cargoContacto'  => 'Vendedor',
                 'direccion'    => 'Barrio, las colinas, El Paraiso',
                 'telefono' => '87675482',
                 'email'       => 'mario.rodriguez@gmail.com',
                 'categoria_id'    => 1,
             ]);
             $proveedor1 = Proveedor::findOrFail(13);
             $this->assertTrue($proveedor1->telefono == '87675482');
         }

         // Validacion del controlador proveedor para actualizar el correo de mario.rodriguez@gmail.com 
         // a mario.jimenez@gmail.com
         public function test_Validar_Controlador_proveedor_update_correo()
         {
             $user = User::findOrFail(1);
             Auth::login($user);
 
             $response = $this->put('/proveedor/13/edit',[
                'nombreProveedor'   => 'sherwin williams',
                 'nombreContacto' => 'Mario Jimenez',
                 'cargoContacto'  => 'Vendedor',
                 'direccion'    => 'Barrio, las colinas, El Paraiso',
                 'telefono' => '87675482',
                 'email'       => 'mario.jimenez@gmail.com',
                 'categoria_id'    => 1,
             ]);
             $proveedor1 = Proveedor::findOrFail(13);
             $this->assertTrue($proveedor1->email == 'mario.jimenez@gmail.com');
         }

        // Validacion del controlador proveedor para actualizar la categoria
        public function test_Validar_Controlador_proveedor_update_la_categoria_de_1_a_2()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
  
            $response = $this->put('/proveedor/13/edit',[
                'nombreProveedor'   => 'sherwin williams',
                'nombreContacto' => 'Mario Jimenez',
                'cargoContacto'  => 'Vendedor',
                'direccion'    => 'Barrio, las colinas, El Paraiso',
                'telefono' => '87675482',
                'email'       => 'mario.jimenez@gmail.com',
                'categoria_id'    => 2,
            ]);
            $proveedor1 = Proveedor::findOrFail(13);
            $this->assertTrue($proveedor1->categoria_id == '2');
        }

        // Validacion del controlador proveedor para actualizar con
           // el nombre del Proveedor vacio
        public function test_Validar_Controlador_proveedor_update_con_nombre_proveedor_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
       
            $response = $this->put('/proveedor/13/edit',[
                'nombreProveedor'   => '',
                'nombreContacto' => 'Mario Jimenez',
                'cargoContacto'  => 'Vendedor',
                'direccion'    => 'Barrio, las colinas, El Paraiso',
                'telefono' => '87675482',
                'email'       => 'mario.jimenez@gmail.com',
                'categoria_id'    => 2,
            ]);
            $response->assertSessionHasErrors(['nombreProveedor']);
            $response->assertStatus(302);
        }

           // Validacion del controlador proveedor para actualizar con
           // el nombre del contacto vacio
           public function test_Validar_Controlador_proveedor_update_con_nombre_contacto_vacio()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => '',
                   'cargoContacto'  => 'Vendedor',
                   'direccion'    => 'Barrio, las colinas, El Paraiso',
                   'telefono' => '87675482',
                   'email'       => 'mario.jimenez@gmail.com',
                   'categoria_id'    => 2,
               ]);
               $response->assertSessionHasErrors(['nombreContacto']);
               $response->assertStatus(302);
           }

           
           // Validacion del controlador proveedor para actualizar con
           // el cargo del contacto vacio
          public function test_Validar_Controlador_proveedor_update_con_cargo_contacto_vacio()
          {
              $user = User::findOrFail(1);
              Auth::login($user);
  
              $response = $this->put('/proveedor/13/edit',[
                 'nombreProveedor'   => 'sherwin williams',
                  'nombreContacto' => 'Mario Jimenez',
                  'cargoContacto'  => '',
                  'direccion'    => 'Barrio, las colinas, El Paraiso',
                  'telefono' => '87675482',
                  'email'       => 'mario.jimenez@gmail.com',
                  'categoria_id'    => 2,
              ]);
              $response->assertSessionHasErrors(['cargoContacto']);
              $response->assertStatus(302);
          }

           // Validacion del controlador proveedor para actualizar con
           // la direccion vacia
          public function test_Validar_Controlador_proveedor_update_con_direccion_vacia()
          {
              $user = User::findOrFail(1);
              Auth::login($user);
  
              $response = $this->put('/proveedor/13/edit',[
                 'nombreProveedor'   => 'sherwin williams',
                  'nombreContacto' => 'Mario Jimenez',
                  'cargoContacto'  => 'Vendedor',
                  'direccion'    => '',
                  'telefono' => '87675482',
                  'email'       => 'mario.jimenez@gmail.com',
                  'categoria_id'    => 2,
              ]);
              $response->assertSessionHasErrors(['direccion']);
              $response->assertStatus(302);
          }

           // Validacion del controlador proveedor para actualizar con
           // la telefono vacio
           public function test_Validar_Controlador_proveedor_update_con_telefono_vacio()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
   
               $response = $this->put('/proveedor/13/edit',[
                  'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario Jimenez',
                   'cargoContacto'  => 'Vendedor',
                   'direccion'    => 'Barrio, las colinas, El Paraiso',
                   'telefono' => '',
                   'email'       => 'mario.jimenez@gmail.com',
                   'categoria_id'    => 2,
               ]);
               $response->assertSessionHasErrors(['telefono']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar con
           // el correo vacio
           public function test_Validar_Controlador_proveedor_update_con_correo_vacio()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
   
               $response = $this->put('/proveedor/13/edit',[
                  'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario Jimenez',
                   'cargoContacto'  => 'Vendedor',
                   'direccion'    => 'Barrio, las colinas, El Paraiso',
                   'telefono' => ' 87675482',
                   'email'       => '',
                   'categoria_id'    => 2,
               ]);
               $response->assertSessionHasErrors(['email']);
               $response->assertStatus(302);
           }

            // Validacion del controlador proveedor para actualizar con
           // la categoria vacia
           public function test_Validar_Controlador_proveedor_update_con_categoria_vacia()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
   
               $response = $this->put('/proveedor/13/edit',[
                  'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario Jimenez',
                   'cargoContacto'  => 'Vendedor',
                   'direccion'    => 'Barrio, las colinas, El Paraiso',
                   'telefono' => ' 87675482',
                   'email'       => ' mario.jimenez@gmail.com',
                   'categoria_id'    => '',
               ]);
               $response->assertSessionHasErrors(['categoria_id']);
               $response->assertStatus(302);
           }

           
           // Validacion del controlador proveedor para actualizar el nombre del proveedor para que no acepte
           // doble espacio
           public function test_Validar_Controlador_proveedor_update_no_acepta_doble_espacio_en_el_nombre_proveedor()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin  williams',
                   'nombreContacto' => 'Mario Rodriguez',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreProveedor']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar el nombre del proveedor para que no
           // acepte numeros
           /******En este caso no estoy del todo segura porque si se ingresan solo numeros la validadcion 
           * se cumple, pero si se ingresan letras y numeros conbinados no se cumple la validadcion ******/
           public function test_Validar_Controlador_proveedor_update_no_acepta_numeros_en_el_nombre_proveedor()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => '8365272292',
                   'nombreContacto' => 'Mario Rodriguez',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreProveedor']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar el nombre del contacto para que 
           // inicie con mayuscula
           public function test_Validar_Controlador_proveedor_update_debe_iniciar_con_mayuscula_en_el_nombre_del_contacto()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'mario Rodriguez',
                   'cargoContacto'  => 'distribuidor sherwi',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreContacto']);
               $response->assertStatus(302);
           }

            // Validacion del controlador proveedor para actualizar el nombre del proveedor para que 
            // no acepte caracteres especiales
           public function test_Validar_Controlador_proveedor_update_no_acepta_caracteres_especiales_en_el_nombre_proveedor()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin willi@ms',
                   'nombreContacto' => 'Mario Rodriguez',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreProveedor']);
               $response->assertStatus(302);
           }

            // Validacion del controlador proveedor para actualizar el nombre del contacto para que no acepte
           // doble espacio
           public function test_Validar_Controlador_proveedor_update_no_acepta_doble_espacio_en_el_nombre_del_contacto()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario  Rodriguez',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreContacto']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar el nombre del contacto para que no
           // acepte numeros
           /******En este caso no estoy del todo segura porque si se ingresan solo numeros la validadcion 
           * se cumple, pero si se ingresan letras y numeros conbinados no se cumple la validadcion ******/
           public function test_Validar_Controlador_proveedor_update_no_acepta_numeros_en_el_nombre_del_contacto()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => '837379202',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreContacto']);
               $response->assertStatus(302);
           }

            // Validacion del controlador proveedor para actualizar el nombre del contacto para que 
            // no acepte caracteres especiales
           public function test_Validar_Controlador_proveedor_update_no_acepta_caracteres_especiales_en_el_nombre_del_contacto()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario Rodrigue&',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['nombreContacto']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar el cargo del contacto para que no acepte
           // doble espacio
           public function test_Validar_Controlador_proveedor_update_no_acepta_doble_espacio_en_el_cargo_del_contacto()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario Rodriguez',
                   'cargoContacto'  => 'distribuidor  sherwin',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['cargoContacto']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar el cargo del contacto para que no
           // acepte numeros
           /******En este caso no estoy del todo segura porque si se ingresan solo numeros la validadcion 
           * se cumple, pero si se ingresan letras y numeros conbinados no se cumple la validadcion ******/
           public function test_Validar_Controlador_proveedor_update_no_acepta_numeros_en_el_cargo_del_contacto()
           {
               $user = User::findOrFail(1);
               Auth::login($user);

               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'sherwin williams',
                   'nombreContacto' => 'Mario Rodriguez',
                   'cargoContacto'  => '826693399230',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765489',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['cargoContacto']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar
           // el teléfono con codigo regional 2, 3, 8, 9
           public function test_Validar_Controlador_proveedor_update_con_el_telefono_con_codigo_regional_2_3_8_9()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'La casa de la ceramica',
                   'nombreContacto' => 'Mario Rodrigue',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '49765483',
                   'email'       => 'mario.rodriguez@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['telefono']);
               $response->assertStatus(302);
           }

            // Validacion del controlador proveedor para actualizar un proveedor seleccionado
           // que la dirección no tiene que tener menos de 10 caracteres
           public function test_Validar_Controlador_proveedor_update_con_la_direccion_con_menos_de_10_caracteres()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'La casa de la ceramica',
                   'nombreContacto' => 'Mario Rodrigue',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Ba lomas',
                   'telefono' => '89765483',
                   'email'       => 'mario.rodriguez12@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['direccion']);
               $response->assertStatus(302);

           }
           // Validacion del controlador proveedor para actualizar un proveedor seleccionado
           // que la dirección no tiene que tener mas de 150 caracteres
           public function test_Validar_Controlador_proveedor_update_con_la_direccion_con_mas_de_150_caracteres()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'La casa de la ceramica',
                   'nombreContacto' => 'Mario Rodrigue',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio las lomas, el paraiso por pulperia doña blanquira esquina opuesta de la casa de color rosa con zocalo color verde que esta a la par de un arbol grande de guanacaste',
                   'telefono' => '89765483',
                   'email'       => 'mario.rodriguez12@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['direccion']);
               $response->assertStatus(302);

           }

            // Validacion del controlador proveedor para actualizar un proveedor selecionado con
           // el teléfono que solo acepta numeros
           public function test_Validar_Controlador_proveedor_update_con_el_telefono_que_solo_acepta_numeros()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'La casa de la ceramica',
                   'nombreContacto' => 'Mario Rodrigue',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '897654B3',
                   'email'       => 'mario.rodriguez12@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['telefono']);
               $response->assertStatus(302);
           }
            
            // Validacion del controlador proveedor para actualizar un proveedor selecionado con
           // el teléfono que debe tener 8 digitos
           public function test_Validar_Controlador_proveedor_update_con_el_telefono_que_debe_tener_8_digitos()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'La casa de la ceramica',
                   'nombreContacto' => 'Mario Rodrigue',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '897654',
                   'email'       => 'mario.rodriguez12@gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['telefono']);
               $response->assertStatus(302);
           }

           // Validacion del controlador proveedor para actualizar un proveedor selecionado que
           // Debe ingresar un correo electrónico válido
           public function test_Validar_Controlador_proveedor_update_con_correo_invalido()
           {
               $user = User::findOrFail(1);
               Auth::login($user);
       
               $response = $this->put('/proveedor/13/edit',[
                   'nombreProveedor'   => 'La casa de la ceramica',
                   'nombreContacto' => 'Mario Rodrigue',
                   'cargoContacto'  => 'distribuidor',
                   'direccion'    => 'Barrio, las lomas, El Paraiso',
                   'telefono' => '89765483',
                   'email'       => 'mario.rodriguez12gmail.com',
                   'categoria_id'    => 1,
               ]);
               $response->assertSessionHasErrors(['email']);
               $response->assertStatus(302);
           }

           
}
