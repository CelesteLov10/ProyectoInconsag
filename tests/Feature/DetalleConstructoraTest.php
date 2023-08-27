<?php

namespace Tests\Feature;

use App\Models\Constructora;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class DetalleConstructoraTest extends TestCase
{
    public function test_71_acceso_detalles_constructora_antes_de_logueo()
    {

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_72_acceso_detalles_constructora_despues_de_logueo()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertViewIs('constructora.show');
    }


    public function test_73_acceso_detalles_constructora_etiqueta_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertSeeText('Detalles');
    }

    public function test_74_acceso_detalles_constructora_columna_nombreConstructora_etiqueta_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertSeeText($contructora->nombreConstructora);
    }

    public function test_75_acceso_detalles_constructora_columna_direccion_etiqueta_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertSeeText($contructora->direccion);
    }

    public function test_76_acceso_detalles_constructora_columna_telefono_etiqueta_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertSeeText($contructora->telefono);
    }

    public function test_77_acceso_detalles_constructora_columna_email_etiqueta_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertSeeText($contructora->email);
    }

    public function test_78_acceso_detalles_constructora_columna_fechaContrato_etiqueta_correcta()
    {
        $user = User::find(1);
        Auth::login($user);

        $contructora = Constructora::all()->first();
        $response = $this->get(route('constructora.show',['id'=>$contructora->id]));
        $response->assertSeeText($contructora->fechaContrato);
    }

}
