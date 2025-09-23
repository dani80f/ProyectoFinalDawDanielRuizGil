<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
    public function index(){

        return redirect('http://localhost:4200/equipo');
    }

    public function api(){

        $equipos=Equipo::all();

        //return $equipos;
        return response()->json($equipos);
    }

    public function create(){

        return view('equipo.create');
    }
    public function store(Request $request){

        $equipo=new Equipo();

        if ($request->hasFile('archivoImagen')) {


            $imagen = $request->file('archivoImagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $imagenUrl = 'imagenes/' . $nombreImagen;

            $equipo->imagen = $imagenUrl;
        }

        $equipo->nombre=$request->nombre;
        $equipo->id_creador=Auth::user()->id;
        $equipo->save();
        //return redirect('equipo/index');
        return redirect()->route('equipo.index');



    }


}
