@extends('layouts.app')

@section('title', 'Vista Previa')

@section('content')
    <h2>VISTA PREVIA</h2>
    @foreach ($curps as $curp)
        <label for="">{{$curp->Dat_Folio}}</label>
        <label for="">{{$curp->Dat_Nombre}}</label>
        <label for="">{{$curp->Dat_Paterno}}</label>
        <label for="">{{$curp->Dat_Materno}}</label>
        <label for="">{{$curp->Dat_fecnac}}</label>
        <label for="">{{$curp->Dat_RFC}}</label>
        <label for="">{{$curp->Dat_CURP}}</label>
        @if ($curp->Sex_id==1)
            <label for="">Masculino</label>
        @elseif ($curp->Sex_id==2)
            <label for="">Femenino</label>    
        @elseif ($curp->Sex_id==0)
            <label for="">Sin información</label>
        @endif
        <label for="">{{$curp->Dat_telefono}}</label>
        <label for="">{{$curp->Dat_Edad}}</label>
        <label for="">{{$curp->Dat_Lentes}}</label>
        <label for="">{{$curp->Dat_Alergias}}</label>
        <label for="">{{$curp->Dat_Padecimientos}}</label>
        <label for="">{{$curp->TipSan_id}}</label>   
@endforeach

                   
@endsection