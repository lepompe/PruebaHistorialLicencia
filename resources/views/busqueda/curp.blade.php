@extends('busqueda.buscar')
@section('seleccionar')
    CURP
@endsection
@section('buscarContent')
<div class="form-group">
    <form files="true" method="GET" action="/busqueda/buscar-curp">
        <div>
            <div>
                <i></i>
                <label for="">Clave Única de Registro de Población (CURP) <label style="color: red"> *</label></label>
            </div>

            <div>
                <input type="search" name="curp" autofocus>
                
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><i>Buscar</i></button>
    </form>
    
    <br>
    
</div>
@endsection