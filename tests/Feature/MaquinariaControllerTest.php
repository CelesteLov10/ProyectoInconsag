<?php
        /*
        |--------------------------------------------------------------------------
        |  Elaboradas por Sucelinda Valladares Flores
        |--------------------------------------------------------------------------
        */
namespace Tests\Feature;

use App\Models\User;
use App\Models\Maquinaria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class MaquinariaControllerTest extends TestCase
{    
        /*
        |--------------------------------------------------------------------------
        |  Pruebas para maquinaria
        |--------------------------------------------------------------------------
        */

        // Validación de la ruta index con el metodo get de maquinaria
        public function test_Validar_ruta_maquinaria_index()
        {
        $user = User::findOrFail(2);
        Auth::login($user);

            $response = $this->get('/maquinaria');
            $response->assertSee('Listado de maquinarias');  // Verificar que la vista contiene el título "Listado de maquinarias"

            $response->assertStatus(200);
        }

        // Validación de la ruta index con el metodo get de maquinaria invalida
        public function test_Validar_ruta_maquinaria_index_invalida()
        {
        $user = User::findOrFail(1);
        Auth::login($user);
            $response = $this->get('/maquin7546');
            $response->assertStatus(404);
        }

        //Acceder a la ruta de Listado de maquinaria GET
        public function test_Validar_listado_maquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            //realiza una solicitud GET a la ruta de listado maquinaria
            $response = $this->actingAs($user)->get('/maquinaria');
            $response->assertStatus(200);
            $response->assertSee('Listado de maquinarias');  // Verificar que la vista contiene el título "Listado de maquinarias"
            $response->assertSee('Nombre de maquinaria');
            $response->assertSee('Maquinaria');
            $response->assertSee('Nombre del proveedor');
            $response->assertSee('Nombre del contacto');
            $response->assertSee('Detalle');
            $response->assertSee('Actualizar');
            $response->assertSee('PDF'); 
            $response->assertSee('Nueva maquinaria'); 
        }

        //Validacion para acceder al boton de agregar en el listado de la maquinaria
        public function test__validar_boton_NuevaMaquinaria_en_Listado_Maquinaria(){
            $user = User::findOrFail(1);
            Auth::login($user);

            // Realiza una solicitud GET a la vista donde se encuentra el botón
            $response = $this->actingAs($user)->get('/maquinaria');

            // Hacer clic en el botón y seguir la redirección
            $response = $this->followingRedirects()->actingAs($user)->get(route('maquinaria.create'));

            // Verifica que se redirige correctamente a la ruta
            $response->assertStatus(200);
            $response->assertSee('Registro de una nueva maquinaria'); //Muestra titulo de la ventana de registro de maquinaria.
        }

        //Validacion para acceder al boton de editar detalles de la maquinaria seleccionado
        public function test_Validar_boton_Actualizar_en_detalles_maquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            //realiza una solicitud GET a la ruta de detalle maquinaria
            $response = $this->actingAs($user)->get('/maquinaria/162');
            $response->assertStatus(200);;
        
            // Hacer clic en el botón de editar y seguir la redirección
            $response = $this->followingRedirects()->get('/maquinaria/162/edit');
        
            // Verifica que se redirige correctamente a la ruta de edición de la maquinaria
            $response->assertStatus(200);

            $response->assertSee('Actualización de la maquinaria');

            // Obtiene el contenido HTML de la respuesta
            $content = $response->getContent();

            // Verifica que el valor "Tractor" esté presente en el campo nombreMaquinaria
            $this->assertStringContainsString('Tractor', $content);
        }

        // Esto es para probar si al precionar el boton de atras en la vista de show me 
            // redirige al listado de maquinaria
        public function testNavegacionDesdElShowAlIndexMaquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user); 

            $elementoId = 108; // ID del elemento que se selecciono
            $responseShow = $this->get(route('maquinaria.show', ['id' => $elementoId]));
            $responseShow->assertStatus(200); // Verifica que la vista "show" se carga correctamente
            $responseIndex = $this->get(route('maquinaria.index'));
            $responseIndex->assertStatus(200); // Verifica que la vista "index" se carga correctamente
        }


        // Validación de la ruta create con el metodo get de maquinaria
        public function test_Validar_ruta_maquinaria_create()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
            $response = $this->get('/maquinaria/create');
            $response->assertStatus(200);
        }

        // Validación de la ruta create con el metodo get de maquinaria invalida
        public function test_Validar_ruta_maquinaria_create_invalida()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
            $response = $this->get('/maquinaria/create1');
            $response->assertStatus(404);
        }

        // Esto es para probar si al precionar el boton de atras en la vista de create me 
        // redirige al listado de maquinaria
        public function testNavegacionDesdeElCreateAlIndexMaquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user); 
    
            $elementoId = 162; // ID del elemento que se selecciono
            $responseShow = $this->get(route('maquinaria.create', ['id' => $elementoId]));
            $responseShow->assertStatus(200); // Verifica que la vista "show" se carga correctamente
            $responseIndex = $this->get(route('maquinaria.index'));
            $responseIndex->assertStatus(200); // Verifica que la vista "index" se carga correctamente
        }

        // Validación para crear una nueva maquinaria con los datos vacios  
        public function test_Validar_Controlador_maquinaria_store_nueva_maquinaria_datos_vacios()
        {

            $user = User::findOrFail(1);
            $this->actingAs($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => '',
                'modelo' => '',
                'placa'  => 'AAA0000', 
                'descripcion'       => '',
                'fechaAdquisicion'    =>'',
                'proveedor_id'       => '',
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);

            // Verifica que se muestren los errores de validación en los campos
            $response->assertSessionHasErrors('nombreMaquinaria'); 
            $response->assertSessionHasErrors('modelo');
            $response->assertSessionHasErrors('descripcion');
            $response->assertSessionHasErrors('fechaAdquisicion');
            $response->assertSessionHasErrors('proveedor_id');
            $response->assertSessionHasErrors('cantidadHoraAlquilada');
            $response->assertSessionHasErrors('valorHora');
            $response->assertSessionHasErrors('totalPagar');

            $response->assertStatus(302);
        }

        public function test_agregar_nueva_maquinaria_con_maquinaria_propia()
        {
            $user = User::findOrFail(1);
            $this->actingAs($user); 

            $maquinariaData = [
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ];

            $response = $this->withoutMiddleware()->post('/maquinaria', $maquinariaData);
            $this->assertDatabaseHas('maquinarias', $maquinariaData); // Verifica que la maquinaria se ha creado en la base de datos
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // el nombre de la maquinaria vacio
        public function testCampoVacioNombreMaquinaria()
        {
            // Crea un usuario y autentícalo
            $user = User::findOrFail(1);
            $this->actingAs($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => '',
                'modelo' => 'Retroexcavadora  MT975E',
                'placa'  => 'AAA003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);

            // Verifica que la maquinaria no se agregó
            $response->assertSessionHasErrors('nombreMaquinaria');
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // el modelo vacio
        public function testCampoVacioModelo()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => '',
                'placa'  => 'AAA003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);

            // Verifica que la maquinaria no se agregó
            $response->assertSessionHasErrors('modelo');
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // la descripcion vacia
        public function testCampoVacioDescripcion()
        {
            // Crea un usuario y autentícalo
            $user = User::findOrFail(1);
            $this->actingAs($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA003', 
                'descripcion'       => '',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);

                $response->assertSessionHasErrors('descripcion');
                $response->assertStatus(302);
        }
        

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // la fecha de adquisicion vacia
        public function testCampoVacioFechaAdquisicion()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0007', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);

            $response->assertSessionHasErrors(['fechaAdquisicion']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // el provvedor vacio
        public function test_Validar_ControladorMaquinariaStoreNuevaMaquinariaConMaquinariaPropiaProveedorVacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0008', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => '',
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);

            $response->assertSessionHasErrors(['proveedor_id']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // la cantidad de Hora Alquilada vacio
        public function test_Validar_ControladorMaquinariaStoreNuevaMaquinariaConMaquinariaAlquiladaCantidadHoraAlquiladaVacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0008', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 1,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => 200, 
                'totalPagar' => 100,
            ]);

            $response->assertSessionHasErrors(['cantidadHoraAlquilada']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // el valor de la hora vacio
        public function test_Validar_ControladorMaquinariaStoreNuevaMaquinariaConMaquinariaAlquiladaValorHoraVacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0009', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 1,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => '', 
                'totalPagar' => 100,
            ]);

            $response->assertSessionHasErrors(['valorHora']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // el total a pagar vacio
        public function test_Validar_ControladorMaquinariaStoreNuevaMaquinariaConMaquinariaAlquiladaTotalPagarVacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Retroexcavadoras',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0006', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 1,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => '',
            ]);

            $response->assertSessionHasErrors(['totalPagar']); 
            $response->assertStatus(302);
        }
    
        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // doble espacio en el nombre de la maquinaria
        public function test_Validar_Controlador_maquinaria_con_doble_espacio_en_el_nombre_maquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de  Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['nombreMaquinaria']); // Verifica que haya error de validación en el nombre de la maquinaria
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // caracter especial en el nombre de la maquinaria
        public function test_Validar_Controlador_maquinaria_con_caracter_especial_en_el_nombre_maquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minic@rgador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['nombreMaquinaria']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria con
        // doble espacio en el modelo
        public function test_Validar_Controlador_maquinaria_con_doble_espacio_en_el_modelo()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora  MT975E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['modelo']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria 
        // para que la placa no tenga menos de 7 caracteres
        public function test_Validar_Controlador_maquinaria_con_la_placa_con_menos_de_7_caracteres()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['placa']);
            $response->assertStatus(302);
        }

        // Verificar que el campo de placa sea unico EN ESTE CASO NO PASA POR QUE LAS REGLAS 
        // EN EL CONTROLADOR NO LE PUESIERON EL UNIQUE (PERO EL MENSAJE SI ESTA)
        public function testCampoUnicoPlaca()
        {
            $user = User::factory()->create();
            $this->actingAs($user);

            // Crea una maquinaria existente con placa
            Maquinaria::factory()->create([
                'placa' => 'AAA003',
            ]);

            // Datos de la maquinaria a agregar
            $nuevaMaquinaria = [
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA003', //misma placa
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ];

            // Intenta agregar la maquinaria con la misma placa
            $response = $this->post('/maquinaria', $nuevaMaquinaria);

            // Verifica que la maquinaria no se agregó 
            $response->assertSessionHasErrors('placa');
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria 
        // para que la descripcion no tenga menos de 10 caracteres
        public function test_Validar_campo_descripcion_con_menos_de_10_caracteres()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA003', 
                'descripcion'       => 'Retro',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['descripcion']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria 
        // para que la descripcion no tenga mas de 150 caracteres
        public function test_Validar_campo_descripcion_con_mas_de_150_caracteres()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Retroexcavadora de color negro con azul con cuatro llantas que tienen detalles dorados en las puertashyfghvft ghgjk chdbkdbcsnc  hsdgtsjxas sgdgsjcbsgcs hsjhsuckbsjc hdgchcfdtghs sdyq7wdashbc',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['descripcion']); 
            $response->assertStatus(302);
        }

        
        // Validacion del controlador maquinaria para guardar una nueva maquinaria 
        // para que cantidad de Hora Alquilada no permita letras
        // NO ME FUNCIONA No reconoce el mensaje de error
        public function test_Validar_campo_cantidadHoraAlquiladaNoPermitaLetras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0005', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 'cin', 
                'valorHora' => 200, 
                'totalPagar' => 1000,
            ]);
            $response->assertSessionHasErrors(['cantidadHoraAlquilada']); 
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para guardar una nueva maquinaria 
        // para que cantidad de Hora Alquilada no permita letras
        // NO ME FUNCIONA No reconoce el mensaje de error
        public function test_Validar_campo_valorHoraNoPermitaLetras()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
    
            $response = $this->post('/maquinaria',[
                'nombreMaquinaria'   => 'Minicargador de Orugas',
                'modelo' => 'Retroexcavadora MT975E',
                'placa'  => 'AAA0005', 
                'descripcion'       => 'Retroexcavadora de color negro con azul',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 'cien', 
                'totalPagar' => '1000',
            ]);
            $response->assertSessionHasErrors(['valorHora']); 
            $response->assertStatus(302);
        }

        // Validacion de la ruta del controlador maquinaria para ver la maquinaria selecionado
        public function test_Validar_show_ruta()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->get('/maquinaria/108');
            $response->assertStatus(200);
        }

        // Validacion de la ruta del controlador maquinaria para ver la maquinaria selecionado
        public function test_Validar_show_rutaInvalida()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->get('/maquinaria/1089797');
            $response->assertStatus(404);
        }

        // Esto es para probar si al precionar el boton de atras en la vista de show me 
        // redirige al listado de maquinaria
         public function testNavegacionDesdeShowAlIndexMaquinaria()
        {
            $user = User::findOrFail(1);
            Auth::login($user); 
 
           $elementoId = 108; // ID del elemento que se selecciono
           $responseShow = $this->get(route('maquinaria.show', ['id' => $elementoId]));  
           $responseShow->assertStatus(200); // Verifica que la vista "show" se carga correctamente
           $responseIndex = $this->get(route('maquinaria.index'));
           $responseIndex->assertStatus(200); // Verifica que la vista "index" se carga correctamente
        }

        // Validación de la ruta edit de la maquinaria
        public function test_Validar_Controlador_proveedor_edit_ruta()
        {
          $user = User::findOrFail(1);
          Auth::login($user);
  
          $response = $this->get('/maquinaria/162/edit');
          $response->assertStatus(200);
        }

         // Validación de la ruta edit de la maquinaria invalida
        public function test_Validar_Controlador_proveedor_edit_ruta_invalida()
        {
           $user = User::findOrFail(1);
           Auth::login($user);
   
           $response = $this->get('/maquinaria/16256892938294623792/edit');
           $response->assertStatus(404);
        }

        // Validacion del controlador maquinaria para actualizar el nombre de la maquinaria de
       // Tractor a Excavadora
       public function test_Validar_Controlador_maquinaria_update_nombre_maquinaria()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('maquinaria/168/edit',[
                'nombreMaquinaria'   => 'Excavadora',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(168);
           $this->assertTrue($maquinaria1->nombreMaquinaria == 'Excavadora');
        }

        // Validacion del controlador maquinaria para actualizar el modelo de
       // Tractor MT875E a Excavadora MT875E
       public function test_Validar_Controlador_maquinaria_update_modelo()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('maquinaria/157/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Excavadora MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(157);
           $this->assertTrue($maquinaria1->modelo == 'Excavadora MT875E');
        }

        // Validacion del controlador maquinaria para actualizar la placa de
       // AAA0003 a BBA0004
       public function test_Validar_Controlador_maquinaria_update_placa()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('maquinaria/162/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'BBA0004', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(162);
           $this->assertTrue($maquinaria1->placa == 'BBA0004');
        }

        // Validacion del controlador maquinaria para actualizar la descripcion de
       // Tractor de color negro con verde a Tractor de color marillo
       public function test_Validar_Controlador_maquinaria_update_descripcion()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('maquinaria/147/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'BBA0004', 
                'descripcion'       => 'Tractor de color marillo',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(147);
           $this->assertTrue($maquinaria1->descripcion == 'Tractor de color marillo');
        }

        // Validacion del controlador maquinaria para actualizar la fecha de Adquisicion de
       // 01-08-2023 a 18-08-2023
       public function test_Validar_Controlador_maquinaria_update_fecha_de_adquisicion()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('maquinaria/118/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'BBA0004', 
                'descripcion'       => 'Tractor de color marillo',
                'fechaAdquisicion'    =>'18-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(118);
           $this->assertTrue($maquinaria1->fechaAdquisicion == '18-08-2023');
        }

        // Validacion del controlador maquinaria para actualizar la fecha de Adquisicion de
       // 2 a 3
       public function test_Validar_Controlador_maquinaria_update_proveedor_id()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('maquinaria/118/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'BBA0004', 
                'descripcion'       => 'Tractor de color marillo',
                'fechaAdquisicion'    =>'18-08-2023',
                'proveedor_id'       => 3,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 4, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(118);
           $this->assertTrue($maquinaria1->proveedor_id == 3);
        }

        // Validacion del controlador maquinaria para actualizar la cantidad Hora Alquilada de
       // 4 a 5
       public function test_Validar_Controlador_maquinaria_update_cantidadHoraAlquilada()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 5, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $maquinaria1 = Maquinaria::findOrFail(103);
           $this->assertTrue($maquinaria1->cantidadHoraAlquilada == 5);
        }

        // Validacion del controlador maquinaria para actualizar con
        // el nombre de la maquinaria vacio
        public function test_Validar_Controlador_maquinaria_update_con_nombre_maquinaria_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
       
            $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => '',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 5, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
            ]);
            $response->assertSessionHasErrors('nombreMaquinaria');
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para actualizar con
        // el modelo vacio
        public function test_Validar_Controlador_maquinaria_update_con_el_modelo_vacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);
       
            $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => '',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 5, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
            ]);
            $response->assertSessionHasErrors('modelo');
               $response->assertStatus(302);
        }

         // Validacion del controlador maquinaria para actualizar con
        // la descripcion vacio
        public function test_Validar_Controlador_maquinaria_update_con_la_descripcion_vacia()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => '',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 5, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $response->assertSessionHasErrors('descripcion');
           $response->assertStatus(302);
        }

         // Validacion del controlador maquinaria para actualizar con
        // la fecha Adquisicion vacia
        public function test_Validar_Controlador_maquinaria_update_con_la_fechaAdquisicion_vacia()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'',
                'proveedor_id'       => 2,
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 5, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $response->assertSessionHasErrors('fechaAdquisicion');
           $response->assertStatus(302);
        }

         // Validacion del controlador maquinaria para actualizar con
        // el proveedor_id vacio
        public function test_Validar_Controlador_maquinaria_update_con_elProveedor_id_vacio()
       {
           $user = User::findOrFail(1);
           Auth::login($user);

           $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>' 01-08-2023',
                'proveedor_id'       => '',
                'maquinaria' => 'alquilada',
                'cantidadHoraAlquilada' => 5, 
                'valorHora' => 200, 
                'totalPagar' => 1000,
           ]);
           $response->assertSessionHasErrors('proveedor_id');
           $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para actualizar una maquinaria con
        // doble espacio en el nombre de la maquinaria
        public function test_Validar_updateEn_el_nombre_maquinaria_con_doble_espacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor  Rect',
                'modelo' => 'Tractor MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['nombreMaquinaria']); // Verifica que haya error de validación en el nombre de la maquinaria
            $response->assertStatus(302);
        }

        // Validacion del controlador maquinaria para actualizar una maquinaria con
        // doble espacio en el modelo
        public function test_Validar_updateEn_el_modelo_con_doble_espacio()
        {
            $user = User::findOrFail(1);
            Auth::login($user);

            $response = $this->put('/maquinaria/103/edit',[
                'nombreMaquinaria'   => 'Tractor Rect',
                'modelo' => 'Tractor  MT875E',
                'placa'  => 'AAA0003', 
                'descripcion'       => 'Tractor de color negro con verde',
                'fechaAdquisicion'    =>'01-08-2023',
                'proveedor_id'       => 2,
                'maquinaria' => 'propia',
                'cantidadHoraAlquilada' => '', 
                'valorHora' => '', 
                'totalPagar' => '',
            ]);
            $response->assertSessionHasErrors(['modelo']); 
            $response->assertStatus(302);
        }

}
