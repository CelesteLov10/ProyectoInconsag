<?php
        
namespace Tests\Feature;

use App\Models\User;
use App\Models\Planilla;
use App\Models\Tablaplanilla;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PlanillaControllerTest extends TestCase
{
        /*
        |--------------------------------------------------------------------------
        |  Elaboradas por Sucelinda Valladares Flores
        |--------------------------------------------------------------------------
        */
    /*
    |--------------------------------------------------------------------------
    |  Pruebas para planilla
    |--------------------------------------------------------------------------
    */ 

    // Validación de la ruta index con el metodo get de la planilla
    public function test_Validar_ruta_planilla_index()
    {
       $user = User::findOrFail(1);
       Auth::login($user);
        $response = $this->get('/planilla');
        $response->assertStatus(200);
    }

    // Validación de la ruta index con el metodo get de la planilla invalida
    public function test_Validar_ruta_planilla_index_valor_invalida()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
        $response = $this->get('/planilla345765');
        $response->assertStatus(404);
    }

    //Acceder a la ruta de Listado del planilla GET
    public function test_Validar_listado_planilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        //realiza una solicitud GET a la ruta de Listado de planillas
        $response = $this->actingAs($user)->get('/planilla');
        $response->assertStatus(200);
        $response->assertSee('Listado de planillas');  // Verificar que la vista contiene el título "Listado de planillas"
        $response->assertSee('Seleccione la fecha que desea buscar');
        $response->assertSee('Registrar planilla'); 
        $response->assertSee('Fecha:');
        $response->assertSee('Número de empleados:');
        $response->assertSee('Total de la planilla:');
        $response->assertSee('Detalles de la planilla:');
        $response->assertSee('Imprimir planilla:');
    }

    // Validacion para Acceder al boton Registrar planilla en el istado de planillas
   public function test_Validar_boton_Registrar_planilla_en_Listado_planillas()
   {
        $user = User::findOrFail(1);
        Auth::login($user);
        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/planilla');

        // Hacer clic en el botón y seguir la redirección
        $response = $this->followingRedirects()->actingAs($user)->get(route('planilla.create'));
        $response->assertSee('Registro de planilla'); //Muestra titulo de la ventana de Registro de planilla.
         // Verifica que se redirige correctamente a la ruta
         $response->assertStatus(200);
    }

    // Validacion para Acceder al boton Detalles de la planilla en el istado de planillas
    public function test_Validar_boton_Detalles_de_la_planilla_en_Listado_planillas()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        // Realiza una solicitud GET a la vista donde se encuentra el botón
        $response = $this->actingAs($user)->get('/planilla');
        $response->assertStatus(200);
    
        // Hacer clic en el botón de Detalles de la planilla  y seguir la redirección
        $response = $this->followingRedirects()->get('/tablaplanilla/1');
    
        // Verifica que se redirige correctamente a la ruta de ver de la tabla de la planilla
        $response->assertStatus(200);
        // Verificar que la vista contiene los datos
        $response->assertSee('Detalles de la planilla');
        $response->assertSee('Atrás');
        $response->assertSee('Detalles de la planilla');
        $response->assertSee('Fecha:');
        $response->assertSee('Identidad del empleado');
        $response->assertSee('Nombre del empleado');
        $response->assertSee('Puesto laboral');
        $response->assertSee('Sueldo');
        $response->assertSee('Días que trabajo');
        $response->assertSee('Total');
        $response->assertSee('Total planilla:');
        $response->assertSee('Total empleados:');
    }

    // Esto es para probar si al precionar el boton de atras en la vista de show me 
    // redirige al listado de planilla
    public function testNavegacionDesdeElShowAlIndexPlanilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user); 
    
        $elementoId = 1; // ID del elemento que se selecciono
        $responseShow = $this->get(route('tablaplanilla.show', ['id' => $elementoId]));
        $responseShow->assertStatus(200); // Verifica que la vista "show" se carga correctamente
        $responseIndex = $this->get(route('planilla.index'));
        $responseIndex->assertStatus(200); // Verifica que la vista "index" se carga correctamente
    }

    // Esto es para probar si al precionar el boton de inprimir en el listado de planilla me 
    // genera el pdf de la planilla
    public function testGenerarPdfPlanilla()
    {
        $user = User::findOrFail(1);
        Auth::login($user); 

        $elementoId = 1; // ID del elemento que se selecciono
        $response = $this->get(route('tablaplanilla.pdf', ['id' => $elementoId]));
        // Verifica que la respuesta de la solicitud tenga el código de respuesta HTTP 200 (OK)
        $response->assertOk();
        // Verifica que la respuesta sea un PDF (puedes ajustar esto según cómo se genera el PDF)
        $response->assertHeader('Content-Type', 'application/pdf');

    }
        /*
        |--------------------------------------------------------------------------
        |  Hasta aqui termina Sucelinda Valladares Flores
        |--------------------------------------------------------------------------
        */
}

