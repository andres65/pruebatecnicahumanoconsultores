<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoDocumentosController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\HabitacionesController;
use App\Http\Controllers\ReservasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {  return redirect('login'); });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('tipodocumento', TipoDocumentosController::class)->middleware(['auth', 'verified']);
Route::resource('empleados', EmpleadosController::class)->middleware(['auth', 'verified']);
Route::resource('clientes', ClientesController::class)->middleware(['auth', 'verified']);
Route::resource('habitaciones', HabitacionesController::class)->middleware(['auth', 'verified']);

//RUTAS MODULO RESERVAS
Route::resource('reservas', ReservasController::class)->middleware(['auth', 'verified']);
Route::post('/reservas-buscar', 'App\Http\Controllers\ReservasController@searchReservation')->middleware(['auth', 'verified'])->name('reservas.buscar');
Route::post('/reservas-guardarcliente', 'App\Http\Controllers\ReservasController@guardarCliente')->middleware(['auth', 'verified'])->name('reservas.guardarcliente');
Route::post('/reservas-buscarcliente', 'App\Http\Controllers\ReservasController@buscarCliente')->middleware(['auth', 'verified'])->name('reservas.buscarcliente');
Route::get('/reservas-listareservas', 'App\Http\Controllers\ReservasController@listaReservas')->middleware(['auth', 'verified'])->name('reservas.listareservas');
Route::get('/reservas-agendareservas', 'App\Http\Controllers\ReservasController@agendaReservas')->middleware(['auth', 'verified'])->name('reservas.agendareservas');

require __DIR__.'/auth.php';
