<?php

        /*
        |--------------------------------------------------------------------------
        |  Elaboradas por Sucelinda Valladares Flores
        |--------------------------------------------------------------------------
        */
namespace Tests\Feature;

use App\Models\User;
use App\Models\Reservacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class ReservacionesControllerTest extends TestCase
{
     /*
    |--------------------------------------------------------------------------
    |  Pruebas para Reservaciones
    |--------------------------------------------------------------------------
    */

        // Validación de la ruta create con el metodo get de reservacion
        public function test_Validar_ruta_reservacion_create()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
            $response = $this->get('/reservacion/create');
            $response->assertStatus(200);
        }

        // Validación de la ruta create con el metodo get de reservacion con valor invalido
        public function test_Validar_ruta_reservacion_create_invalido()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
            $response = $this->get('/reservacion/create5432345');
            $response->assertStatus(404);
        }

        // Esto es para probar si al precionar el boton de atras en la vista de create me 
        // redirige al listado de reservaciones
        public function testNavegacionDesdeElCreateAlIndexReservacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user); 
        
            $elementoId = 1; // ID del elemento que se selecciono
            $responseShow = $this->get(route('reservacion.create', ['id' => $elementoId]));
            $responseShow->assertStatus(200); // Verifica que la vista "show" se carga correctamente
            $responseIndex = $this->get(route('reservacion.index'));
            $responseIndex->assertStatus(200); // Verifica que la vista "index" se carga correctamente
        }

        // validar que se agregue una nueva resercacion con los datos vacios 
        public function test_Validar_Controlador_reservacion_store_nueva_reservacion_con_datos_vacios()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/reservacion',[
                'nombreCliente'   => '',
                'identidadCliente' => '',
                'telefono'  => '',
                'correoCliente' =>'',
                'fechaCita' => '',
                'horaCita'  => '',
            ]);

            // Verifica que se muestren los errores de validación para los campos
            $response->assertSessionHasErrors('nombreCliente'); 
            $response->assertSessionHasErrors('identidadCliente');
            $response->assertSessionHasErrors('telefono');
            $response->assertSessionHasErrors('correoCliente');
            $response->assertSessionHasErrors('fechaCita');
            $response->assertSessionHasErrors('horaCita');
            $response->assertStatus(302);
        }

        // validar que se agregue una nueva resercacion 
        public function test_Validar_Controlador_reservacion_store_nueva_reservacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vega',
                'identidadCliente' => '0704199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '24-08-2023',
                'horaCita'  => '11:00',
            ]);

        // Traerme la resercacion que supuestamente se registro
        $reservacion = Reservacion::where('nombreCliente','=','Milagro Vega')->get();

        // comprueba si me trajo la resercacion, con la funcion count cuenta los registros si es 1 esque si lo registro
        $this->assertTrue(  count($reservacion) == 1 );
        }

        // validar que no se agregue una nueva resercacion con nombre cliente vacio
        public function test_Validar_que_nombre_cliente_no_este_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => '',
                'identidadCliente' => '0704199800677',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '25-08-2023',
                'horaCita'  => '12:00',
            ]);
    
            $response->assertSessionHasErrors(['nombreCliente']); // Verifica que haya error de validación en el nombre Cliente
            $response->assertStatus(302);
        }

        // validar que se agregue una nueva resercacion con nombre cliente que no acepte numeros
        public function test_Validar_que_nombre_cliente_no_acepta_numeros()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => '87625239',
                'identidadCliente' => '0704199800678',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '12:00',
            ]);
    
            $response->assertSessionHasErrors(['nombreCliente']); // Verifica que haya error de validación en el nombre Cliente
            $response->assertStatus(302);
        }

        // validar que se agregue una nueva resercacion con nombre cliente debe comenzar con mayuscula
        public function test_Validar_que_nombre_cliente_debe_comenzar_con_mayuscula()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'rigo rodrigez',
                'identidadCliente' => '0704199800676',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '23-08-2023',
                'horaCita'  => '12:00',
            ]);
            $response->assertSessionHasErrors(['nombreCliente']); // Verifica que haya error de validación en el nombre Cliente
            $response->assertStatus(302);
        }

        // validar que se agregue una nueva resercacion con nombre cliente no debe tener doble espacio
        public function test_Validar_que_nombre_cliente_no_debe_tener_doble_espacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Rigo  Rodrigez',
                'identidadCliente' => '0704199800676',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '27-08-2023',
                'horaCita'  => '12:00',
            ]);
    
            $response->assertSessionHasErrors(['nombreCliente']); // Verifica que haya error de validación en el nombre Cliente
            $response->assertStatus(302);
        }

        // validar que se agregue una nueva resercacion que la identidad cliente no debe estar vacio
        public function test_Validar_que_identidad_cliente_no_este_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Rigo Rodrigez',
                'identidadCliente' => '',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '28-08-2023',
                'horaCita'  => '12:00',
            ]);
    
            $response->assertSessionHasErrors(['identidadCliente']); // Verifica que haya error de validación en la identidad del Cliente
            $response->assertStatus(302);
        }

        // validar que se agregue una nueva resercacion para que la identidad del cliente 
        // solo debe tener 13 numeros
        /*********Pasa pero Guarda con 14 numeros y no deberia pasar********/
        public function test_Validar_que_identidad_cliente_debe_tener_13_numeros()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Rigo Rodrigez',
                'identidadCliente' => '07031987005428',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '24-10-2023',
                'horaCita'  => '12:00',
            ]);
            $response->assertSessionHasErrors(['identidadCliente']); // Verifica que haya error de validación en la identidad del Cliente
        }

        // Validar que no se guarde la reservacion si el numero de identidad ya existe
        public function test_agregar_reservacion_sin_duplicar_identidad_cliente()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0704199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['identidadCliente']); // Verifica que haya error de validación en la identidad del cliente
            $response->assertStatus(302);
        }

        // Validar que no se guarde la reservacion si el numero de identidad tiene letras
        public function test_agregar_reservacion_que_no_acepte_letras__en_identidad_cliente()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => 'hcsdhbdkks',
                'telefono'  => '97675468',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['identidadCliente']); // Verifica que haya error de validación en la identidad del cliente
            $response->assertStatus(302);
        }

        // Validar que no se guarde la reservacion si el telefono esta vacio
        public function test_agregar_reservacion_que_el_telefono_no_este_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '07041997800456',
                'telefono'  => '',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono del cliente
            $response->assertStatus(302);
        }

        // Validar que no se guarde la reservacion si el telefono contiene letras
        public function test_agregar_reservacion_que_el_telefono_no_acepte_numeros()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '07041997800456',
                'telefono'  => '9863jhdbdj',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono del cliente
            $response->assertStatus(302);
        }

        // Validacion del controlador reservacion para guardar una nueva reservacion con
        // el teléfono que no acepta mas de 8 numeros
        /********* Guarda con mas de 8 numeros y no deberia pasar********/
        public function test_Validar_que_el_telefono_solo_acepta_8_numeros()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0704196780046',
                'telefono'  => '986378659',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '27-09-2023',
                'horaCita'  => '12:00',
            ]);
            // Traerme la resercacion que supuestamente se registro
           $reservacion = Reservacion::where('nombreCliente','=','Milagro Vargas')->get();
           // comprueba si me trajo la resercacion, con la funcion count cuenta los registros si es 1 esque si lo registro
           $this->assertFalse(  count($reservacion) == 1 );
        }

        // Validacion del controlador resercacion para guardar una nueva resercacion con
        // el teléfono con codigo regional 2, 3, 8, 9
        public function test_Validar_que_el_telefono_comience_con_2_3_8_9()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0704199780045',
                'telefono'  => '58637865',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '29-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); // Verifica que haya error de validación en el telefono del cliente
            $response->assertStatus(302);
        }

        // validar que no se agregue una nueva resercacion con correo cliente vacio
        public function test_Validar_que_el_correoCliente_no_este_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0704199780045',
                'telefono'  => '58637865',
                'correoCliente' =>'',
                'fechaCita' => '29-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['correoCliente']); // Verifica que haya error de validación en el correo del cliente
            $response->assertStatus(302);
        }

        // validar que no se agregue una nueva resercacion con correo cliente invalido
        public function test_Validar_el_correoCliente_para_que_sea_valido()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0704199780045',
                'telefono'  => '88637865',
                'correoCliente' =>'milagro',
                'fechaCita' => '29-08-2023',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['correoCliente']); // Verifica que haya error de validación en el correo del cliente
            $response->assertStatus(302);
        }

        // validar que no se agregue una nueva resercacion con fecha de la cita vacia
        public function test_Validar_la_fechaCita_para_que_no_este_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0704199780045',
                'telefono'  => '88637865',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '',
                'horaCita'  => '09:00',
            ]);
            $response->assertSessionHasErrors(['fechaCita']); // Verifica que haya error de validación en la fecha de la cita
            $response->assertStatus(302);
        }

        // validar que no se agregue una nueva resercacion con la hora de la cita vacia
        public function test_Validar_la_horaCita_para_que_no_este_vacia()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/reservacion',[
                'nombreCliente'   => 'Milagro Vargas',
                'identidadCliente' => '0703199780042',
                'telefono'  => '88637865',
                'correoCliente' =>'milagrodelavega@gmail.com',
                'fechaCita' => '23-07-2023',
                'horaCita'  => '',
            ]);
            $response->assertSessionHasErrors(['horaCita']); // Verifica que haya error de validación en la hora de la cita
            $response->assertStatus(302);
        }

         // Validación de la ruta index con el metodo get del reservacion
        public function test_Validar_ruta_reservacion_index()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
            $response = $this->get('/reservacion');
            $response->assertStatus(200);
        }

        // Validación de la ruta index con el metodo get del reservacion con valor incorrecto
        public function test_Validar_ruta_reservacion_index_valor_invalido()
        {
            $user = User::findOrFail(2);
            Auth::login($user);
                $response = $this->get('/847965487567');
                $response->assertStatus(404);
        }

        //Acceder a la ruta de Listado del reservacion GET
        public function test_Validar_listado_reservacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            //realiza una solicitud GET a la ruta de Listado de reservacion
            $response = $this->actingAs($user)->get('/reservacion');
            $response->assertStatus(200);
            $response->assertSee('Listado de reservaciones');  // Verificar que la vista contiene el título "Listado de reservaciones"
            $response->assertSee('Seleccione la fecha que desea buscar');
            $response->assertSee('Nueva reservación'); 
            $response->assertSee('Listado de reservaciones');
            $response->assertSee('Fecha cita');
            $response->assertSee('Nombre Cliente');
            $response->assertSee('Teléfono');
            $response->assertSee('Detalle');
            $response->assertSee('Actualizar');
        }

        // Validacion para Acceder al boton Nueva reservacion en el istado de reservacion
        public function test_Validar_boton_Nueva_reservación_en_Listado_reservaciones()
        {
                $user = User::findOrFail(1);
                Auth::login($user);
                // Realiza una solicitud GET a la vista donde se encuentra el botón
                $response = $this->actingAs($user)->get('/reservacion');

                // Hacer clic en el botón y seguir la redirección
                $response = $this->followingRedirects()->actingAs($user)->get(route('reservacion.create'));
                $response->assertSee('Registro de una nueva reservación'); //Muestra titulo de la ventana de Registro de una nueva reservación.
                // Verifica que se redirige correctamente a la ruta
                $response->assertStatus(200);
        }

        // Validacion para Acceder al boton Detalles de la reservacion en el istado de reservacion
        public function test_Validar_boton_Detalles_de_la_reservacion_en_Listado_reservacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            // Realiza una solicitud GET a la vista donde se encuentra el botón
            $response = $this->actingAs($user)->get('/reservacion');
            $response->assertStatus(200);
        
            // Hacer clic en el botón de Detalles de la reservacion  y seguir la redirección
            $response = $this->followingRedirects()->get('/reservacion/9');
        
            // Verifica que se redirige correctamente a la ruta de ver en la tabla de la reservacion
            $response->assertStatus(200);
            // Verificar que la vista contiene los datos
            $response->assertSee('Detalles de la reservación');
            $response->assertSee('Atrás');
            $response->assertSee('Detalles de');
            $response->assertSee('Datos');
            $response->assertSee('Información');
            $response->assertSee('Nombre cliente');
            $response->assertSee('Identidad');
            $response->assertSee('Teléfono');
            $response->assertSee('Correo electrónico');
            $response->assertSee('Fecha de la cita');
            $response->assertSee('Hora de la cita'); 
        }

        //Validacion para acceder al boton de actualizar detalles de la reservacion seleccionada
        public function test_validar_boton_actualizar_en_detalles_reservacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            //realiza una solicitud GET a la ruta de detalle reservacion
            $response = $this->actingAs($user)->get('/reservacion/7');
            $response->assertStatus(200);;
        
            // Hacer clic en el botón de editar y seguir la redirección
            $response = $this->followingRedirects()->get('/reservacion/7/edit');
        
            // Verifica que se redirige correctamente a la ruta de edición de la reservacion
            $response->assertStatus(200);

            $response->assertSee('Actualización de la reservación');

            // Obtiene el contenido HTML de la respuesta
            $content = $response->getContent();

            // Verifica que el valor "Milagro Vargas" esté presente en el campo nombreCliente
            $this->assertStringContainsString('Milagro Vargas', $content);
        }

        // Validacion de la ruta show para ver la reservacion selecionada
        public function test_Validar_Controlador_reservacion_show_ruta()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->get('/reservacion/1');
            $response->assertStatus(200);
        }

        // Validacion de la ruta show para ver la reservacion selecionada con ruta invalida
        public function test_Validar_Controlador_reservacion_show_ruta_invalida()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->get('/reservacion/1dvsdhjd');
            $response->assertStatus(404);
        }

        // Validación de la ruta edit de la reservacion
        public function test_Validar_Controlador_reservacion_edit_ruta()
        {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->get('/reservacion/17/edit');
          $response->assertStatus(200);
        }

        // Validación de la ruta edit del reservacion invalida
       public function test_Validar_Controlador_reservacion_edit_ruta_invalida()
       {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->get('/reservacion/1398363563830/edit');
           $response->assertStatus(404);
       }

       //Acceder a la ruta de actualizar la reservacion para verificar los datos
        public function test_Validar_los_datos_Actualizar_la_reservacion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
        
            // Hacer clic en el botón de Detalles de la reservacion  y seguir la redirección
            $response = $this->followingRedirects()->get('/reservacion/7/edit');
        
            // Verifica que se redirige correctamente a la ruta de ver en la tabla de la reservacion
            $response->assertStatus(200);
            // Verificar que la vista contiene los datos
            $response->assertSee('Actualización de la reservación');
            $response->assertSee('Atrás');
            $response->assertSee('Actualización de la reservación');
            $response->assertSee('Nombre del cliente:');
            $response->assertSee('Identidad:');
            $response->assertSee('Teléfono:');
            $response->assertSee('Correo electrónico:');
            $response->assertSee('Fecha de la Cita:');
            $response->assertSee('Hora de la cita:');
            $response->assertSee('Actualizar');
            $response->assertSee('Restablecer'); 
        }

        /************ME SALE ERROR EN LA PARTE DE ACTUALIZAR POR LA HORA DE LA CITA
         * ME DICE QUE YA ESTA EN USO Y ESO NO DEBERIA DE PASAR ***********/

        // validar que no se actualice la resercacion con nombre cliente vacio
        public function test_Validar_que_nombre_cliente_no_este_vacio_en_actualizar()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => '',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['nombreCliente']); // Verifica que haya error de validación en el nombre Cliente
        }

        // validar que no se actualice la resercacion con nombre cliente si tiene numeros
        public function test_Validar_que_nombre_cliente_no_acepte_numeros_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => '987654387654',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['nombreCliente']); // Verifica que haya error de validación en el nombre Cliente
        }

        // validar que no se actualice la resercacion con nombre cliente si no inicia con mayuscula
        public function test_Validar_que_nombre_cliente_debe_comenzar_con_mayuscula_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'rocio cruz',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['nombreCliente']); 
        }

        // validar que no se actualice la resercacion con nombre cliente si no inicia con mayuscula
        public function test_Validar_que_nombre_cliente_no_acepte_doble_espacio_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rocio  Cruz',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['nombreCliente']); 
        }

        // validar que no se actualice la resercacion con identidad cliente vacia
        public function test_Validar_que_identidad_cliente_no_este_vacio_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rocio Cruz',
                'identidadCliente' => '',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['identidadCliente']); 
        }

        // validar que no se actualice la resercacion con identidad cliente si ya existe en la base
        public function test_Validar_que_identidad_cliente_sea_unico_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $reservacion2 = Reservacion::findOrFail(17);
            $this->assertFalse($reservacion2->identidadCliente== '0715199800675');
        }

        // validar que no se actualice la resercacion con identidad cliente con letras
        public function test_Validar_que_identidad_cliente_solo_acepte_numeros_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => 'ghdsgsgshaahab',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['identidadCliente']); // Verifica que haya error de validación en el nombre Cliente
        }

        // Validar que no se actualice la reservacion si el telefono esta vacio
        public function test_Validar_que_telefono_no_este_vacio_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); 
        }

        // Validar que no se actualice la reservacion si el telefono tiene letras
        public function test_Validar_que_telefono_no_acepte_letras_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => 'xhcbshsjh',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); 
        }

        // Validar que no se actualice la reservacion si el telefono tiene mas de 8 numeros en actualizar
        public function test_Validar_que_telefono_solo_tenga_8_digitos_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '896584345',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); 
        }

        // Validar que no se actualice la reservacion si el telefono no empiece con 2, 3, 8, y 9
        public function test_Validar_que_telefono_debe_comenzar_con_2_3_8_9_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '67846459',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['telefono']); 
        }

        // Validar que no se actualice la reservacion si el correoCliente esta vacio
        public function test_Validar_que_correo_cliente_no_este_vacio_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['correoCliente']); 
        }

        // Validar que no se actualice la reservacion si el correoCliente no es valido
        public function test_Validar_que_correo_cliente_sea_valido_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'regoberto',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '11:00',
            ]);
            $response->assertSessionHasErrors(['correoCliente']); 
        }

        // Validar que no se actualice la reservacion si la fechaCita esta vacia
        public function test_Validar_que_fecha_cita_no_este_vacio_en_actualizar(){
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/reservacion/17/edit',[
                'nombreCliente'   => 'Rigoberto Gonzales',
                'identidadCliente' => '0715199800675',
                'telefono'  => '97675468',
                'correoCliente' =>'rigobertogonzalez@gmail.com',
                'fechaCita' => '26-08-2023',
                'horaCita'  => '',
            ]);
            $response->assertSessionHasErrors(['horaCita']); 
        }
        
}
