@extends('layouts.plantilla')
@section('title','Editar '. $equipo->nombre)
@section('content')

    <form action="{{route('equipo.update')}}" method="post"  enctype="multipart/form-data">

        @csrf
        @method('put')

        <input type="number" value="{{$equipo->id}}" readonly name="id"><br>
        Nombre:<input type="text" name="nombre" value="{{$equipo->nombre}}"><br>
        <label>
            Imagen actual
            <img src="{{ asset($equipo->imagen) }}" style="max-width: 200px;">
            <input type="file" name="imagen" accept="image/*">
        </label><br>

        <input type="number" value="{{$equipo->id_creador}}" readonly name="idCreador"><br>
        <input type="submit" value="Actualizar equipo">


    </form>


@endsection
