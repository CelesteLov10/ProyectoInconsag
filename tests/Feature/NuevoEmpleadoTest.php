<?php

namespace Tests\Feature;

use App\Models\Casa;
use App\Models\User;
use App\Models\Puesto;
use App\Models\Oficina;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;


class NuevoEmpleadoTest extends TestCase
{ 


/*********************************************************************  NUEVO EMPLEADO  ***************************************************************/
/*historia de: Nuevo empleado validaciones y todo lo demas, le toco a mi otra compañera*/ 


//Acceder a la rutas con usuario valido
public function test_Validar_ruta()
{
    $response = $this->get('/');
    $response->assertStatus(200);
}


//Acceder la rutas con usuario valido
public function test_Validar_ruta_invalida()
{
    $response = $this->get('/455646546');
    $response->assertStatus(404);
}

//Validar ruta create del empleado  (metodo get) 
public function test_Validar_controller_empleado_create()
{
$user = User::findOrFail(2);
Auth::login($user);
$response = $this->get('/empleado/create');
$response->assertStatus(200);
}

// Validar ruta del empleado  create con datos incorrectos (metodo get)
public function test_Validar_controller_empleado_create_Con_Valores_incorrectos()
{
$user = User::findOrFail(2);
Auth::login($user);
$response = $this->get('/7767HH');
$response->assertStatus(404);
}

}