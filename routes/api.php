<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->get('/user', function (Request $request) {
        return response()->json($request->user());
    });
