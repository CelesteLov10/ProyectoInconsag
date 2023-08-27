<?php
namespace Tests\Feature;
use App\Models\User;
use App\Models\Planilla;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PlanillaTest extends TestCase
{


    public function test_Validar_Controlador_planilla_store_nueva_planilla_agregando_empleado()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'fecha'  => '30-09-2023',
            'dias'  => 30,
            'empleado_id' => 2,
            'total' => 28235.00,
      
        ]);


        // Traerme el inventario que se registro
        $planilla = Planilla::where('empleado_id','=', 2)->get();

        // comprueba si me trajo el inventario, con la funcion count cuenta los registros si es 1 esque si lo registro
        $this->assertTrue(  count( $planilla) == 1 );

    }

    public function test_Validar_Controlador_planilla_store_nueva_planilla_agregando_empleado_repetido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'fecha'  => '31-08-2023',
            'dias'  => 30,
            'empleado_id' => 1,
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);

    }

    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_fecha_vacia()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'fecha'  => '',
            'dias'  => 30,
            'empleado_id' => 1,
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);

    }

    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_fecha_diferente_al_ultimo_dia_del_mes()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'fecha'  => '22-08-2023',
            'dias'  => 30,
            'empleado_id' => 1,
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);

    }



    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_dias_mayor_a_30()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'dias'  => 31,
            'empleado_id' => 1,
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);



    }
    

    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_dias_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'dias'  => '',
            'empleado_id' => 1,
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);

    }


    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_empleado_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'dias'  => 30,
            'empleado_id' => '',
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);

    }

    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_empleado_que_no_existe()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'dias'  => 30,
            'empleado_id' => 200,
            'total' => 28235.00,
      
        ]);

        $response->assertStatus(302);

    }

    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_total_vacio()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'dias'  => 30,
            'empleado_id' => 1,
            'total' => '',
      
        ]);

        $response->assertStatus(302);

    }

    public function test_Validar_Controlador_planilla_store_nueva_planilla_con_total_invalido()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->post('/planilla',[
            'dias'  => 31,
            'empleado_id' => 1,
            'total' => 28237777,
      
        ]);

        $response->assertStatus(302);

    }


}
