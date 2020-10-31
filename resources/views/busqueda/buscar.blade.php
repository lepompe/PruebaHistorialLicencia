@extends('layouts.app')

@section('title', 'Buscar')

@section('content')
<div class="form-group">
    <h2>BUSQUEDA</h2>
    <hr>
    <label for="">Puedes realizar la busqueda por cualquiera de estos métodos:</label>
    <br>
    <ol>
        <li><p>Con la Clave Única de Registro de Población (CURP)</p></li>
        <li><p>A través de los datos personales</p></li>
    </ol>
    <label for="">Puedes buscar tu licencia por cualquiera de estos métodos <label style="color: red"> *</label></label>
    <br>
    
        <button type="menu" class="btn btn-default dropdown-toggle"  data-toggle="dropdown"> 
           @yield('seleccionar','- Seleccionar -')  <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu">
            <li><a href="{{ url('busqueda/curp') }}">CURP</a></li>
            <li><a href="{{ url('busqueda/datos_personales') }}">Datos Personales</a></li>
        </ul>

</div>
@yield('buscarContent')
<button type="submit" class="btn btn-primary">Buscar</button>
@endsection
