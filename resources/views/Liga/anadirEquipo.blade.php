@extends('layouts.plantilla')
@section('title','Añadir equipo a ' . $liga->nombre)
@section('content')


    <div>

        <a href="http://localhost:4200/liga">Volver a ligas</a>

        <table>
        @foreach($equipos as $equipo)

            <tr>

                <td><img src="{{'http://localhost:8000/' . $equipo->imagen}}" style="max-height: 200px"></td>
                <td>{{$equipo->nombre}}</td>

                @if($liga->equipos!=Null)

                    @if(in_array($equipo->id, json_decode($liga->equipos, true)))
                        <td><span>Incluido</span></td>
                    @else

                        <td><div><form action="{{route('liga.updateEquipos')}}" method="post">@csrf<input type="hidden" name="id_liga" value="{{$liga->id}}"><input type="hidden" name="id_equipo" value="{{$equipo->id}}"><input type="submit" value="Añadir equipo"></form></div></td>

                    @endif

                @else

                    <td><div><form action="{{route('liga.updateEquipos')}}" method="post">@csrf<input type="hidden" name="id_liga" value="{{$liga->id}}"><input type="hidden" name="id_equipo" value="{{$equipo->id}}"><input type="submit" value="Añadir equipo"></form></div></td>


                @endif


            </tr>


        @endforeach

        </table>

    </div>

@endsection
