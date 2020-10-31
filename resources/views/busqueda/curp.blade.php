@extends('busqueda.buscar')
@section('seleccionar')
    CURP
@endsection
@section('buscarContent')
<div class="form-group">
    <label for="">Clave Única de Registro de Población (CURP) <label style="color: red"> *</label></label>
    <br>
    <input type="text" name="curp" class="">
</div>
@endsection