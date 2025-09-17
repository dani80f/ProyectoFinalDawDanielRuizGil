<?php

use App\Http\Controllers\JugadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('http://localhost:4200/');
});

Route::get('/usuario', function (Request $request) {
    return response()->json([
        'nombre' => $request->user()->name
    ]);
})->middleware('auth:sanctum');




//Jugadores
Route::middleware('auth')->group(function () {

    Route::get('/jugador/index', [JugadorController::class, 'index'])->name('jugador.index')->middleware('auth','admin'); {};
    Route::get('/jugador/create', [JugadorController::class, 'create'])->name('jugador.create'); {};
    Route::post('jugador/create', [JugadorController::class, 'store'])->name('jugador.store'); {};
    Route::get('/jugador/edit{id}', [JugadorController::class, 'edit'])->name('jugador.edit'); {};
    Route::delete('/jugador/destroy{id}', [JugadorController::class, 'destroy'])->name('jugador.destroy'); {};
    Route::put('/jugador/edit', [JugadorController::class, 'update'])->name('jugador.update'); {};

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
