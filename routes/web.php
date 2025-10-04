<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('http://localhost:4200/');
});

Route::middleware('auth:sanctum')->get('/usuario', function (Request $request) {
    return response()
        ->json(['nombre' => $request->user()->name]);
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
