<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\LigaEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LigaEquipoController extends Controller
{
    public function index(){

        return redirect('http://localhost:4200/ligaJuego');

    }

    public function api($idLiga)
    {
        if (!Auth::check()) {
            redirect('/login');

        }


        $equipos = Equipo::whereIn('id', function($query) use ($idLiga) {

            $query->select('id_equipo')
                ->from('liga_equipo')
                ->where('id_liga', $idLiga);

        })->get();




        return response()->json($equipos);

    }

    public function api2($idLiga)
    {
        if (!Auth::check()) {
            redirect('/login');

        }


        $equipos = LigaEquipo::where('id_liga', $idLiga)->get();




        return response()->json($equipos);

    }

    public function edit(Request $request, $idLiga)
    {

        if (!Auth::check()) {
            redirect('/login');

        }
        $id_equipo = $request->input('id_equipo');
        $ligaEquipo = LigaEquipo::where('id_equipo', $id_equipo)->where('id_liga', $idLiga)->first();

       $this->update($id_equipo,$ligaEquipo,$idLiga);



    }

    public function update($id_equipo, $ligaEquipo, $idLiga)
    {

        $ligaEquipo->elegido = true;
        $ligaEquipo->update();

        return redirect('http://localhost:4200/ligaJuego');



    }


}
