<?php
namespace Tests\Feature;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ValidacionesEmpleadosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//IDENTIDAD
     public function test_Validar_Controlador_empleado_store_nuevo_empleado_identidad_con_letras()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->post('/empleado',[
             'identidad' => 'ghsdhgyoudgsydvs',
             'nombres'   => 'Eva',
             'apellidos' => 'Herrera',
             'telefono'  => '88835812',
             'correo'    => '',
             'fechaNacimiento' => '25-09-2001',
             'direccion'       => 'Cuyali',
             'fechaIngreso'    => '29-08-2023',
             'puesto_id'       => 1,
             'oficina_id'       => 1,
             'estado_id'       => 2,
         ]);
 
 
         $response->assertStatus(302);
     }

     public function test_Validar_Controlador_empleado_store_nuevo_empleado_identidad_con_14_numeros()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->post('/empleado',[
             'identidad' => '07042001006841',
             'nombres'   => 'Eva',
             'apellidos' => 'Herrera',
             'telefono'  => '88835812',
             'correo'    => '',
             'fechaNacimiento' => '25-09-2001',
             'direccion'       => 'Cuyali',
             'fechaIngreso'    => '29-08-2023',
             'puesto_id'       => 1,
             'oficina_id'       => 1,
             'estado_id'       => 2,
         ]);
 
 
         $response->assertStatus(302);
     }

     public function test_Validar_Controlador_empleado_store_nuevo_empleado_identidad_vacia()
     {
         $user = User::findOrFail(1);
         Auth::login($user);
 
         $response = $this->post('/empleado',[
             'identidad' => '',
             'nombres'   => 'Eva',
             'apellidos' => 'Herrera',
             'telefono'  => '88835812',
             'correo'    => '',
             'fechaNacimiento' => '25-09-2001',
             'direccion'       => 'Cuyali',
             'fechaIngreso'    => '29-08-2023',
             'puesto_id'       => 1,
             'oficina_id'       => 1,
             'estado_id'       => 2,
         ]);
 
 
         $response->assertStatus(302);
     }

//NOMBRE
public function test_Validar_Controlador_empleado_store_nuevo_empleado_nombre_con_numeros()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => '4567888',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
}

public function test_Validar_Controlador_empleado_store_nuevo_empleado_nombre_con_minuscula()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
}

public function test_Validar_Controlador_empleado_store_nuevo_empleado_nombre_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => '',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
}

//APELLIDO
public function test_Validar_Controlador_empleado_store_nuevo_empleado_apellido_con_numeros()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => '88889990',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
}

public function test_Validar_Controlador_empleado_store_nuevo_empleado_apellido_con_minuscula()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'herrera',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
}

public function test_Validar_Controlador_empleado_store_nuevo_empleado_apellido_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => '',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
}


//TELEFONO

public function test_Validar_Controlador_empleado_store_nuevo_empleado_telefono_con_codigo_regional_2_3_8_9()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '49809007',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
} 

public function test_Validar_Controlador_empleado_store_nuevo_empleado_telefono_con_letras()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => 'ujojhgggh',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
} 

//ESTADO

public function test_Validar_Controlador_empleado_store_nuevo_empleado_estado_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

// CORREO

public function test_Validar_Controlador_empleado_store_nuevo_empleado_correo_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => '',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 
public function test_Validar_Controlador_empleado_store_nuevo_empleado_correo_sin_arroba()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7gmail.com',
        'fechaNacimiento' => '25-09-2001',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

//FECHA DE NACIMIENTO

public function test_Validar_Controlador_empleado_store_nuevo_empleado_fecha_de_nacimiento_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

public function test_Validar_Controlador_empleado_store_nuevo_empleado_fecha_de_nacimiento_con_formato_y_m_d()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '2000-04-28',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

public function test_Validar_Controlador_empleado_store_nuevo_empleado_fecha_de_nacimiento_menor_de_edad()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '2008-04-28',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 


//DIRECCION
public function test_Validar_Controlador_empleado_store_nuevo_empleado_direccion_vacia()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '2000-04-28',
        'direccion'       => '',
        'fechaIngreso'    => '29-08-2023',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

//FECHA DE INGRESO

public function test_Validar_Controlador_empleado_store_nuevo_empleado_fecha_de_ingreso_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '29-08-2000',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

public function test_Validar_Controlador_empleado_store_nuevo_empleado_fecha_de_ingreso_con_formato_y_m_d()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '2000-04-28',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '2023-09-28',
        'puesto_id'       => 1,
        'oficina_id'       => 1,
        'estado_id'       => '',
    ]);


    $response->assertStatus(302);
} 

//ENCARGADO
public function test_Validar_Controlador_empleado_store_nuevo_empleado_encargado_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '29-08-2000',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '',
        'puesto_id'       => '',
        'oficina_id'       => 1,
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
} 


//OFICINA
public function test_Validar_Controlador_empleado_store_nuevo_empleado_oficina_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/empleado',[
        'identidad' => '0704200100684',
        'nombres'   => 'Eva',
        'apellidos' => 'Herrera',
        'telefono'  => '88835812',
        'correo'    => 'evamaria7@gmail.com',
        'fechaNacimiento' => '29-08-2000',
        'direccion'       => 'Cuyali',
        'fechaIngreso'    => '',
        'puesto_id'       => 1,
        'oficina_id'       => '',
        'estado_id'       => 2,
    ]);


    $response->assertStatus(302);
} 
}