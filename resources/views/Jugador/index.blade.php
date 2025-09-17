@extends('layouts.plantilla')
@section('title','Administracion de jugadores')
@section('content')


    <form action="{{route('jugador.create')}}" method="get"><input class="btn btn-primary btn-lg" type="submit" value="Añadir jugador"></form>


    @foreach($jugadores as $jugador)

            <div class="card" style="width: 18rem;">
                <img src="{{ asset($jugador->imagen) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$jugador->nombre}} {{$jugador->apellidos}}</h5>
                    <p class="card-text">Posicion:{{$jugador->posicion}}</p>
                    <p class="card-text">Media:{{$jugador->media}}</p>
                    <p class="card-text">Precio:{{$jugador->precio}}</p>
                    <p class="card-text">Creado:{{$jugador->created_at}}</p>
                    <p class="card-text">Modificado:{{$jugador->updated_at}}</p>




                    <form action="{{route('jugador.edit',$jugador)}}" method="get"><input type="submit" value="Editar Jugador"></form>
                    <form action="{{route('jugador.destroy',$jugador)}}" method="post">@csrf @method('delete')<input class="btn btn-primary" type="submit" value="Eliminar"></form>



                </div>
            </div>

        @endforeach
        {{$jugadores->links()}}


@endsection
