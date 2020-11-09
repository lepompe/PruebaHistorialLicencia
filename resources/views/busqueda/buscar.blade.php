@extends('layouts.app')

@section('title', 'Buscar')

@section('content')
<div class="form-group">
    <h2>BUSQUEDA</h2>
    <hr>
    <label for="">Puedes realizar la busqueda por cualquiera de este métodos:</label>
</div>
<div class="form-group">
    <form class="form-group" files="true" method="GET" action="/busqueda/vista-datos">
        <div>
            <div>
                <label for="">Nombres <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="nombres" required autofocus>
                
            </div>

            <div>
                <label for="">Apellido Paterno <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="apellido_paterno" required autofocus>
                
            </div>

            <div>
                <label for="">Apellido Materno <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="apellido_materno" required autofocus>
                
            </div>

            <div>
                <label for="">Clave Única de Registro de Población (CURP) <label style="color: red"> *</label></label>
            </div>
            
            <div>
                <input type="search" name="curp" required autofocus>
                
            </div>

            <div>
                <label for="">Numero de licencia <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="numero_licencia" required autofocus>
                
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i>Buscar</i></button>
    </form>
</div>
@endsection
