<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NuevoBeneficiarioTest extends TestCase
{
    public function test_1_registro_nueva_beneficiario_sin_logueo()
    {

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $response->assertRedirect(route('login'));
    }

    public function test_2_registro_nueva_beneficiario()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $response->assertRedirect(route('Venta.index'));
    }

    public function test_3_registro_nueva_beneficiario_cliente_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => '',
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_4_registro_nueva_beneficiario_cliente_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => '',
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cliente_id' => 'El nombre del cliente es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_5_registro_nueva_beneficiario_bloque_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => '',
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_6_registro_nueva_beneficiario_bloque_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => '',
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'bloque_id' => 'El nombre del bloque es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_7_registro_nueva_beneficiario_lote_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => '',
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_8_registro_nueva_beneficiario_lote_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => '',
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'lote_id' => 'El nombre del lote es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_9_registro_nueva_beneficiario_beneficiario_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => '',
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_10_registro_nueva_beneficiario_beneficiario_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => '',
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'beneficiario_id' => 'El nombre del beneficiario es obligatorio, no puede estar vacío.'
        ]);
    }


    public function test_11_registro_nueva_beneficiario_valorTerreno_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => '',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_12_registro_nueva_beneficiario_cliente_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => '',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorTerreno' => 'El valore del terreno es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_13_registro_nueva_beneficiario_valorTerreno_con_texto_sin_numeros()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 'valor_terreno',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_14_registro_nueva_beneficiario_valorTerreno_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 'valor_terreno',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorTerreno' => 'Solo se permite números enteros. Ejem. "12345678"'
        ]);
    }

    public function test_14_registro_nueva_beneficiario_cliente_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => '3123.12323.123',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_15_registro_nueva_beneficiario_valorTerreno_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => '3123.12323.123',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorTerreno' => 'El valor es incorrecto. Ejem. "123"'
        ]);
    }


    public function test_16_registro_nueva_beneficiario_valorTerreno_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 0,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_17_registro_nueva_beneficiario_valorTerreno_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 0,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorTerreno' => 'La cantidad de hora alquilada mínima es "1". '
        ]);
    }

    public function test_18_registro_nueva_beneficiario_total_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => '',
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_19_registro_nueva_beneficiario_total_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => '',
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'total' => 'Debe dar click en calcular antes de guardar'
        ]);
    }

    public function test_20_registro_nueva_beneficiario_fechaVenta_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => '',
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_21_registro_nueva_beneficiario_fechaVenta_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => '',
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'fechaVenta' => 'La fecha de Venta  es obligatoria, no puede estar vacío.'
        ]);
    }

    public function test_22_registro_nueva_beneficiario_valorPrima_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => '',
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_23_registro_nueva_beneficiario_valorPrima_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => '',
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorPrima' => 'El valor de prima es requerido'
        ]);
    }

    public function test_24_registro_nueva_beneficiario_valorCuotas_enviar_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 'hola',
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_25_registro_nueva_beneficiario_valorCuotas_enviar_texto_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 'hola',
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorPrima' => 'Solo se permite números enteros. Ejem. "123456"'
        ]);
    }

    public function test_26_registro_nueva_beneficiario_cantidadCuotas_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => '',
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_27_registro_nueva_beneficiario_cantidadCuotas_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => '',
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cantidadCuotas' => 'Solo se permite números enteros. Ejem. "12345"'
        ]);
    }

    public function test_28_registro_nueva_beneficiario_cantidadCuotas_cantidad_minima_120()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 100,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_29_registro_nueva_beneficiario_cantidadCuotas_cantidad_minima_120_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 100,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cantidadCuotas' => 'La cantidad de cuotas mínima es "120 meses". '
        ]);
    }

    public function test_30_registro_nueva_beneficiario_cantidadCuotas_cantidad_minima_240()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 300,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_31_registro_nueva_beneficiario_cantidadCuotas_cantidad_minima_240_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 300,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cantidadCuotas' => 'La cantidad de cuotas máxima es "240 meses" '
        ]);
    }


    public function test_32_registro_nueva_beneficiario_valorCuotas_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => '',
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_33_registro_nueva_beneficiario_valorCuotas_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => '',
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorCuotas' => 'El valor de la cuota es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_34_registro_nueva_beneficiario_valorCuotas_valor_cero()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 0,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($Venta[0]->id));
    }

    public function test_35_registro_nueva_beneficiario_valorCuotas_valor_cero_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from beneficiarios where fechaVenta = ?', [Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('Venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'       => 9000,
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 0,
                'valorRestantePagar' => 90000,
            ]
        );

        $Venta = Venta::where('fechaVenta', '=', Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorCuotas' => 'El valor de la cuota es obligatorio, no puede estar vacío.'
        ]);
    }
}
