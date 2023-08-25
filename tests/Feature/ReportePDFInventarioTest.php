<?php
namespace Tests\Feature;
use App\Models\Inventario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ReportePDFInventarioTest extends TestCase
{
    public function test_Validar_ruta_del_boton_PDF_de_listado_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventario/pdf');
        $response->assertStatus(200);
    }


    public function test_Validar_ruta_invalida_del_boton_PDF_de_listado_de_inventario()
    {
        $user = User::findOrFail(1);
        Auth::login($user);

        $response = $this->get('/inventarios/pdf');
        $response->assertStatus(404);
    }
}