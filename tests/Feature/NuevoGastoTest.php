<?php
namespace Tests\Feature;
use App\Models\User;
use App\Models\Gasto;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class NuevoGastoTest extends TestCase
{
   
public function test_Validar_Controlador_gasto_nuevo_registro_de_gasto()
{
    $user = User::findOrFail(1);
    Auth::login($user);

    $response = $this->post('/gasto',[
        'nombreGastos'=>'gastos operativos',
        'montoGastos'=> 1000,
        'nombreEmpresa'=>'Sepcom',
        'fechaGastos'=>'24-08-2023',
        'descripcion' =>'compra eqipos',
        'empleado_id' => 1,
        'baucherRecibo' => 'recibo.jpg',
  
    ]);

    // Traerme el inventario que se registro
    $gasto = Gasto::where('nombreGastos','=','gastos operativos')->get();

    // comprueba si me trajo el inventario, con la funcion count cuenta los registros si es 1 esque si lo registro
    $this->assertTrue(  count( $gasto) == 1 );

}
}