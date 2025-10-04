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

        if (!Auth::check()) {
            redirect('/login');
        }

        //return $equipos;
        return response()->json($equipos);
    }

    public function misEquipos()
    {

        $equipos=Equipo::where('id_creador',Auth::id())->get();
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

    public function delete($id)
    {

        $equipo=Equipo::find($id);
        return view('equipo.delete')->with('equipo',$equipo);


    }

    public function edit($id)
    {
        $equipo=Equipo::find($id);
        return view('equipo.edit')->with('equipo',$equipo);

    }

    public function update(Request $request){

        $id=$request->id;
        $equipo = Equipo::find($id);

        if ($request->hasFile('imagen')) {


            if ($equipo->imagen && file_exists(public_path($equipo->imagen))) {
                unlink(public_path($equipo->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $imagenUrl = 'imagenes/' . $nombreImagen;

            $equipo->imagen = $imagenUrl;
        }

        $equipo->nombre=$request->nombre;
        $equipo->id_creador=$request->idCreador;
        $equipo->save();
        return redirect('http://localhost:4200/equipo');



    }

    public function destroy($id)
    {

        $equipo= Equipo::find($id);


        if ($equipo->imagen && file_exists(public_path($equipo->imagen))) {
            unlink(public_path($equipo->imagen));
        }



        $equipo->delete();
        return response()->json(['message' => 'Eliminado correctamente']);


    }


}
