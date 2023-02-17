<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\API\ActividadController;
use App\Http\Controllers\API\ActividadesClienteController;
use App\Http\Controllers\API\GaleriaClienteController;
use App\Http\Controllers\API\GaleriaController;
use App\Http\Controllers\API\GaleriaActividadController;
use App\Http\Controllers\API\RepositorioArchivosController;
use App\Http\Controllers\API\CapacitacionController;
use App\Http\Controllers\API\ReservaCapacitacionController;
use App\Http\Controllers\CapacitacionesFormController;




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

/*
Route::get('/', function () {
    return redirect()->action([HomeController::class, 'index']);
});
*/
//RUTAS PARA EL CLIENTE SIN SEGURIDAD
Route::get('/', [App\Http\Controllers\ClienteController::class, 'index'])->name('inicio');
Route::get('/repositorioNimbu', [App\Http\Controllers\ClienteController::class, 'repositorio'])->name('repositorio');
Route::get('/capacitacionInfo', [App\Http\Controllers\ClienteController::class, 'capacitacionInfo'])->name('capacitacionInfo'); //Tried to emulate process to render capacitacionInfo view
Route::get('/inicio', [App\Http\Controllers\ClienteController::class, 'index'])->name('iniciov2');
Route::get('/acerca', [App\Http\Controllers\ClienteController::class, 'acerca'])->name('acerca');
Route::get('/actividadesNimbu', [App\Http\Controllers\ClienteController::class, 'actividades'])->name('NimbuActividades');
Route::get('/galeriaNimbu', [App\Http\Controllers\ClienteController::class, 'galeria'])->name('NimbuGaleria');
Route::get('/galeriaActividadNimbu', [App\Http\Controllers\ClienteController::class, 'galeriaActividad'])->name('NimbuGaleriaActividad');
Route::get('/reservacionNimbu/{idCapacitacion?}', [App\Http\Controllers\ClienteController::class, 'reservarCapacitacion'])->name('reservarCapacitacion');
Route::post('/reservaCliente', [App\Http\Controllers\ClienteController::class, 'reservaCliente'])->name('reservaCliente');
Route::get('/galeriaNimbuFiltro/{filtro?}', [App\Http\Controllers\ClienteController::class, 'galeriaFiltro'])->name('NimbuGaleriaFiltro#2');
Route::get('/galeriaActividadNimbuFiltro/{filtro?}', [App\Http\Controllers\ClienteController::class, 'galeriaActividadFiltro'])->name('NimbuGaleriaActividadFiltro');


//RUTAS PARA EL CLIENTE CON SEGURIDAD
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Auth::routes();


Route::resource('galeriaCliente', GaleriaClienteController::class);
Route::resource('actividadesCliente', ActividadesClienteController::class);
Route::resource('users', UsersController::class);
Route::resource('actividades', ActividadController::class);
Route::resource('galeria', GaleriaController::class);
Route::resource('galeriaActividad', GaleriaActividadController::class);
Route::resource('repositorioDocumento', RepositorioArchivosController::class);
Route::resource('capacitacion', CapacitacionController::class);
Route::resource('reserva', ReservaCapacitacionController::class);
Route::put('/repositorioDocumento/actualizar', [RepositorioArchivosController::class, 'actualizar'])->name('repositorioDocumento.actualizar');
