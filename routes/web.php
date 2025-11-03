<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\LigaEquipoController;
use App\Http\Controllers\LigaJugadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('http://localhost:4200/');
});

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return response()
        ->json(['perfil' => $request->user()->perfil]);
});



Route::middleware('auth:sanctum')->group(function () {

    //Jugadores
    Route::get('/jugador/index', [JugadorController::class, 'index'])->name('jugador.index')->middleware('auth','admin'); {};
    Route::get('/jugador/create', [JugadorController::class, 'create'])->name('jugador.create'); {};
    Route::post('jugador/create', [JugadorController::class, 'store'])->name('jugador.store'); {};
    Route::get('/jugador/edit{id}', [JugadorController::class, 'edit'])->name('jugador.edit'); {};
    Route::delete('/jugador/destroy{id}', [JugadorController::class, 'destroy'])->name('jugador.destroy'); {};
    Route::put('/jugador/edit', [JugadorController::class, 'update'])->name('jugador.update'); {};

    //Equipos
    Route::get('/equipo/api', [EquipoController::class, 'api'])->name('equipo.api'); {};
    Route::get('/equipo/misequipos', [EquipoController::class, 'misEquipos'])->name('equipo.misEquipos'); {};
    Route::get('/equipo/index', [EquipoController::class, 'index'])->name('equipo.index'); {};
    Route::get('/equipo/create', [EquipoController::class, 'create'])->name('equipo.create'); {};
    Route::post('/equipo/create', [EquipoController::class, 'store'])->name('equipo.store'); {};
    Route::get('/equipo/delete/{id}', [EquipoController::class, 'delete'])->name('equipo.delete'); {};
    Route::delete('/equipo/destroy/{id}', [EquipoController::class, 'destroy'])->name('equipo.destroy'); {};
    Route::get('/equipo/edit/{id}', [EquipoController::class, 'edit'])->name('equipo.edit'); {};
    Route::put('/equipo/edit', [EquipoController::class, 'update'])->name('equipo.update'); {};

    //Ligas
    Route::get('/liga/api', [LigaController::class, 'api'])->name('liga.api'); {};
    Route::get('/liga/create', [LigaController::class, 'create'])->name('liga.create'); {};
    Route::post('liga/create', [LigaController::class, 'store'])->name('liga.store'); {};
    Route::get('/liga/index', [LigaController::class, 'index'])->name('liga.index'); {};
    Route::get('/liga/anadirEquipos/{id}', [LigaController::class, 'anadirEquipo'])->name('liga.anadirEquipo'); {};
    Route::post('/liga/updateEquipos', [LigaController::class, 'updateEquipos'])->name('liga.updateEquipos'); {};
    Route::get('/liga/delete/{id}', [LigaController::class, 'delete'])->name('liga.delete'); {};
    Route::delete('/liga/destroy/{id}', [LigaController::class, 'destroy'])->name('liga.destroy'); {};
    Route::get('/liga/empezarLiga/{id}', [LigaController::class, 'empezarLiga'])->name('liga.empezarLiga'); {};

    //Ligas-Equipo
    Route::get('/ligaEquipo/api/{idLiga}', [LigaEquipoController::class, 'api'])->name('ligaEquipo.api'); {};
    Route::get('/ligaEquipo/api2/{idLiga}', [LigaEquipoController::class, 'api2'])->name('ligaEquipo.api2'); {};
    Route::get('/ligaEquipo/index', [LigaEquipoController::class, 'index'])->name('liga.index'); {};
    Route::get('/ligaEquipo/update/{idLiga}', [LigaEquipoController::class, 'edit'])->name('ligaEquipo.edit'); {};
    Route::put('/ligaEquipo/update/{idLiga}', [LigaEquipoController::class, 'update'])->name('ligaEquipo.update'); {};

    //Ligas-Jugadores
    Route::get('/ligaJugador/api/{idLiga}', [LigaJugadorController::class, 'api'])->name('ligaJugador.api'); {};
    Route::get('/ligaJugador/api2/{idLiga}', [LigaJugadorController::class, 'api2'])->name('ligaJugador.api2'); {};
    Route::get('ligaJugador/store/{id_jugador}', [LigaJugadorController::class, 'store'])->name('ligaJugador.store');
    Route::get('/ligaJugador/index', [LigaJugadorController::class, 'index'])->name('ligaJugador.index'); {};







});








Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
