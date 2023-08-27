<?php
namespace Tests\Feature;
use App\Models\User;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ValidacionesGastoTest extends TestCase
{
    public function test_Validar_Controlador_nuevo_registro_de_datos_con_nombreGastos_con_numeros()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'777777777777777777',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}

public function test_Validar_Controlador_nuevo_registro_de_datos_con_nombreGastos_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}
public function test_Validar_Controlador_nuevo_registro_de_datos_con_montoGasto_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> '',
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}
public function test_Validar_Controlador_nuevo_registro_de_datos_montoGasto_con_numeros_negativos()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> -200,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}

public function test_Validar_Controlador_nuevo_registro_de_datos_con_nombreEmpresa_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}

public function test_Validar_Controlador_nuevo_registro_de_datos__nombreEmpresa_con_numeros()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'66666666666',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);
}

    public function test_Validar_Controlador_nuevo_registro_de_datos_con_Fechagasto_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);
    
        $response = $this->post('/gasto',[
            'nombreGastos'=>'equipo',
            'montoGastos'=> 1000,
            'nombreEmpresa'=>'Sepcom',
            'fechaGastos'=>'',
            'descripcion' =>'compra de eqipos',
            'empleado_id' => 1,
            'baucherRecibo' => 'recibo.jpg',
      
        ]);
    
      
        $response->assertStatus(302);
    
    }

    public function test_Validar_Controlador_nuevo_registro_de_datos_fechaGasto_anterior_a_actual()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'22-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(500);

}
public function test_Validar_Controlador_nuevo_registro_de_datos_con_descripcion_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}

public function test_Validar_Controlador_nuevo_registro_de_datos_con_empleado_id_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => '',
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

  
    $response->assertStatus(302);

}

public function test_Validar_Controlador_nuevo_registro_de_datos_con_baucherRecibo_vacio()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'equipo',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra de eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => '',
  
    ]);

  
    $response->assertStatus(302);

}
}

























