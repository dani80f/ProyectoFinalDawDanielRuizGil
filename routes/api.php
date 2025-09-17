<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/usuario', function (Request $request) {
    return response()->json([
        'nombre' => $request->user()->name
    ]);
})->middleware('auth:sanctum');
