@extends('busqueda.buscar')
@section('seleccionar')
    Datos Personales
@endsection
@section('buscarContent')
<div class="form-group">
    <form class="form-group" files="true" method="GET" action="/busqueda/buscar-datos-personales">
        <div>
            <div>
                <i></i>
                <label for="">Nombres <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="nombres" required autofocus>
                
            </div>

            <div>
                <i></i>
                <label for="">Apellido Paterno <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="apellido_paterno" required autofocus>
                
            </div>

            <div>
                <i></i>
                <label for="">Apellido Materno <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="apellido_materno" required autofocus>
                
            </div>

            <div>
                <i></i>
                <label for="">RFC <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="rfc" required autofocus>
                
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i>Buscar</i></button>
    </form>
</div>
@endsection