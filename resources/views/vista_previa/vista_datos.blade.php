@extends('layouts.app')

@section('title', 'Vista Previa')

@section('content')
    <h2>VISTA PREVIA</h2>
    <table class="table">
        <tr>
          <th>Número de licencia</th>
          <th>Tipo de Licencia</th>
          <th>Número de Expediente</th>
          <th>Vigencia</th>
          <th>Fecha de Expedición</th>
          <th>Fecha de Vencimiento</th>
        </tr>
        @foreach ($licencia as $lic)
          <tr>
      
            <td >{{$lic->Lic_NumFolioAnterior}}</td>
            <td>{{$lic->TipLic_Descripcion}}</td>
            <td>{{$lic->Lic_Expediente}}</td>
            <td>{{$lic->Lic_Vigencia}}</td>
            <td>{{$lic->Lic_Expedicion}}</td>
            <td>{{$lic->Lic_Vencimiento}}</td>
            
          </tr>
      @endforeach
      </table>
@endsection