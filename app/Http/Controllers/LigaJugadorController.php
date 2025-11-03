<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\LigaEquipo;
use App\Models\LigaJugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LigaJugadorController extends Controller
{

    public function index(){

        return redirect('http://localhost:4200/ligaJugadores');

    }

    public function api($idLiga)
    {
        if (!Auth::check()) {
            redirect('/login');

        }


        $jugadores=Jugador::all();

        return response()->json($jugadores);

    }

    public function api2($idLiga)
    {
        if (!Auth::check()) {
            redirect('/login');

        }


        $jugadores=LigaJugador::where('id_liga',$idLiga)->get();

        return response()->json($jugadores);

    }

    public function store($id_jugador,Request $request)
    {

        if (!Auth::check()) {
            redirect('/login');
        }

        $equipoElegido=LigaEquipo::where('elegido',1)->first();

        if ($equipoElegido->presupuesto<$request->precio) {

            //Poner una variable o algo para mostarrla en el cliente para que sepa que no se ha fichado AB
            return redirect()->route('ligaJugador.index');

        }

        //Actualizanos el presupuesto
        $equipoElegido->presupuesto=$equipoElegido->presupuesto-$request->precio;
        $equipoElegido->update();

        $id_equipo = (int)$request->id_equipo;
        $id_liga = (int)$request->id_liga;

        $ligaJugador = new LigaJugador();
        $ligaJugador->id_liga=$id_liga;
        $ligaJugador->id_jugador=$id_jugador;
        $ligaJugador->id_equipo=$id_equipo;
        $ligaJugador->clausula=$request->precio*2;
        $ligaJugador->posicion=$request->posicion;
        $ligaJugador->save();
        return redirect()->route('ligaJugador.index');



    }


}
