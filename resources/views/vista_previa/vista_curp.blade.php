@extends('layouts.app')

@section('title', 'Vista Previa')

@section('content')
    <h2>VISTA PREVIA</h2>
        <table class="table">
            <tr>

                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Curp</th>
                <th>Numero de licencia</th>
        
            </tr>
      
            <tr>
                @foreach ($licencias as $licencia)
                    <td>{{$curp->Dat_Nombre}}</td>
                    <td>{{$curp->Dat_Paterno}}</td>
                    <td>{{$curp->Dat_Materno}}</td>
                    <td>{{$curp->Dat_CURP}}</td>
                    <td>{{$licencia->Lic_NumFolioAnterior}}</td>     
                @endforeach
                
            </tr>
      </table>  

                     
@endsection