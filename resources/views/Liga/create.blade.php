@extends('layouts.plantilla')
@section('title','Crear Liga')
@section('content')


    <h1>Crea tu liga</h1>

    <form action="{{route('liga.store')}}" method="post"  enctype="multipart/form-data">

        @csrf


        <label>
            Nombre de la liga:
            <input type="text" name="nombre" required>
        </label><br>

        <label>
            Logo de la liga:
            <input type="file" name="archivoImagen" accept="image/*">
        </label><br>

        <input type="submit" value="Crear liga">


    </form>


@endsection
