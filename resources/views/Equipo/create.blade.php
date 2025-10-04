@extends('layouts.plantilla')
@section('title','Crear Equipo')
@section('content')

    <form action="{{route('equipo.store')}}" method="post"  enctype="multipart/form-data">

        @csrf


        <label>
            Nombre del Equipo:
            <input type="text" name="nombre" required>
        </label><br>

        <label>
            Imagen del jugador por archivo:
            <input type="file" name="archivoImagen" accept="image/*">
        </label><br>

        <input type="submit" value="Añadir equipo">


    </form>



@endsection
