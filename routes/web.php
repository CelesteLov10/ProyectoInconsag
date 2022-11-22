<?php

use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**Route::get('/principal', PrincipalController::class, 'index')->name('principal');*/
Route::controller(PuestoController::class)->group(function(){  
    //Ruta para listado de cargos
    Route::get('/puesto', 'index')->name('puestoLaboral.index');
    //Ruta para crear un "nuevo puesto laboral"
    Route::get('/puesto/create', 'create')->name('puestoLaboral.create');
    //Ruta para guardar los registros
    Route::post('/puesto', 'store')->name('puestoLaboral.store'); 
    //Ruta para editar un puesto laboral
    Route::get('/puesto/{id}/edit', 'edit')->name('puestoLaboral.edit');
    //Ruta para el metodo editar
    Route::put('/puesto/{id}/edit', 'update')->name('puestoLaboral.update'); 
}); 

Route::controller(EmpleadoController::class)->group(function(){
    //Ruta para listado de empleados
    Route::get('/empleado', 'index')->name('empleado.indexEmp');
    //Ruta para mostrar un empleado
    Route::get('/empleado/{id}', 'show')->name('empleado.showEmp')
    ->where('id','[0-9]+');
    //Ruta para crear un "nuevo empleado"
    Route::get('/empleado/create', 'create')->name('empleado.createEmp');
    //Ruta para guardar los registros del empleado
    Route::post('/empleado', 'store')->name('empleado.storeEmp');
    //Ruta para editar un empleado
    Route::get('/empleado/{id}/edit', 'edit')->name('empleado.editEmp');
    //Ruta para el metodo editar
    Route::put('/empleado/{id}/edit', 'update')->name('empleado.update');
});

    //Ruta para el campo de busqueda empleado
Route::controller(SearchController::class)->group(function(){
    //Ruta para listado de empleados
    Route::get('search/empleado', 'empleado')->name('empleado.search');
    //Ruta para listado puesto
    Route::get('search/puesto', 'puesto')->name('puesto.search');
    //Ruta para listado inventario
    Route::get('search/inventario', 'inventario')->name('inventario.search');
    //Ruta para listado oficina
    Route::get('search/oficina', 'oficina')->name('oficina.search');
    //Ruta para listado proveedor:
    Route::get('search/proveedor', 'proveedor')->name('proveedor.search');
    //Ruta para listado maquinaria:
    Route::get('search/maquinaria', 'maquinaria')->name('maquinaria.search');
    //Ruta para listado Bloque:
    Route::get('search/bloque', 'bloque')->name('bloque.search');
    //Ruta para listado cliente
    Route::get('search/cliente', 'cliente')->name('cliente.search');
    
});

Route::controller(InventarioController::class)->group(function(){
    //Ruta para listado de inventario
    Route::get('/inventario', 'index')->name('inventario.index');
    //Ruta para mostrar un inventario
    Route::get('/inventario/{id}', 'show')->name('inventario.show')
    ->where('id','[0-9]+');
    //Ruta para crear un "nuevo inventario"
    Route::get('/inventario/create', 'create')->name('inventario.create');
    //Ruta para guardar los registros del inventario
    Route::post('/inventario', 'store')->name('inventario.store');
    //Ruta para editar un inventario
    Route::get('/inventario/{id}/edit', 'edit')->name('inventario.edit');
    //Ruta para el metodo editar
    Route::put('/inventario/{id}/edit', 'update')->name('inventario.update');
    //Ruta para imprimir el listado del inventario
    Route::get('/inventario/pdf', 'pdf')->name('inventario.pdf');
});

Route::controller(OficinaController::class)->group(function(){
    //Ruta para listado de oficina
    Route::get('/oficina', 'index')->name('oficina.index');
    //Ruta para mostrar un oficina
    Route::get('/oficina/{id}', 'show')->name('oficina.show')
    ->where('id','[0-9]+');
    //Ruta para crear un "nuevo oficina"
    Route::get('/oficina/create', 'create')->name('oficina.create');
    //Ruta para guardar los registros del oficina
    Route::post('/oficina', 'store')->name('oficina.store');
    //Ruta para editar un oficina
    Route::get('/oficina/{id}/edit', 'edit')->name('oficina.edit');
    //Ruta para el metodo editar
    Route::put('/oficina/{id}/edit', 'update')->name('oficina.update');
    // muestra los registros de la tabla municipios
    Route::post('/getMunicipios/{id}', 'getMunicipios');
    Route::get('/getMunicipios/{id}', 'getMunicipios');
});

