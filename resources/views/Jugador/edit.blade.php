@extends('layouts.plantilla')
@section('title','Editando a '. $jugador->nombre.' '. $jugador->apellidos)
@section('content')

    <a href="{{route('jugador.index')}}">Volver a pagina principal de administración</a>

    <form action="{{route('jugador.update')}}" method="post"  enctype="multipart/form-data">

        @csrf
        @method('put')

        <input type="number" value="{{$jugador->id}}" readonly name="id"><br>

        <label>
            Nombre del jugador:
            <input type="text" name="nombre" value="{{$jugador->nombre}}">
        </label><br>

        <label>
            Apellidos del jugador:
            <input type="text" name="apellidos" value="{{$jugador->apellidos}}">
        </label><br>

        <label>
            Imagen del jugador por archivo:
            <input type="file" name="archivoImagen" accept="image/*">
        </label><br>

        @if($jugador->imagen)
            <label>
                Imagen Actual:
                <img src="{{ asset($jugador->imagen) }}" style="max-width: 200px;">
            </label><br>
        @endif

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
            <input type="number" name="media" value="{{$jugador->media}}">
        </label><br>

        <label>
            Precio del jugador:
            <input type="number" name="precio" value="{{$jugador->precio}}">
        </label><br>

        <input type="submit" value="Actualizar jugador">



    </form>
@endsection
