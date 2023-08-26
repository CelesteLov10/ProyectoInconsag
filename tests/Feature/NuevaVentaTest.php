<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NuevaVentaTest extends TestCase
{
    public function test_166_registro_nueva_venta_sin_logueo()
    {

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

    public function test_167_registro_nueva_venta()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $response->assertRedirect(route('venta.index'));
    }

 public function test_168_registro_nueva_venta_cliente_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_169_registro_nueva_venta_cliente_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cliente_id' => 'El nombre del cliente es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_170_registro_nueva_venta_bloque_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_171_registro_nueva_venta_bloque_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'bloque_id' => 'El nombre del bloque es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_172_registro_nueva_venta_lote_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_173_registro_nueva_venta_lote_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'lote_id' => 'El nombre del lote es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_174_registro_nueva_venta_beneficiario_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_175_registro_nueva_venta_beneficiario_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'beneficiario_id' => 'El nombre del beneficiario es obligatorio, no puede estar vacío.'
        ]);
    }


    public function test_176_registro_nueva_venta_valorTerreno_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_177_registro_nueva_venta_cliente_id_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorTerreno' => 'El valore del terreno es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_178_registro_nueva_venta_valorTerreno_con_texto_sin_numeros()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_179_registro_nueva_venta_valorTerreno_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
            [
                'cliente_id'  => 1,
                'bloque_id'       => 1,
                'lote_id'       => 1,
                'beneficiario_id'       => 1,
                'valorTerreno'  => '',
                'casa_id'       => '',
                'total'       => 100000,
                'fechaVenta' => Carbon::now()->format('Y-m-d'),
                'valorPrima' => 1000,
                'cantidadCuotas' => 120,
                'valorCuotas' => 900,
                'valorRestantePagar' => 90000,
            ]
        );


        $response->assertValid([
            'valorTerreno' => 'Solo se permite números enteros. Ejem. "12345678"'
        ]);
    }



    public function test_180_registro_nueva_venta_total_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_181_registro_nueva_venta_total_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'total' => 'Debe dar click en calcular antes de guardar'
        ]);
    }

     public function test_182_registro_nueva_venta_fechaVenta_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_183_registro_nueva_venta_fechaVenta_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'fechaVenta' => 'La fecha de venta  es obligatoria, no puede estar vacío.'
        ]);
    }

    public function test_184_registro_nueva_venta_valorPrima_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_185_registro_nueva_venta_valorPrima_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorPrima' => 'El valor de prima es requerido'
        ]);
    }

    public function test_186_registro_nueva_venta_valorCuotas_enviar_texto()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }



    public function test_187_registro_nueva_venta_valorCuotas_enviar_texto_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorPrima' => 'Solo se permite números enteros. Ejem. "123456"'
        ]);
    }

    public function test_188_registro_nueva_venta_cantidadCuotas_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_189_registro_nueva_venta_cantidadCuotas_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cantidadCuotas' => 'Solo se permite números enteros. Ejem. "12345"'
        ]);
    }

    public function test_190_registro_nueva_venta_cantidadCuotas_cantidad_minima_120()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_191_registro_nueva_venta_cantidadCuotas_cantidad_minima_120_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cantidadCuotas' => 'La cantidad de cuotas mínima es "120 meses". '
        ]);
    }

    public function test_192_registro_nueva_venta_cantidadCuotas_cantidad_minima_240()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_193_registro_nueva_venta_cantidadCuotas_cantidad_minima_240_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'cantidadCuotas' => 'La cantidad de cuotas máxima es "240 meses" '
        ]);
    }


    public function test_194_registro_nueva_venta_valorCuotas_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_195_registro_nueva_venta_valorCuotas_vacio_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorCuotas' => 'El valor de la cuota es obligatorio, no puede estar vacío.'
        ]);
    }

    public function test_196_registro_nueva_venta_valorCuotas_valor_cero()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $this->assertFalse(isset($venta[0]->id));
    }

    public function test_197_registro_nueva_venta_valorCuotas_valor_cero_mensaje_validacion()
    {
        $user = User::find(1);
        Auth::login($user);

        DB::delete('delete from ventas where fechaVenta = ?',[Carbon::now()->format('Y-m-d')]);
        $response = $this->post(
            route('venta.store'),
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

        $venta = Venta::where('fechaVenta','=',Carbon::now()->format('Y-m-d'))->get();

        $response->assertValid([
            'valorCuotas' => 'El valor de la cuota es obligatorio, no puede estar vacío.'
        ]);
    }
}
