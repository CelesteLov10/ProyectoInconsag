<?php

namespace Tests\Unit;

use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PruebasAutoTest extends TestCase
{

    public function test_N1_impresion_lista_maquinaria_antes_de_logueo()
    {

        $response = $this->get(route('maquinaria.pdf'));
        $response->assertRedirect(route('login'));
    }

    public function test_N2_impresion_lista_maquinaria_despues_de_logueo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('maquinaria.pdf'));
        $response->assertStatus(200);
    }

    public function test_N3_nuevo_bloque_antes_de_logueo()
    {

        $response = $this->get(route('bloque.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_N4_nuevo_bloque_despues_de_logueo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.create'));
        $response->assertStatus(200);
    }

    public function test_N5_nuevo_bloque_vista_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.create'));
        $response->assertViewIs('bloque.create');
    }

    public function test_N6_nuevo_bloque_etiqueta_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.create'));
        $response->assertSeeText('Registro');
    }

    public function test_N7_nuevo_bloque_registro_correcto_antes_de_logueo()
    {
        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);
        $response = $this->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertRedirect(route('login'));
    }

    public function test_N8_nuevo_bloque_registro_correcto_despues_de_logueo()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
                //'subirfoto'    => $image,
            ]
        );

        $response->assertRedirect(route('bloque.index'));
    }


    public function test_N9_nuevo_bloque_validar_campo_nombreBloque_vacio()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where cantidadLotes = ?', [6]);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => '',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }



    public function test_N10_nuevo_bloque_validar_campo_nombreBloque_vacio_mensajes()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where cantidadLotes = ?', [6]);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => '',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertInvalid([
            'nombreBloque' => 'El nombre del bloque es obligatorio, no puede estar vacío. ',
        ]);
    }

    public function test_N11_nuevo_bloque_validar_campo_nombreBloque_formato_texto()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where cantidadLotes = ?', [6]);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'bl iuasd oiuads asd',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }



    public function test_N12_nuevo_bloque_validar_campo_nombreBloque_formato_texto_mensajes()
    {
       $user = User::find(1);

       DB::delete('delete from bloques where cantidadLotes = ?', [6]);

     $image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
        route('bloque.store'),
         [
               'nombreBloque'   => 'bl iuasd oiuads asd 9878sa',
              'cantidadLotes'    => 6,
                 'subirfoto'    => '',
             ]
     );

       $response->assertInvalid([
          'nombreBloque' => 'El nombre del bloque solo permite un espacio entre los nombres.',
         ]);
    }

    public function test_N13_nuevo_bloque_validar_campo_nombreBloque_valor_unico()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where cantidadLotes = ?', [6]);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque i',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N14_nuevo_bloque_validar_campo_nombreBloque_valor_unico_mensajes()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where cantidadLotes = ?', [6]);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque i',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertInvalid([
            'nombreBloque' => 'El nombre del bloque debe ser único.',
        ]);
    }

    public function test_N15_nuevo_bloque_validar_campo_cantidadLotes_vacio()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => '',
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N16_nuevo_bloque_validar_campo_cantidadLotes_vacio_mensajes()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => '',
                'subirfoto'    => '',
            ]
        );

        $response->assertInvalid([
            'cantidadLotes' => 'Ingresar la cantidad de lotes es obligatorio.',
        ]);
    }

    public function test_N17_nuevo_bloque_validar_campo_cantidadLotes_solo_numeros()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 'cantidad',
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N18_nuevo_bloque_validar_campo_cantidadLotes_solo_numeros_mensajes()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 'cantidad',
                'subirfoto'    => '',
            ]
        );

        $response->assertInvalid([
            'cantidadLotes' => 'La cantidad de lotes no permite letras.',
        ]);
    }

    public function test_N19_nuevo_bloque_validar_campo_cantidadLotes_minimo_lotes()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 1,
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N20_nuevo_bloque_validar_campo_cantidadLotes_minimo_lotes_mensajes()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 1,
                'subirfoto'    => '',
            ]
        );

        $response->assertInvalid([
            'cantidadLotes' => 'La cantidad de lotes de un bloque debe ser al menos de 5 lotes.',
        ]);
    }

    public function test_N21_nuevo_bloque_validar_campo_subirfoto_vacio()
    {
        $user = User::find(1);

        DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        //$image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
        $response = $this->actingAs($user)->post(
            route('bloque.store'),
            [
                'nombreBloque'   => 'Bloque a',
                'cantidadLotes'    => 6,
                'subirfoto'    => '',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N22_nuevo_bloque_validar_campo_subirfoto_vacio_mensaje()
    {
         $user = User::find(1);

         DB::delete('delete from bloques where nombreBloque = ?', ['Bloque a']);

        $image = new \Illuminate\Http\UploadedFile(public_path('10.png'), 'imagen.png', 'image/png', null, true);
         $response = $this->actingAs($user)->post(
             route('bloque.store'),
             [
              'nombreBloque'   => 'Bloque a',
                 'cantidadLotes'    => 6,
                 'subirfoto'    => '',
            ]
         );

        $response->assertInvalid([
             'subirfoto' => 'Debe seleccionar una imagen.',
         ]);
     }

    public function test_N23_lista_bloques_antes_de_logueo()
    {

        $response = $this->get(route('bloque.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_N24_lista_bloques_despues_de_logueo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.index'));
        $response->assertStatus(200);
    }

    public function test_N25_lista_bloques_etiqueta_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.index'));
        $response->assertSeeText('Listado');
    }

    public function test_N26_nuevo_lote_antes_de_logueo()
    {

        $response = $this->get(route('lote.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_N27_nuevo_lote_despues_de_logueo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('lote.create'));
        $response->assertStatus(200);
    }

    public function test_N28_nuevo_lote_vista_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('lote.create'));
        $response->assertViewIs('lote.create');
    }

    public function test_N29_nuevo_lote_etiqueta_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('lote.create'));
        $response->assertSeeText('Registro');
    }

    public function test_N30_nuevo_lote_registro_correcto_antes_de_logueo()
    {
        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);
        $bloque = Bloque::all()->first();

        $response = $this->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertRedirect(route('login'));
    }

    public function test_N31_nuevo_lote_registro_correcto_despues_de_logueo()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertRedirect(route('bloque.index'));
    }

    public function test_N32_nuevo_lote_validar_campo_bloque_id_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => '',
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N33_nuevo_lote_validar_campo_bloque_id_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => '',
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'bloque_id' => 'El nombre del bloque es obligatorio, no puede estar vacío. ',
        ]);
    }

     public function test_N34_nuevo_lote_validar_campo_bloque_id_solo_numerico()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => 'id',
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 12,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertStatus(302);
     }

     public function test_N35_nuevo_lote_validar_campo_bloque_id_solo_numerico_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => 'id',
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 12,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
         ]
     );

     $response->assertInvalid([
         'bloque_id' => 'El bloque_id solo permite numeros.',
     ]);
 }

    public function test_N36_nuevo_lote_validar_campo_nombreLote_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where colindanciaO = ?', ['425 Immanuel Fork Murazikhaven, ND 76787-3193']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => '',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N37_nuevo_lote_validar_campo_nombreLote_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => '',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'nombreLote' => 'El nombre del lote es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_N38_nuevo_lote_validar_campo_nombreLote_formato_incorrecto()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where colindanciaO = ?', ['425 Immanuel Fork Murazikhaven, ND 76787-3193']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'dasdasdasd sad asd asd asdasd as das das das das das d',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N39_nuevo_lote_validar_campo_nombreLote_formato_incorrecto_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'dasdasdasd sad asd asd asdasd as das das das das das d',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 12,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );
       $response->assertInvalid([
             'nombreLote' => 'El nombre del lote solo permite un espacio entre los nombres.',
         ]);
     }

    public function test_N40_nuevo_lote_validar_campo_nombreLote_unico()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();
        $lote = Lote::all()->first();

        DB::delete('delete from lotes where colindanciaO = ?', ['425 Immanuel Fork Murazikhaven, ND 76787-3193']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => $lote->nombreLote,
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N42_nuevo_lote_validar_campo_status_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => '',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N43_nuevo_lote_validar_campo_status_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => '',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'status' => 'El estado del lote es requerido',
        ]);
    }

    public function test_N44_nuevo_lote_validar_campo_medidaLateralR_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => '',
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N45_nuevo_lote_validar_campo_medidaLateralR_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => '',
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaLateralR' => 'La medida lateral derecha es obligatoria, no puede estar vacío. ',
        ]);
    }

    public function test_N46_nuevo_lote_validar_campo_medidaLateralR_solo_numero()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 'numero',
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N47_nuevo_lote_validar_campo_medidaLateralR_solo_numero_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 'numero',
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaLateralR' => 'La medida lateral derecha solo permite numeros.',
        ]);
    }

    public function test_N48_nuevo_lote_validar_campo_medidaLateralR_valor_minimo_1()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 0,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N49_nuevo_lote_validar_campo_medidaLateralR_valor_minimo_1_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 0,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertInvalid([
             'medidaLateralR' => 'El valor mínimo de la medida lateral es "1".',
         ]);
     }

    public function test_N50_nuevo_lote_validar_campo_medidaLateralR_valor_maximo_99999()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 1000000,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N51_nuevo_lote_validar_campo_medidaLateralR_valor_maximo_99999_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 1000000,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertInvalid([
             'medidaLateralR' => 'El valor maximo de la medida lateral es "99999".',
         ]);
     }

    public function test_N52_nuevo_lote_validar_campo_medidaLateralR_formato_incorrecto()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 10.909090909090090,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N53_nuevo_lote_validar_campo_medidaLateralR_valor_formato_incorrecto_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 10.909090909090090,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertInvalid([
             'medidaLateralR' => 'El valor de la  medida lateral es incorrecto. Ejem. "123" 0 "100.342"',
         ]);
     }

    public function test_N54_nuevo_lote_validar_campo_medidaLateralL_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => '',
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N55_nuevo_lote_validar_campo_medidaLateralL_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => '',
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaLateralL' => 'La medida lateral izquierda es obligatoria, no puede estar vacío.',
        ]);
    }

    public function test_N56_nuevo_lote_validar_campo_medidaLateralL_solo_numero()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 'numero',
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N57_nuevo_lote_validar_campo_medidaLateralL_solo_numero_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 'numero',
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaLateralL' => 'La medida lateral izquierda solo permite numeros.',
        ]);
    }

    public function test_N58_nuevo_lote_validar_campo_medidaLateralL_valor_minimo_1()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 0,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N60_nuevo_lote_validar_campo_medidaLateralL_valor_maximo_99999()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 1000000,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N61_nuevo_lote_validar_campo_medidaLateralL_valor_maximo_99999_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 12,
                 'medidaLateralL'   => 1000000,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertInvalid([
             'medidaLateralL' => 'El valor maximo de la medida lateral izquierda es "99999".',
         ]);
     }

    public function test_N62_nuevo_lote_validar_campo_medidaLateralL_formato_incorrecto()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 10.909090909090090,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

  public function test_N63_nuevo_lote_validar_campo_medidaLateralL_valor_formato_incorrecto_mensaje()
  {
      $user = User::find(1);

      $bloque = Bloque::all()->first();

      DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

      $response = $this->actingAs($user)->post(
          route('lote.store'),
          [
             'bloque_id'   => $bloque->id,
              'nombreLote' => 'Lote milagro',
              'status'    => 'Vendido',
              'medidaLateralR'   => 12,
              'medidaLateralL'   => 10.909090909090090,
              'medidaEnfrente'   => 11,
              'medidaAtras'   => 10,
              'valorTerreno' => 100000,
              'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
              'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
              'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
              'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
          ]
      );

         $response->assertInvalid([
             'medidaLateralL' => 'El valor de la  medida lateral izquierda es incorrecto. Ejem. "123" 0 "100.342"',
         ]);
     }

    public function test_N64_nuevo_lote_validar_campo_medidaEnfrente_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => '',
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N65_nuevo_lote_validar_campo_medidaEnfrente_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => '',
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaEnfrente' => 'La medida de enfrente es obligatoria, no puede estar vacío.',
        ]);
    }

    public function test_N66_nuevo_lote_validar_campo_medidaEnfrente_solo_numero()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 'numero',
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N67_nuevo_lote_validar_campo_medidaEnfrente_solo_numero_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 'numero',
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaEnfrente' => 'La medida de enfrente solo permite numeros.',
        ]);
    }

    public function test_N68_nuevo_lote_validar_campo_medidaEnfrente_valor_minimo_1()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 0,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N69_nuevo_lote_validar_campo_medidaEnfrente_valor_minimo_1_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 12,
                 'medidaLateralL'   => 12,
                 'medidaEnfrente'   => 0,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertInvalid([
             'medidaEnfrente' => 'El valor mínimo de la medida frente es "1".',
         ]);
     }

    public function test_N70_nuevo_lote_validar_campo_medidaEnfrente_valor_maximo_99999()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 1000000,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

 public function test_N71_nuevo_lote_validar_campo_medidaEnfrente_valor_maximo_99999_mensaje()
 {
     $user = User::find(1);

     $bloque = Bloque::all()->first();

     DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
         route('lote.store'),
         [
             'bloque_id'   => $bloque->id,
             'nombreLote' => 'Lote milagro',
             'status'    => 'Vendido',
                'medidaLateralR'   => 12,
            'medidaLateralL'   => 12,
             'medidaEnfrente'   => 1000000,
             'medidaAtras'   => 10,
             'valorTerreno' => 100000,
             'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
         ]
     );

     $response->assertInvalid([
         'medidaEnfrente' => 'El valor maximo de la medida frente es "99999".',
        ]);
 }

    public function test_N72_nuevo_lote_validar_campo_medidaEnfrente_formato_incorrecto()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 10.909090909090090,
                'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

 public function test_N73_nuevo_lote_validar_campo_medidaEnfrente_valor_formato_incorrecto_mensaje()
 {
     $user = User::find(1);

     $bloque = Bloque::all()->first();

     DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

     $response = $this->actingAs($user)->post(
         route('lote.store'),
         [
             'bloque_id'   => $bloque->id,
             'nombreLote' => 'Lote milagro',
             'status'    => 'Vendido',
             'medidaLateralR'   => 12,
             'medidaLateralL'   => 12,
             'medidaEnfrente'   => 10.909090909090090,
             'medidaAtras'   => 10,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
         ]
     );

         $response->assertInvalid([
             'medidaEnfrente' => 'El valor de la  medida frente es incorrecto. Ejem. "123" 0 "100.342"',
         ]);
     }

    public function test_N74_nuevo_lote_validar_campo_medidaAtras_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => '',
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N75_nuevo_lote_validar_campo_medidaAtras_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => '',
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaAtras' => 'La medida de atras es obligatoria, no puede estar vacío. ',
        ]);
    }

    public function test_N76_nuevo_lote_validar_campo_medidaAtras_solo_numero()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 'numero',
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N77_nuevo_lote_validar_campo_medidaAtras_solo_numero_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 'numero',
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'medidaAtras' => 'La medida de atras solo permite numeros.',
        ]);
    }

    public function test_N78_nuevo_lote_validar_campo_medidaAtras_valor_minimo_1()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 0,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

 public function test_N79_nuevo_lote_validar_campo_medidaAtras_valor_minimo_1_mensaje()
 {
     $user = User::find(1);

     $bloque = Bloque::all()->first();

     DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

     $response = $this->actingAs($user)->post(
         route('lote.store'),
         [
             'bloque_id'   => $bloque->id,
             'nombreLote' => 'Lote milagro',
             'status'    => 'Vendido',
             'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
             'medidaEnfrente'   => 11,
             'medidaAtras'   => 0,
             'valorTerreno' => 100000,
             'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
         ]
     );

     $response->assertInvalid([
         'medidaAtras' => 'El valor mínimo de la medida atras es "1".',
         ]);
     }

    public function test_N80_nuevo_lote_validar_campo_medidaAtras_valor_maximo_99999()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 1000000,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N81_nuevo_lote_validar_campo_medidaAtras_valor_maximo_99999_mensaje()
     {
         $user = User::find(1);

         $bloque = Bloque::all()->first();

         DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

         $response = $this->actingAs($user)->post(
             route('lote.store'),
             [
                 'bloque_id'   => $bloque->id,
                 'nombreLote' => 'Lote milagro',
                 'status'    => 'Vendido',
                 'medidaLateralR'   => 12,
                 'medidaLateralL'   => 1000000,
                 'medidaEnfrente'   => 11,
                 'medidaAtras'   => 10,
                 'valorTerreno' => 100000,
                 'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                 'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             ]
         );

         $response->assertInvalid([
             'medidaAtras' => 'El valor maximo de la medida atras es "99999".',
         ]);
     }

    public function test_N82_nuevo_lote_validar_campo_medidaAtras_formato_incorrecto()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10.909090909090090,
                'valorTerreno' => 100000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

 public function test_N83_nuevo_lote_validar_campo_medidaAtras_valor_formato_incorrecto_mensaje()
 {
     $user = User::find(1);

     $bloque = Bloque::all()->first();

     DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

     $response = $this->actingAs($user)->post(
         route('lote.store'),
         [
             'bloque_id'   => $bloque->id,
             'nombreLote' => 'Lote milagro',
             'status'    => 'Vendido',
             'medidaLateralR'   => 12,
             'medidaLateralL'   => 12,
             'medidaEnfrente'   => 11,
             'medidaAtras'   => 10.909090909090090,
             'valorTerreno' => 100000,
             'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
             'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
         ]
     );

         $response->assertInvalid([
             'medidaAtras' => 'El valor de la medida atras es incorrecto. Ejem. "123" 0 "100.342"',
         ]);
     }

    public function test_N84_nuevo_lote_validar_campo_valorTerreno_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => '',
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N85_nuevo_lote_validar_campo_valorTerreno_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => '',
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'valorTerreno' => 'El valor del terreno es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_N86_nuevo_lote_validar_campo_valorTerreno_solo_numero()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 'numero',
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N87_nuevo_lote_validar_campo_valorTerreno_solo_numero_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 'numero',
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'valorTerreno' => 'Solo se permite números enteros. Ejem. "12345678"',
        ]);
    }

    public function test_N88_nuevo_lote_validar_campo_valorTerreno_valor_minimo_80000()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 0,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N89_nuevo_lote_validar_campo_valorTerreno_valor_minimo_80000_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 0,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'valorTerreno' => 'El valor mínimo del terreno es  "80000". ',
        ]);
    }

    public function test_N90_nuevo_lote_validar_campo_valorTerreno_formato_incorrecto()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 10.909090909090090,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N91_nuevo_lote_validar_campo_valorTerreno_valor_formato_incorrecto_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 10.909090909090090,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'valorTerreno' => 'El valor es incorrecto. Ejem. "123"',
        ]);
    }

    public function test_N92_nuevo_lote_validar_campo_colindanciaN_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N93_nuevo_lote_validar_campo_colindanciaN_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'colindanciaN' => 'La colindancia norte es obligatoria, no puede estar vacío. ',
        ]);

    }

    public function test_N94_nuevo_lote_validar_campo_colindanciaS_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N95_nuevo_lote_validar_campo_colindanciaS_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'colindanciaS' => 'La colindancia sur es obligatoria, no puede estar vacío. ',
        ]);

    }

    public function test_N96_nuevo_lote_validar_campo_colindanciaE_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N97_nuevo_lote_validar_campo_colindanciaE_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '',
                'colindanciaO'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
            ]
        );

        $response->assertInvalid([
            'colindanciaE' => 'La colindancia este es obligatoria, no puede estar vacío. ',
        ]);

    }

    public function test_N98_nuevo_lote_validar_campo_colindanciaO_vacio()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N99_nuevo_lote_validar_campo_colindanciaO_vacio_mensaje()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        DB::delete('delete from lotes where nombreLote = ?', ['Lote milagro']);

        $response = $this->actingAs($user)->post(
            route('lote.store'),
            [
                'bloque_id'   => $bloque->id,
                'nombreLote' => 'Lote milagro',
                'status'    => 'Vendido',
                'medidaLateralR'   => 12,
                'medidaLateralL'   => 12,
                'medidaEnfrente'   => 11,
                'medidaAtras'   => 10,
                'valorTerreno' => 1000000,
                'colindanciaN'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaS'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaE'    => '425 Immanuel Fork Murazikhaven, ND 76787-3193',
                'colindanciaO'    => '',
            ]
        );

        $response->assertInvalid([
            'colindanciaO' => 'La colindancia oeste es obligatoria, no puede estar vacío. ',
        ]);

    }

    public function test_N100_detalle_terreno_antes_de_logueo()
    {
        $bloque = Bloque::all()->first();

        $response = $this->get(route('bloque.show', ['id' => $bloque->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_N101_detalle_terreno_despues_de_logueo()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        $response = $this->actingAs($user)->get(route('bloque.show', ['id' => $bloque->id]));
        $response->assertStatus(200);
    }

    public function test_N102_detalle_terreno_id_negativo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.show', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_N103_detalle_terreno_id_texto()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('bloque.show', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_N104_detalle_terreno_id_decimales()
    {
        $user = User::find(1);

        Auth::login($user);

        $response = $this->actingAs($user)->get(route('bloque.show', ['id' => 9.0980898898]));
        $response->assertStatus(404);
    }

    public function test_N105_detalle_terreno_etiquetass_correctas_nombreBloque()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        $response = $this->actingAs($user)->get(route('bloque.show', ['id' => $bloque->id]));
        $response->assertSeeText($bloque->nombreBloque);
    }

    public function test_N106_detalle_terreno_etiquetass_correctas_cantidadLotes()
    {
        $user = User::find(1);

        $bloque = Bloque::all()->first();

        $response = $this->actingAs($user)->get(route('bloque.show', ['id' => $bloque->id]));
        $response->assertSeeText($bloque->cantidadLotes);
    }


    public function test_N107_nuevo_cliente_antes_de_logueo()
    {

        $response = $this->get(route('cliente.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_N108_nuevo_cliente_despues_de_logueo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('cliente.create'));
        $response->assertStatus(200);
    }

    public function test_N109_nuevo_cliente_vista_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('cliente.create'));
        $response->assertViewIs('cliente.create');
    }

    public function test_N110_nuevo_cliente_etiqueta_correcta()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('cliente.create'));
        $response->assertSeeText('Registro');
    }

    public function test_N111_nuevo_cliente_registro_correcto_antes_de_logueo()
    {
        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '1996-07-18',
            ]
        );

        $response->assertRedirect(route('login'));
    }

    public function test_N112_nuevo_cliente_registro_correcto_despues_de_logueo()
    {
        $user = User::find(1);

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertRedirect(route('cliente.index'));
    }


    public function test_N113_nuevo_cliente_validar_campo_identidadC_vacio()
    {
        $user = User::find(1);

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N114_nuevo_cliente_validar_campo_identidadC_vacio_mensaje()
    {
        $user = User::find(1);

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'identidadC' => 'El número de identidad es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_N115_nuevo_cliente_validar_campo_identidadC_digits()
    {
        $user = User::find(1);

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041996090909090909090909090',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N116_nuevo_cliente_validar_campo_identidadC_digits_mensaje()
     {
         $user = User::find(1);

         DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
         $response = $this->actingAs($user)->post(
             route('cliente.store'),
             [
                 'identidadC' => '07041996090909090909090909090',
                 'nombreCompleto'   => 'ManuelRodriguez',
                 'telefono'  => '99989900',
                 'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                 'fechaNacimiento' => '18-04-1996',
             ]
         );

         $response->assertInvalid([
             'identidadC' => 'El número de identidad debe tener 13 dígitos.',
         ]);
     }

    public function test_N117_nuevo_cliente_validar_campo_identidadC_unico()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N118_nuevo_cliente_validar_campo_identidadC_unico_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => $cliente->identidadC,
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'identidadC' => 'El número de identidad debe ser único.',
        ]);
    }

    public function test_N119_nuevo_cliente_validar_campo_identidadC_solo_numeros()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => 'identidad',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N120_nuevo_cliente_validar_campo_identidadC_solo_numeros_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => 'identidad',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'identidadC' => 'En la identidad sólo se permiten números ',
        ]);
    }


    public function test_N121_nuevo_cliente_validar_campo_identidadC_formato_invalido()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '0704-1997-098938',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N122_nuevo_cliente_validar_campo_identidadC_formato_invalido_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where nombreCompleto = ?', ['ManuelRodriguez']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '0704-1997-098938',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'identidadC' => 'El formato para el número de identidad no es válido.',
        ]);
    }

    public function test_N123_nuevo_cliente_validar_campo_nombreCompleto_vacio()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => '',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N124_nuevo_cliente_validar_campo_nombreCompleto_vacio_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => '',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'nombreCompleto' => 'El nombre del cliente es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_N125_nuevo_cliente_validar_campo_nombreCompleto_solo_letras()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => '12312312',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N126_nuevo_cliente_validar_campo_nombreCompleto_solo_letras_mensaje()
     {
         $user = User::find(1);

         $cliente = Cliente::all()->first();

         DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
         $response = $this->actingAs($user)->post(
             route('cliente.store'),
             [
                 'identidadC' => '07041997009230',
                 'nombreCompleto'   => '123123',
                 'telefono'  => '99989900',
                 'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                 'fechaNacimiento' => '18-04-1996',
             ]
         );

         $response->assertInvalid([
             'nombreCompleto' => 'En el nombre sólo se permite letras.',
         ]);
     }

    public function test_N127_nuevo_cliente_validar_campo_nombreCompleto_formato_invalido()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'manuel',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N128_nuevo_cliente_validar_campo_nombreCompleto_formato_invalido_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'manuel',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([

            'nombreCompleto' => 'El nombre debe iniciar con mayúscula, solo permite un espacio entre ellos y no se permiten números.',
        ]);
    }

    public function test_N129_nuevo_cliente_validar_campo_telefono_vacio()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N130_nuevo_cliente_validar_campo_telefono_vacio_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono del cliente es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_N131_nuevo_cliente_validar_campo_telefono_solo_numeros()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => 'telefono',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N132_nuevo_cliente_validar_campo_telefono_solo_numeros_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => 'telefono',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono debe contener sólo números.',
        ]);
    }

    public function test_N133_nuevo_cliente_validar_campo_telefono_digits_8()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '989898989898',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

 public function test_N134_nuevo_cliente_validar_campo_telefono_digits_8_mensaje()
 {
     $user = User::find(1);

     $cliente = Cliente::all()->first();

     DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
     $response = $this->actingAs($user)->post(
         route('cliente.store'),
            [
             'identidadC' => '07041997009230',
             'nombreCompleto'   => 'ManuelRodriguez',
             'telefono'  => '989898989898',
             'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
             'fechaNacimiento' => '18-04-1996',
         ]
     );

     $response->assertInvalid([
         'telefono' => 'El teléfono debe contener 8 dígitos.',
     ]);
 }

    public function test_N135_nuevo_cliente_validar_campo_telefono_formato_invalido_2_3_8_9()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '78800000',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N136_nuevo_cliente_validar_campo_telefono_formato_invalido_2_3_8_9_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '78800000',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'telefono' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
        ]);
    }

    public function test_N137_nuevo_cliente_validar_campo_telefono_unico()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  =>  $cliente->telefono,
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N138_nuevo_cliente_validar_campo_telefono_unico_mensaje()
     {
         $user = User::find(1);

         $cliente = Cliente::all()->first();

         DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
         $response = $this->actingAs($user)->post(
             route('cliente.store'),
             [
                 'identidadC' => '07041997009230',
                 'nombreCompleto'   => 'ManuelRodriguez',
                 'telefono'  =>  $cliente->telefono,
                 'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                 'fechaNacimiento' => '18-04-1996',
             ]
         );

         $response->assertInvalid([
             'telefono' => 'El número de teléfono ya está en uso.',
         ]);
     }

    public function test_N139_nuevo_cliente_validar_campo_telefono_unico()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  =>  $cliente->telefono,
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

     public function test_N140_nuevo_cliente_validar_campo_telefono_unico_mensaje()
     {
         $user = User::find(1);

         $cliente = Cliente::all()->first();

         DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
         $response = $this->actingAs($user)->post(
             route('cliente.store'),
             [
                 'identidadC' => '07041997009230',
                 'nombreCompleto'   => 'ManuelRodriguez',
                 'telefono'  =>  $cliente->telefono,
                 'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                 'fechaNacimiento' => '18-04-1996',
             ]
         );

         $response->assertInvalid([
             'telefono' => 'El número de teléfono ya está en uso.',
         ]);
     }

    public function test_N141_nuevo_cliente_validar_campo_fechaNacimiento_vacio()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N142_nuevo_cliente_validar_campo_fechaNacimiento_vacio_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '',
            ]
        );

        $response->assertInvalid([
            'fechaNacimiento' => 'La fecha de nacimiento del cliente es obligatorio, no puede estar vacío.',
        ]);
    }

    public function test_N143_nuevo_cliente_validar_campo_fechaNacimiento_formato_invalido()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '1996-18-04',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N144_nuevo_cliente_validar_campo_fechaNacimiento_formato_invalido_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '1246 Lehner Viaduct Port Vernon, CO 86152-1254',
                'fechaNacimiento' => '1996-18-04',
            ]
        );

        $response->assertInvalid([
            'fechaNacimiento' => 'Debe ser mayor de edad.',
        ]);
    }

    public function test_N145_nuevo_cliente_validar_campo_direccion_vacio()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N146_nuevo_cliente_validar_campo_direccion_vacio_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => '',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'direccion' => 'La dirección del cliente es obligatoria, no puede estar vacío.',
        ]);
    }

    public function test_N147_nuevo_cliente_validar_campo_direccion_min_10_caracteres()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => 'hola',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N148_nuevo_cliente_validar_campo_direccion_min_10_caracteres_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => 'hola',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'direccion' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
        ]);
    }

    public function test_N149_nuevo_cliente_validar_campo_direccion_max_150_caracteres()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => 'hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola ',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertStatus(302);
    }

    public function test_N150_nuevo_cliente_validar_campo_direccion_max_150_caracteres_mensaje()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        DB::delete('delete from clientes where identidadC = ?', ['07041997009230']);
        $response = $this->actingAs($user)->post(
            route('cliente.store'),
            [
                'identidadC' => '07041997009230',
                'nombreCompleto'   => 'ManuelRodriguez',
                'telefono'  => '99989900',
                'direccion'       => 'hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola hola ',
                'fechaNacimiento' => '18-04-1996',
            ]
        );

        $response->assertInvalid([
            'direccion' => 'La dirección sobrepasa el límite de caracteres',
        ]);
    }

    public function test_N151_detalle_clientes_antes_de_logueo()
    {
        $cliente = Cliente::all()->first();

        $response = $this->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertRedirect(route('login'));
    }

    public function test_N152_detalle_clientes_despues_de_logueo()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertStatus(200);
    }

    public function test_N153_detalle_clientes_id_negativo()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => -1]));
        $response->assertStatus(404);
    }

    public function test_N154_detalle_clientes_id_texto()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => 'id']));
        $response->assertStatus(404);
    }

    public function test_N155_detalle_clientes_id_decimales()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => 9.0980898898]));
        $response->assertStatus(404);
    }

    public function test_N156_detalle_clientes_etiquetass_correctas_identidadC()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertSeeText($cliente->identidadC);
    }

    public function test_N157_detalle_clientes_etiquetass_correctas_nombreCompleto()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertSeeText($cliente->nombreCompleto);
    }


    public function test_N158_detalle_clientes_etiquetass_correctas_telefono()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertSeeText($cliente->telefono);
    }

    public function test_N159_detalle_clientes_etiquetass_correctas_direccion()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertSeeText($cliente->direccion);
    }

    public function test_N160_detalle_clientes_etiquetass_correctas_fechaNacimiento()
    {
        $user = User::find(1);

        $cliente = Cliente::all()->first();

        $response = $this->actingAs($user)->get(route('cliente.show', ['id' => $cliente->id]));
        $response->assertSeeText($cliente->fechaNacimiento);
    }


}