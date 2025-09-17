@extends('layouts.plantilla')
@section('title','home')
@section('content')

<header>

    <nav>
        <a href="/jugador/index">Jugadores</a>
        <form method="post" action="{{route('logout')}}">
            @csrf
            <input type="submit" value="Cerrar Sesion">

        </form>
    </nav>
</header>


@endsection
