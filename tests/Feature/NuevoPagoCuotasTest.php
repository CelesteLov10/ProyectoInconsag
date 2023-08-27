<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class NuevoPagoCuotasTest extends TestCase
{
    public function test_88_nuevo_pago_por_lote_antes_de_logueo()
    {
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.create', ['id' => $pago->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_89_nuevo_pago_por_lote_despues_de_logueo()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.create', ['id' => $pago->id]));
        $response->assertStatus(200);
    }

    public function test_90_nuevo_pago_por_lote_id_negativo()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.create', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_91_nuevo_pago_por_lote_id_texto()
    {
        $user = User::find(1);
        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.create', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_92_nuevo_pago_por_lote_id_decimales()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.create', ['id' => 90.898]));
        $response->assertStatus(404);
    }

    public function test_93_nuevo_pago_por_lote_con_etiqueta_correcta()
    {
        $user = User::find(1);

        Auth::login($user);
        $pago = Pago::all()->first();

        $response = $this->get(route('pago.create', ['id' => $pago->id]));
        $response->assertSeeText('Pago de lote');
    }




    public function test_94_registro_pago_por_lote_sin_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_95_registro_pago_por_lote_con_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertRedirect(route('pago.index'));
    }

    public function test_96_registro_pago_por_lote_columna_venta_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where cliente_id = ? and lote_id = ?', [$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => '',
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_97_registro_pago_por_lote_columna_venta_id_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where cliente_id = ? and lote_id = ?', [$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => '',
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertInvalid([
            'venta_id' => ' venta id es obligatorio.',
        ]);
    }

    public function test_98_registro_pago_por_lote_columna_cliente_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and lote_id = ?', [$venta->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => '',
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_99_registro_pago_por_lote_columna_cliente_id_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and lote_id = ?', [$venta->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => '',
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertInvalid([
            'cliente_id' => ' cliente id es obligatorio.',
        ]);
    }

    public function test_100_registro_pago_por_lote_columna_lote_id_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ?', [$venta->id,$cliente->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => '',
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_101_registro_pago_por_lote_columna_lote_id_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ?', [$venta->id,$cliente->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => '',
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertInvalid([
            'lote_id' => ' lote id es obligatorio.',
        ]);
    }

    public function test_102_registro_pago_por_lote_columna_fechaPago_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_103_registro_pago_por_lote_columna_fechaPago_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertInvalid([
            'fechaPago' => ' fecha pago es obligatorio.',
        ]);
    }

    public function test_104_registro_pago_por_lote_columna_cantidadCuotasPagar_vacio()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => '',
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_105_registro_pago_por_lote_columna_cantidadCuotasPagar_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => '',
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'cantidadCuotasPagar' => 'La cantidad de cuotas es obligatoria, no puede estar vacío.',
        ]);
    }


    public function test_106_registro_pago_por_lote_columna_cantidadCuotasPagar_contener_8_digitos()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 9090909090909090990,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_107_registro_pago_por_lote_columna_cantidadCuotasPagar_contener_8_digitos_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 9090909090909090990,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'cantidadCuotasPagar' => 'La cantidad de cuotas debe contener 8 dígitos.',
        ]);
    }

    public function test_108_registro_pago_por_lote_columna_cantidadCuotasPagar_cantidad_minimo_1()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 0,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_109_registro_pago_por_lote_columna_cantidadCuotasPagar_cantidad_minimo_1_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 0,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'cantidadCuotasPagar' => 'La cantidad de cuotas debe ser 1 como minimo.',
        ]);
    }

    public function test_110_registro_pago_por_lote_columna_cantidadCuotasPagar_cantidad_maximo_6()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 8,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_111_registro_pago_por_lote_columna_cantidadCuotasPagar_cantidad_maximo_6_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 8,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'cantidadCuotasPagar' => 'La cantidad de cuotas debe ser 6 como máximo.',
        ]);
    }

    public function test_112_registro_pago_por_lote_columna_cantidadCuotasPagar_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 'asdasd',
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_113_registro_pago_por_lote_columna_cantidadCuotasPagar_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 'asdasd',
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'cantidadCuotasPagar' => "El formato del  cantidad cuotas pagar es inválido."
        ]);
    }

    public function test_114_registro_pago_por_lote_columna_cuotaPagar_vacio()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 'asdasd',
                'cuotaPagar' => '',
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_115_registro_pago_por_lote_columna_cuotaPagar_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                 'cantidadCuotasPagar' => 4,
                'cuotaPagar' => '',
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'cuotaPagar' => "La cuota a pagar es obligatorio, no puede estar vacío."
        ]);
    }

    public function test_116_registro_pago_por_lote_columna_saldoEnCuotas_vacio()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => '',
                'valorTerrenoPagar' => 20000,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_117_registro_pago_por_lote_columna_saldoEnCuotas_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => '',
                'valorTerrenoPagar' => 20000,
            ]
        );


        $response->assertInvalid([
            'saldoEnCuotas' => "El saldo en cuotas es obligatorio, no puede estar vacío."
        ]);
    }

    public function test_118_registro_pago_por_lote_columna_valorTerrenoPagar_vacio()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_119_registro_pago_por_lote_columna_valorTerrenoPagar_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => '',
            ]
        );


        $response->assertInvalid([
            'valorTerrenoPagar' => "El valor terreno a pagar es obligatorio, no puede estar vacío."
        ]);
    }

    public function test_120_registro_pago_por_lote_columna_valorTerrenoPagar_cantidad_minima_1()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => 0,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_121_registro_pago_por_lote_columna_valorTerrenoPagar_cantidad_minima_1_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => -1,
            ]
        );

        $response->assertInvalid([
            'valorTerrenoPagar' => "El saldo pendiente debe ser 1 como minimo."
        ]);
    }

    public function test_122_registro_pago_por_lote_columna_valorTerrenoPagar_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);


        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => -1,
            ]
        );

        $response->assertStatus(302);
    }

    public function test_123_registro_pago_por_lote_columna_valorTerrenoPagar_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $venta = Venta::all()->first();
        $cliente = Cliente::all()->first();
        $lote = Lote::all()->first();
        DB::delete('delete from pagos where venta_id = ? and cliente_id = ? and lote_id = ?', [$venta->id,$cliente->id,$lote->id]);

        $response = $this->post(
            route('pago.store'),
            [
                'venta_id' => $venta->id,
                'cliente_id' => $cliente->id,
                'lote_id' => $lote->id,
                'fechaPago' => '2023-08-25',
                'cantidadCuotasPagar' => 4,
                'cuotaPagar' => 500,
                'saldoEnCuotas' => 1500,
                'valorTerrenoPagar' => -1,
            ]
        );

        $response->assertInvalid([
            'valorTerrenoPagar' => "El saldo pendiente no debe ser negativo."
        ]);
    }
}
