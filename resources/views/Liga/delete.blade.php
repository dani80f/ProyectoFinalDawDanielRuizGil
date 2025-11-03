@extends('layouts.plantilla')
@section('title','Eliminar '. $liga->nombre)
@section('content')




    <form action="{{route('liga.destroy',$liga->id)}}" method="post">

        @csrf
        @method('delete')

        <h1>Seguro de que quiere borrar la liga {{$liga->nombre}}</h1>
        <input class="btn btn-primary" type="submit" value="Eliminar">

    </form>

@endsection
