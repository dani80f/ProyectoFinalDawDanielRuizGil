@extends('layouts.plantilla')
@section('title','Añadir jugador')
@section('content')

    <a href="{{route('jugador.index')}}">Volver a pagina principal de administración</a>

    <form action="{{route('jugador.store')}}" method="post"  enctype="multipart/form-data">

        @csrf


        <label>
            Nombre del jugador:
            <input type="text" name="nombre" required>
        </label><br>

        <label>
            Apellidos del jugador:
            <input type="text" name="apellidos" required>
        </label><br>

        <label>
            Imagen del jugador por archivo:
            <input type="file" name="archivoImagen" accept="image/*">
        </label><br>



        <label>
            Imagen del jugador por url:
            <input type="text" name="urlImagen">
        </label><br>

        <select name="posicion">
            <option value="POR">Portero</option>
            <option value="DEF">Defensa</option>
            <option value="MC">Mediocampista</option>
            <option value="DEL">Delantero</option>

        </select>
        <br>
        <label>
            Media del jugador:
            <input type="number" name="media" required>
        </label><br>

        <label>
            Precio del jugador:
            <input type="number" name="precio">
        </label><br>

        <input type="submit" value="Añadir jugador">



    </form>
@endsection
