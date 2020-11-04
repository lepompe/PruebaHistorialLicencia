@extends('layouts.app')

@section('title', 'Vista Previa')

@section('content')
    <h2>VISTA PREVIA</h2>
        @foreach ($datos_personales as $dato_personal)
        <label for="">{{$dato_personal->Dat_Folio}}</label>
        <label for="">{{$dato_personal->Dat_Nombre}}</label>
        <label for="">{{$dato_personal->Dat_Paterno}}</label>
        <label for="">{{$dato_personal->Dat_Materno}}</label>
        <label for="">{{$dato_personal->Dat_fecnac}}</label>
        <label for="">{{$dato_personal->Dat_RFC}}</label>
        <label for="">{{$dato_personal->Dat_CURP}}</label>
        @if ($dato_personal->sex_id=1)
            <label for="">Masculino</label>
        @elseif ($dato_personal->sex_id=2)
            <label for="">Femenino</label>    
        @elseif ($dato_personal->sex_id=0)
            <label for="">Sin información</label>
        @endif
        <label for="">{{$dato_personal->Dat_telefono}}</label>
        <label for="">{{$dato_personal->Dat_Edad}}</label>
        <label for="">{{$dato_personal->Dat_Lentes}}</label>
        <label for="">{{$dato_personal->Dat_Alergias}}</label>
        <label for="">{{$dato_personal->Dat_Padecimientos}}</label>
        <label for="">{{$dato_personal->TipSan_id}}</label>
        @endforeach   
@endsection