<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;



class ValidacionClienteTest extends TestCase
{
    public function test_124_actualizar_cliente_antes_de_logueo()
    {
        $cliente = Cliente::all()->first();

        $response = $this->get(route('cliente.edit',['id'=>$cliente->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_125_actualizar_cliente_despues_de_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::all()->first();

        $response = $this->get(route('cliente.edit',['id'=>$cliente->id]));
        $response->assertStatus(200);
    }


    public function test_126_actualizar_cliente_vista_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::all()->first();

        $response = $this->get(route('cliente.edit',['id'=>$cliente->id]));
        $response->assertViewIs('cliente.edit');
    }

    public function test_127_actualizar_cliente_con_etiquetas_correctas()
    {
        $user = User::find(1);
        Auth::login($user);
        $cliente = Cliente::all()->first();

        $response = $this->get(route('cliente.edit',['id'=>$cliente->id]));
        $response->assertSeeText('Actualización');
    }

    public function  test_128_actualizar_cliente_con_etiquetas_correctas_direccion()
    {
        $user = User::find(1);
        Auth::login($user);
        $cliente = Cliente::all()->first();

        $response = $this->get(route('cliente.edit',['id'=>$cliente->id]));
        $response->assertSeeText($cliente->direccion);
    }

    public function test_129_actualizar_cliente_sin_logueo()
    {
        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '1995-08-25',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => $cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertRedirect(route('login'));
        $cliente->delete();
    }

    public function test_130_actualizar_cliente_con_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => $cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertRedirect(route('cliente.index'));
        $cliente->delete();
    }

    public function test_131_actualizar_cliente_validar_campo_identidadC_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => '',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => $cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertStatus(302);
        $cliente->delete();
    }

    public function test_132_actualizar_cliente_validar_campo_identidadC_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => '',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertInvalid([
            'identidadC'=>'El número de identidad es obligatorio, no puede estar vacío.',
        ]);

