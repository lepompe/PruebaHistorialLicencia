@extends('busqueda.buscar')
@section('seleccionar')
    Datos Personales
@endsection
@section('buscarContent')
<div class="form-group">
    <label for="">Nombres <label style="color: red"> *</label></label>
    <br>
    <input type="text" name="nombres" class="">
    <br>
    <label for="">Apellido Materno <label style="color: red"> *</label></label>
    <br>
    <input type="text" name="apellido_materno" class="">
    <br>
    <label for="">Apellido Paterno <label style="color: red"> *</label></label>
    <br>
    <input type="text" name="apellido_paterno" class="">
    <br>
    <label for="">RFC <label style="color: red"> *</label></label>
    <br>
    <input type="text" name="rfc" class="">
</div>
@endsection