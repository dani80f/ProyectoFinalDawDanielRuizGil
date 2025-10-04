@extends('layouts.plantilla')
@section('title','Eliminar '. $equipo->nombre)
@section('content')




<form action="{{route('equipo.destroy',$equipo->id)}}" method="post">

    @csrf
    @method('delete')

    <h1>Seguro de que quiere borrar el equipo {{$equipo->nombre}}</h1>
    <input class="btn btn-primary" type="submit" value="Eliminar">

</form>

@endsection
