<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Constructora;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EditarConstructoraTest extends TestCase
{
    public function test_30_actualizar_constructora_antes_de_logueo()
    {
        $contructora = Constructora::all()->first();

        $response = $this->get(route('constructora.edit',['id'=>$contructora->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_31_actualizar_constructora_despues_de_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();

        $response = $this->get(route('constructora.edit',['id'=>$contructora->id]));
        $response->assertStatus(200);
    }


    public function test_32_actualizar_constructora_vista_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();

        $response = $this->get(route('constructora.edit',['id'=>$contructora->id]));
        $response->assertViewIs('constructora.edit');
    }

    public function test_33_actualizar_constructora_con_etiquetas_correctas()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->get(route('constructora.edit',['id'=>$contructora->id]));
        $response->assertSeeText('Actualización');
    }

    public function test_34_actualizar_constructora_con_etiquetas_correctas_direccion()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->get(route('constructora.edit',['id'=>$contructora->id]));
        $response->assertSeeText($contructora->direccion);
    }

    public function test_35_actualizar_constructora_sin_logueo()
    {
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertRedirect(route('login'));
    }

    public function test_36_actualizar_constructora_con_logueo()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertRedirect(route('constructora.index'));
    }

    public function test_37_actualizar_constructora_columna_nombreConstructora_vacio()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  '',
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->nombreConstructora == '');
    }

    public function test_38_actualizar_constructora_columna_nombreConstructora_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  '',
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'nombreConstructora' => 'El nombre de la constructora es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_39_actualizar_constructora_columna_nombreConstructora_solo_letras()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  '12345678',
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );
        $contructora = Constructora::all()->first();
        $this->assertFalse($contructora->nombreConstructora == '12345678');
    }

    public function test_40_actualizar_constructora_columna_nombreConstructora_solo_letras_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  '12345678',
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'nombreConstructora' => 'En el nombre sólo se permite letras.',
        ]);
    }

    public function test_41_actualizar_constructora_columna_nombreConstructora_formato_incorrecto()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  'contructor',
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->nombreConstructora == '12345678');
    }

    public function test_42_actualizar_constructora_columna_nombreConstructora_formato_incorrecto_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  'contructor',
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'nombreConstructora' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',
        ]);
    }

    public function test_43_actualizar_constructora_columna_direccion_vacio()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => '',
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->direccion == '');
    }

    public function test_44_actualizar_constructora_columna_direccion_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => '',
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'direccion' => 'La dirección de la constructora es obligatoria, no puede estar vacío.',
        ]);
    }

    public function test_45_actualizar_constructora_columna_direccion_cantida_minima_caracteres_10()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => 'direc',
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->direccion == '');
    }

    public function test_46_actualizar_constructora_columna_direccion_cantida_minima_caracteres_10_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => 'direc',
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'direccion' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
        ]);
    }

    public function test_47_actualizar_constructora_columna_direccion_cantida_maxima_caracteres_150()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => 'direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc ',
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->direccion == '');
    }

    public function test_48_actualizar_constructora_columna_direccion_cantida_maxima_caracteres_150_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => 'direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc direc ',
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'direccion' => 'La dirección sobrepasa el límite de caracteres',
        ]);
    }

    public function test_49_actualizar_constructora_columna_telefono_vacio()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->telefono == '');
    }

    public function test_50_actualizar_constructora_columna_telefono_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono de la constructora es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_51_actualizar_constructora_columna_telefono_vacio()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->telefono == '');
    }

    public function test_52_actualizar_constructora_columna_telefono_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono de la constructora es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_53_actualizar_constructora_columna_telefono_solo_numeros()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => 'telefono',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->telefono == '');
    }

    public function test_54_actualizar_constructora_columna_telefono_solo_numeros_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => 'telefono',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono debe contener sólo números.',
        ]);
    }

    public function test_55_actualizar_constructora_columna_telefono_contener_8_digitos()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '970707070707070',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->telefono == '');
    }

    public function test_56_actualizar_constructora_columna_telefono_contener_8_digitos_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '970707070707070',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono debe contener 8 dígitos.',
        ]);
    }

    public function test_57_actualizar_constructora_columna_telefono_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '12233223',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->telefono == '');
    }

    public function test_58_actualizar_constructora_columna_telefono_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => '12233223',
                'email'    => $contructora->email,
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
        ]);
    }

    public function test_59_actualizar_constructora_columna_telefono_unico()
    {
        $user = User::find(1);
        Auth::login($user);

        $nuevo = Constructora::create([
            'nombreConstructora' => 'Constructoras Excelencia',
            'direccion' => 'Calle Principal #123',
            'telefono' => '23987766',
            'email' => 'info@excelenciaconstructoras.com',
            'fechaContrato' => '2023-08-25',
        ]);

        $actual = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$actual->id]),
            [
                'nombreConstructora'   =>  $actual->nombreConstructora,
                'direccion'       => $actual->direccion,
                'telefono'  => '23987766',
                'email'    => $actual->email,
                'fechaContrato'  => $actual->fechaContrato,
            ]
        );

        $this->assertFalse($actual->telefono == $nuevo->telefono);

        $nuevo->delete();
    }

    public function test_60_actualizar_constructora_columna_telefono_unico_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $nuevo = Constructora::create([
            'nombreConstructora' => 'Constructoras Excelencia',
            'direccion' => 'Calle Principal #123',
            'telefono' => '23987766',
            'email' => 'info@excelenciaconstructoras.com',
            'fechaContrato' => '2023-08-25',
        ]);

        $actual = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$actual->id]),
            [
                'nombreConstructora'   =>  $actual->nombreConstructora,
                'direccion'       => $actual->direccion,
                'telefono'  => '23987766',
                'email'    => $actual->email,
                'fechaContrato'  => $actual->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El número de teléfono ya está en uso.',
        ]);
        $nuevo->delete();
    }

    public function test_61_actualizar_constructora_columna_correo_vacio()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => '',
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->email == '');
    }

    public function test_62_actualizar_constructora_columna_correo_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => '',
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'email' => 'El correo electrónico de la constructora es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_63_actualizar_constructora_columna_correo_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => 'infoexcelenciaconstructoras.com',
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $this->assertFalse($contructora->email == '');
    }

    public function test_64_actualizar_constructora_columna_correo_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => 'infoexcelenciaconstructoras.com',
                'fechaContrato'  => $contructora->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'email' => 'Debe ingresar un correo electrónico válido.',
        ]);
    }

    public function test_65_actualizar_constructora_columna_email_unico()
    {
        $user = User::find(1);
        Auth::login($user);

        $nuevo = Constructora::create([
            'nombreConstructora' => 'Constructoras Excelencia',
            'direccion' => 'Calle Principal #123',
            'telefono' => '23987766',
            'email' => 'info@excelenciaconstructoras.com',
            'fechaContrato' => '2023-08-25',
        ]);

        $actual = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$actual->id]),
            [
                'nombreConstructora'   =>  $actual->nombreConstructora,
                'direccion'       => $actual->direccion,
                'telefono'  => $actual->telefono,
                'email'    => 'info@excelenciaconstructoras.com',
                'fechaContrato'  => $actual->fechaContrato,
            ]
        );

        $this->assertFalse($actual->email == $nuevo->email);

        $nuevo->delete();
    }

    public function test_66_actualizar_constructora_columna_email_unico_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);

        $nuevo = Constructora::create([
            'nombreConstructora' => 'Constructoras Excelencia',
            'direccion' => 'Calle Principal #123',
            'telefono' => '23987766',
            'email' => 'info@excelenciaconstructoras.com',
            'fechaContrato' => '2023-08-25',
        ]);

        $actual = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$actual->id]),
            [
                'nombreConstructora'   =>  $actual->nombreConstructora,
                'direccion'       => $actual->direccion,
                'telefono'  => $actual->telefono,
                'email'    => 'info@excelenciaconstructoras.com',
                'fechaContrato'  => $actual->fechaContrato,
            ]
        );

        $response->assertInvalid([
            'email' => 'El correo electrónico ya existe.',
        ]);
        $nuevo->delete();
    }

    public function test_67_actualizar_constructora_columna_fechaContrato_vacio()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => '',
            ]
        );

        $this->assertFalse($contructora->email == '');
    }

    public function test_68_actualizar_constructora_columna_fechaContrato_vacio_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => '',
            ]
        );

        $response->assertInvalid([
            'fechaContrato' => 'Debe seleccionar la fecha de adquisición, no puede estar vacío.',
        ]);
    }

    public function test_69_actualizar_constructora_columna_fechaContrato_formato_invalido()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => '1234578',
            ]
        );

        $this->assertFalse($contructora->email == '');
    }

    public function test_70_actualizar_constructora_columna_fechaContrato_formato_invalido_mensaje()
    {
        $user = User::find(1);
        Auth::login($user);
        $contructora = Constructora::all()->first();

        $response = $this->put(
            route('constructora.update',['id'=>$contructora->id]),
            [
                'nombreConstructora'   =>  $contructora->nombreConstructora,
                'direccion'       => $contructora->direccion,
                'telefono'  => $contructora->telefono,
                'email'    => $contructora->email,
                'fechaContrato'  => '1234578',
            ]
        );

        $response->assertInvalid([
            'fechaContrato' => 'La fecha de contrato debe tener el formato "2000-12-31"',
        ]);
    }
}
