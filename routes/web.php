<?php

use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InventarioController;
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
    Route::get('puesto', 'index')->name('puestoLaboral.index');
    //Ruta para crear un "nuevo puesto laboral"
    Route::get('puesto/create', 'create')->name('puestoLaboral.create');
    //Ruta para guardar los registros
    Route::post('puesto', 'store')->name('puestoLaboral.store'); 
    //Ruta para editar un puesto laboral
    Route::get('/puesto/{id}/edit', 'edit')->name('puestoLaboral.edit');
    //Ruta para el metodo editar
    Route::put('/puesto/{id}/edit', 'update')->name('puestoLaboral.update'); 
}); 

Route::controller(EmpleadoController::class)->group(function(){
    //Ruta para listado de empleados
    Route::get('empleado', 'index')->name('empleado.indexEmp');
    //Ruta para mostrar un empleado
    Route::get('/empleado/{id}', 'show')->name('empleado.showEmp')
    ->where('id','[0-9]+');
    //Ruta para crear un "nuevo empleado"
    Route::get('empleado/create', 'create')->name('empleado.createEmp');
    //Ruta para guardar los registros del empleado
    Route::post('empleado', 'store')->name('empleado.storeEmp');
    //Ruta para editar un empleado
    Route::get('/empleado/{id}/edit', 'edit')->name('empleado.editEmp');
    //Ruta para el metodo editar
    Route::put('/empleado/{id}/edit', 'update')->name('empleado.update');   
});

    //Ruta para el campo de busqueda empleado
    Route::controller(SearchController::class)->group(function(){
    //Ruta para listado de empleados
    Route::get('search/empleado', 'empleado')->name('empleado.search');
});

    Route::controller(InventarioController::class)->group(function(){
    //Ruta para listado de inventario
    Route::get('inventario', 'index')->name('inventario.index');
    /*Ruta para mostrar un inventario
    Route::get('/inventario/{id}', 'show')->name('inventario.show')
    ->where('id','[0-9]+');*/
    //Ruta para crear un "nuevo inventario"
    Route::get('inventario/create', 'create')->name('inventario.create');
    //Ruta para guardar los registros del inventario
    Route::post('inventario', 'store')->name('inventario.store');
    /*//Ruta para editar un inventario
    Route::get('/inventario/{id}/edit', 'edit')->name('inventario.edit');
    //Ruta para el metodo editar
    Route::put('/inventario/{id}/edit', 'update')->name('inventario.update');*/
});