        $cliente->delete();
    }

    public function test_133_actualizar_cliente_validar_campo_identidadC_digits()
    {  $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => '78789797897897987987987987987987987987987',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertStatus(302);
        $cliente->delete();
    }

    public function test_134_actualizar_cliente_validar_campo_identidadC_digits_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => '78789797897897987987987987987987987987987',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $response->assertInvalid([
            'identidadC' => 'El formato para el número de identidad no es válido.',
        ]);
        $cliente->delete();
    }


    public function test_135_actualizar_cliente_validar_campo_identidadC_unico()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $cliente2 = Cliente::create([
            'identidadC' => '080119951111',
            'nombreCompleto' => 'Manuel',
            'telefono' => '98889898',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente2->identidadC ,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $this->assertFalse($cliente2->identidadC ==  $cliente->identidadC);
        $cliente->delete();
        $cliente2->delete();
    }

    public function test_136_actualizar_cliente_validar_campo_identidadC_unico_mensaje()
    {
        $user = User::find(1);

        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $cliente2 = Cliente::create([
            'identidadC' => '080119951111',
            'nombreCompleto' => 'Manuel',
            'telefono' => '98889898',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente2->identidadC ,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );


        $response->assertInvalid([
            'identidadC' => 'El número de identidad debe ser único.',
        ]);
        $cliente->delete();
        $cliente2->delete();
    }

    public function test_137_actualizar_cliente_validar_campo_identidadC_solo_numeros()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);


        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => 'identidad',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertStatus(302);
        $cliente->delete();
    }

    public function test_138_actualizar_cliente_validar_campo_identidadC_solo_numeros_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);


        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => 'identidad',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertInvalid([
            'identidadC' => 'En la identidad sólo se permiten números ',
        ]);
        $cliente->delete();
    }


    public function test_139_actualizar_cliente_validar_campo_identidadC_formato_invalido()
    {
        $user = User::find(1);

        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => '0704-1997-098938',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertStatus(302);
        $cliente->delete();
    }

    public function test_140_actualizar_cliente_validar_campo_identidadC_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => '0704-1997-098938',
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertInvalid([
            'identidadC' => 'El formato para el número de identidad no es válido.',
        ]);
        $cliente->delete();
    }

    public function test_141_actualizar_cliente_validar_campo_nombreCompleto_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => '',
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertStatus(302);
        $cliente->delete();
    }

    public function test_142_actualizar_cliente_validar_campo_nombreCompleto_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => '',
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertInvalid([
            'nombreCompleto' => 'El nombre del cliente es obligatorio, no puede estar vacío.',
        ]);
        $cliente->delete();
    }

    public function test_143_actualizar_cliente_validar_campo_nombreCompleto_solo_letras()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => '12312312',
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertStatus(302);
        $cliente->delete();
    }

    public function test_144_actualizar_cliente_validar_campo_nombreCompleto_solo_letras_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => '12312312',
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $response->assertInvalid([
            'nombreCompleto' => 'El nombre debe iniciar con mayúscula, solo permite un espacio entre ellos y no se permiten números.',
        ]);
        $cliente->delete();
    }

    public function test_145_actualizar_cliente_validar_campo_nombreCompleto_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => 'manuel',
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $cliente->delete();
        $response->assertStatus(302);

    }

    public function test_146_actualizar_cliente_validar_campo_nombreCompleto_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => 'manuel',
                'telefono'  => '90909090',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );

        $cliente->delete();
        $response->assertInvalid([
            'nombreCompleto' => 'El nombre debe iniciar con mayúscula, solo permite un espacio entre ellos y no se permiten números.',
        ]);

    }

    public function test_147_actualizar_cliente_validar_campo_telefono_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertStatus(302);
    }

    public function test_148_actualizar_cliente_validar_campo_telefono_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertInvalid([
            'telefono' => 'El teléfono del cliente es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_149_actualizar_cliente_validar_campo_telefono_solo_numeros()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => 'telefono',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertStatus(302);
    }

    public function test_150_actualizar_cliente_validar_campo_telefono_solo_numeros_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => 'telefono',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertInvalid([
            'telefono' => 'El teléfono debe contener sólo números.',
        ]);
    }


    public function test_151_actualizar_cliente_validar_campo_telefono_digits_8()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '989898989898',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertStatus(302);
    }

    public function test_152_actualizar_cliente_validar_campo_telefono_digits_8_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '789898989898',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertInvalid([
            'telefono' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
        ]);
    }

    public function test_153_actualizar_cliente_validar_campo_telefono_formato_invalido_2_3_8_9()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '78800000',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertStatus(302);
    }

    public function test_154_actualizar_cliente_validar_campo_telefono_formato_invalido_2_3_8_9_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  => '78800000',
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertInvalid([
            'telefono' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
        ]);
    }

    public function test_154_actualizar_cliente_validar_campo_telefono_unico()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $cliente2 = Cliente::create([
            'identidadC' => '080119951111',
            'nombreCompleto' => 'Manuel',
            'telefono' => '98889898',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);


        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente2->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $cliente2->delete();
        $this->assertFalse($cliente2->telefono==$cliente->telefono);
    }

    public function test_155_actualizar_cliente_validar_campo_telefono_unico_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $cliente2 = Cliente::create([
            'identidadC' => '080119951111',
            'nombreCompleto' => 'Manuel',
            'telefono' => '98889898',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente2->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $cliente2->delete();
        $response->assertInvalid([
            'telefono' => 'El número de teléfono ya está en uso.',
        ]);
    }

    public function test_156_actualizar_cliente_validar_campo_fechaNacimiento_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => '',
            ]
        );
        $cliente->delete();

        $response->assertStatus(302);
    }

    public function test_157_actualizar_cliente_validar_campo_fechaNacimiento_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => '',
            ]
        );
        $cliente->delete();
        $response->assertInvalid([
            'fechaNacimiento' => 'La fecha de nacimiento del cliente es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_158_actualizar_cliente_validar_campo_fechaNacimiento_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => '2023-18-04',
            ]
        );
        $cliente->delete();

        $response->assertStatus(302);
    }

    public function test_159_actualizar_cliente_validar_campo_fechaNacimiento_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => $cliente->direccion,
                'fechaNacimiento' => '2023-18-04',
            ]
        );
        $cliente->delete();
        $response->assertInvalid([
            'fechaNacimiento' => 'Debe ser mayor de edad.',
        ]);
    }

    public function test_160_actualizar_cliente_validar_campo_direccion_vacio()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => '',
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertStatus(302);
    }

    public function test_161_actualizar_cliente_validar_campo_direccion_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => '',
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertInvalid([
            'direccion' => 'La dirección del cliente es obligatoria, no puede estar vacío.',
        ]);
    }

    public function test_162_actualizar_cliente_validar_campo_direccion_min_10_caracteres()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => 'hola',
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertStatus(302);
    }

    public function test_163_actualizar_cliente_validar_campo_direccion_min_10_caracteres_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => 'hola',
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();
        $response->assertInvalid([
            'direccion' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
        ]);
    }

    public function test_164_actualizar_cliente_validar_campo_direccion_max_150_caracteres()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => 'hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola ',
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertStatus(302);
    }

    public function test_165_actualizar_cliente_validar_campo_direccion_max_150_caracteres_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $cliente = Cliente::create([
            'identidadC' => '0801199501234',
            'nombreCompleto' => 'Juan Pérez',
            'telefono' => '22345678',
            'direccion' => 'Calle Principal #123',
            'fechaNacimiento' => '25-08-1995',
        ]);

        $response = $this->put(
            route('cliente.update',['id'=>$cliente->id]),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => $cliente->nombreCompleto,
                'telefono'  =>$cliente->telefono,
                'direccion'       => 'hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola ',
                'fechaNacimiento' => $cliente->fechaNacimiento,
            ]
        );
        $cliente->delete();

        $response->assertInvalid([
            'direccion' => 'La dirección sobrepasa el límite de caracteres',
        ]);
    }


}