Route::controller(ProveedorController::class)->group(function(){
    //Ruta para listado de proveedores
    Route::get('/proveedor', 'index')->name('proveedor.index');
    //Ruta para crear un nuevo proveedor
    Route::get('/proveedor/create', 'create')->name('proveedor.create');
    //Ruta para guardar los registros del proveedor
    Route::post('/proveedor', 'store')->name('proveedor.store');
    //Ruta para mostrar un proveedores
    Route::get('/proveedor/{id}', 'show')->name('proveedor.show')
    ->where('id','[0-9]+');
    //Ruta para editar un proveedor
    Route::get('/proveedor/{id}/edit', 'edit')->name('proveedor.edit');
    //Ruta para el metodo editar
    Route::put('/proveedor/{id}/edit', 'update')->name('proveedor.update');
});

Route::controller(MaquinariaController::class)->group(function(){
    //Ruta para listado de proveedores
    Route::get('/maquinaria', 'index')->name('maquinaria.index');
    //Ruta para crear un nuevo maquinaria
    Route::get('/maquinaria/create', 'create')->name('maquinaria.create');
    //Ruta para guardar los registros del maquinaria
    Route::post('/maquinaria', 'store')->name('maquinaria.store');
    //Ruta para mostrar un maquinariaes
    Route::get('/maquinaria/{id}', 'show')->name('maquinaria.show')
    ->where('id','[0-9]+');
    //Ruta para editar un maquinaria
    Route::get('/maquinaria/{id}/edit', 'edit')->name('maquinaria.edit');
    //Ruta para el metodo editar
    Route::put('/maquinaria/{id}/edit', 'update')->name('maquinaria.update');
    //Ruta para imprimir el listado de maquinaria
    Route::get('/maquinaria/pdf', 'pdf')->name('maquinaria.pdf');
});

Route::controller(BloqueController::class)->group(function(){
    //Ruta para listado de bloque
    Route::get('/bloque', 'index')->name('bloque.index');
    //Ruta para crear un nuevo bloque
    Route::get('/bloque/create', 'create')->name('bloque.create');
    //Ruta para guardar los registros de bloque
    Route::post('/bloque', 'store')->name('bloque.store');
    //Ruta para mostrar un bloque
    Route::get('/bloque/{id}', 'show')->name('bloque.show')
    ->where('id','[0-9]+');
});

//Ruta para bloques
Route::controller(LoteController::class)->group(function(){

    //Ruta para crear un "nuevo lote"
    Route::get('/lote/create', 'create')->name('lote.create');
    //Ruta para guardar los registros del lote
    Route::post('/lote', 'store')->name('lote.store');
   

});

//Ruta para cliente
Route::controller(ClienteController::class)->group(function(){
    //Ruta para listado de cliente
    Route::get('/cliente', 'index')->name('cliente.index');
    //Ruta para crear un nuevo cliente
    Route::get('/cliente/create', 'create')->name('cliente.create');
    //Ruta para guardar los registros del cliente
    Route::post('/cliente', 'store')->name('cliente.store');
    //Ruta para mostrar un cliente
    Route::get('/cliente/{id}', 'show')->name('cliente.show')
    ->where('id','[0-9]+');
    //Ruta para editar un cliente
    Route::get('/cliente/{id}/edit', 'edit')->name('cliente.edit');
    //Ruta para el metodo editar
    Route::put('/cliente/{id}/edit', 'update')->name('cliente.update');
    //Ruta para imprimir el listado de cliente
    Route::get('/cliente/pdf', 'pdf')->name('cliente.pdf');

});

//Ruta para beneficiario
Route::controller(BeneficiarioController::class)->group(function(){
    //Ruta para listado de beneficiario
    Route::get('/beneficiario', 'index')->name('beneficiario.index');
    //Ruta para crear un nuevo beneficiario
    Route::get('/beneficiario/create', 'create')->name('beneficiario.create');
    //Ruta para guardar los registros del beneficiario
    Route::post('/beneficiario', 'store')->name('beneficiario.store');
    //Ruta para mostrar un beneficiarioes
    Route::get('/beneficiario/{id}', 'show')->name('beneficiario.show')
    ->where('id','[0-9]+');
    //Ruta para editar un beneficiario
    Route::get('/beneficiario/{id}/edit', 'edit')->name('beneficiario.edit');
    //Ruta para el metodo editar
    Route::put('/beneficiario/{id}/edit', 'update')->name('beneficiario.update');
    //Ruta para imprimir el listado de beneficiario
    Route::get('/beneficiario/pdf', 'pdf')->name('beneficiario.pdf');

});