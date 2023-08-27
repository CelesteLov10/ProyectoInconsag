<?php

namespace Tests\Feature;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EditarEmpleadosTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


public function test_Validar_Controlador_empleado_update_empleado_identidad()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100682',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '89809007',
            'correo'    => 'evamaria7@gmail.com',
            'fechaNacimiento' => '25-09-2001',
            'direccion'       => 'Cuyali el paraiso honduras',
            'fechaIngreso'    => '29-08-2023',
            'puesto_id'       => 1,
            'oficina_id'       => 1,
            'estado_id'       => 2,
        ]);

        // Traerme el empledo que esta registrado
        $empleado = Empleado::findOrFail(6);

        // comprueba si me trajo el empledo, y comparo el resultado de la consulta con el valor que yo ingrese a editar
        $this->assertTrue($empleado->identidad == '0704200100682
        ');

        // $response->assertStatus(200);
    }

    public function test_Validar_Controlador_empleado_update_empleado_identidad_repetida_con_otro_usuario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '3136253259655',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '89809007',
            'correo'    => 'evamaria7@gmail.com',
            'fechaNacimiento' => '25-09-2001',
            'direccion'       => 'Cuyali el paraiso honduras',
            'fechaIngreso'    => '29-08-2023',
            'puesto_id'       => 1,
            'oficina_id'       => 1,
            'estado_id'       => 2,
        ]);

        // Traerme el empledo que esta registrado
        $empleado = Empleado::findOrFail(6);

        // comprueba si me trajo el empledo, y comparo el resultado de la consulta con el valor que yo ingrese a editar
        // $this->assertFalse($empleado->identidad == '5294836805022');

        $this->assertTrue($empleado->identidad == '0704200100682');

        // $response->assertStatus(200);
    }

    public function test_Validar_Controlador_empleado_update_empleado_telefono_con_codigo_regional_2_3_8_9()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
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

    public function test_Validar_Controlador_empleado_update_empleado_con_identidad_vacia()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '',
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

    public function test_Validar_Controlador_empleado_update_empleado_con_nombres_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => '',
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

    
    public function test_Validar_Controlador_empleado_update_empleado_con_apellidos_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => '',
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

       
    public function test_Validar_Controlador_empleado_update_empleado_con_telefono_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '',
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

    public function test_Validar_Controlador_empleado_update_empleado_con_correo_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
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
            'estado_id'       => 2,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_empleado_update_empleado_con_fecha_de_nacimiento_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
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
            'estado_id'       => 2,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_empleado_update_empleado_con_direccion_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '',
            'correo'    => 'evamaria7@gmail.com',
            'fechaNacimiento' => '25-09-2001',
            'direccion'       => '',
            'fechaIngreso'    => '29-08-2023',
            'puesto_id'       => 1,
            'oficina_id'       => 1,
            'estado_id'       => 2,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_empleado_update_empleado_con_fecha_ingreso_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '',
            'correo'    => 'evamaria7@gmail.com',
            'fechaNacimiento' => '25-09-2001',
            'direccion'       => 'Cuyali',
            'fechaIngreso'    => '',
            'puesto_id'       => 1,
            'oficina_id'       => 1,
            'estado_id'       => 2,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_empleado_update_empleado_con_puesto_id_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '',
            'correo'    => 'evamaria7@gmail.com',
            'fechaNacimiento' => '25-09-2001',
            'direccion'       => 'Cuyali',
            'fechaIngreso'    => '29-08-2023',
            'puesto_id'       => '',
            'oficina_id'       => 1,
            'estado_id'       => 2,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_empleado_update_empleado_con_oficina_id_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '',
            'correo'    => 'evamaria7@gmail.com',
            'fechaNacimiento' => '25-09-2001',
            'direccion'       => 'Cuyali',
            'fechaIngreso'    => '29-08-2023',
            'puesto_id'       => 1,
            'oficina_id'       => '',
            'estado_id'       => 2,
        ]);


        $response->assertStatus(302);
    } 

    public function test_Validar_Controlador_empleado_update_empleado_con_estado_id_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->put('/empleado/6/edit',[
            'identidad' => '0704200100684',
            'nombres'   => 'Eva',
            'apellidos' => 'Herrera',
            'telefono'  => '',
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

    public function test_Validar_ruta_del_boton_atras_de_editar_de_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleado');
        $response->assertStatus(200);
    }


    public function test_Validar_ruta_invalida_del_boton_atras_de_editar_de_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/empleadosss');
        $response->assertStatus(404);
    }
}
