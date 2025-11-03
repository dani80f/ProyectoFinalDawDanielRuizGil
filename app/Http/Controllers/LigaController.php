<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Liga;
use App\Models\LigaEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LigaController extends Controller
{

    public function index(){

        return redirect('http://localhost:4200/liga');

    }

    public function api()
    {
        if (!Auth::check()) {
            redirect('/login');
        }


        $ligas = Liga::where('user_id', Auth::id())->get();


        return response()->json($ligas);

    }

    public function create(){

        return view('liga.create');
    }

    public function store(Request $request){

        $liga=new Liga();

        if ($request->hasFile('archivoImagen')) {


            $imagen = $request->file('archivoImagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes'), $nombreImagen);
            $imagenUrl = 'imagenes/' . $nombreImagen;

            $liga->imagen = $imagenUrl;
        }

        $liga->nombre=$request->nombre;
        $liga->user_id=Auth::user()->id;
        $liga->numero_equipos=0;
        $liga->save();

        return redirect()->route('liga.index');


    }

    public function anadirEquipo($id){

        $liga=Liga::find($id);
        $equipos=Equipo::all();
        return view('liga.anadirEquipo',compact('liga','equipos'));


    }

    public function updateEquipos(Request $request){

        $equipo=Equipo::find($request->input('id_equipo'));
        $liga=Liga::find($request->input('id_liga'));


        if ($liga->numero_equipos >20){
            return;
        }

        //Añadir otra comprobacion para que no haya equipos repetidos (facilito AB)

        $equiposJson=$liga->equipos;
        $equipos = json_decode($equiposJson, true) ?? [];

        if (!in_array($equipo->id, $equipos)) {
            $equipos[] = $equipo->id; // guardamos solo el ID
            $liga->equipos = json_encode($equipos);
            $liga->numero_equipos = $liga->numero_equipos + 1;
            $liga->save();

            return back()->with('success', 'Equipo añadido correctamente.');
        } else {
            return back()->with('info', 'El equipo ya está en la liga.');
        }




    }

    public function delete($id){

        $liga=Liga::find($id);
        return view('liga.delete')->with('liga',$liga);

    }

    public function destroy($id)
    {

        $liga= Liga::find($id);


        if ($liga->imagen && file_exists(public_path($liga->imagen))) {
            unlink(public_path($liga->imagen));
        }



        $liga->delete();
        return response()->json(['message' => 'Eliminado correctamente']);


    }

    public function empezarLiga($id){

        $liga= Liga::find($id);

        if ($liga->numero_equipos !=20){

            return-redirect()->back()->with('info', 'No hay suficiente equipos en la liga.');

        }

        //Añadir aqui toodos los equipos ha liga_equipo

        $equipos=json_decode($liga->equipos,false);

        foreach ($equipos as $equipo){

            $ligaEquipo=new LigaEquipo();
            $ligaEquipo->id_liga=$id;
            $ligaEquipo->id_equipo=$equipo;
            $ligaEquipo->elegido=false;
            $ligaEquipo->media=0;
            $ligaEquipo->save();




        }



        $liga->iniciada=true;
        $liga->update();
        return redirect('http://localhost:4200/liga');



    }



}
