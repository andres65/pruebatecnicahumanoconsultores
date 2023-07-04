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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('tipodocumento', TipoDocumentosController::class);
Route::resource('empleados', EmpleadosController::class);
Route::resource('clientes', ClientesController::class);
Route::resource('habitaciones', HabitacionesController::class);
Route::resource('reservas', ReservasController::class);

Route::post('/reservas-buscar', 'App\Http\Controllers\ReservasController@searchReservation')->name('reservas.buscar');


require __DIR__.'/auth.php';
