<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datoGral;
use App\TipoLicencia;
use App\Licencia;
use App\Http\Controllers\DatoGralController;
use validator;
use DB;

class PDFController extends Controller
{

    public function verpdf($nombres,$apellido_paterno,$apellido_materno,$curp,$numero_licencia){

        $persona = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                ->select('Dat_DatosGral.*','Lic_Licencias.Lic_Expediente')
                ->where('Dat_Nombre','=',$nombres)
                ->where('Dat_Paterno','=',$apellido_paterno)
                ->where('Dat_Materno','=',$apellido_materno)
                ->where('Dat_CURP','=',$curp)
                ->firstOrFail();

        $licencia = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                ->join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
                ->select('Lic_Licencias.*','TipLic_TipoLicencia.TipLic_Descripcion')
                ->where('Dat_Folio','=',$numero_licencia)
                ->get();

        $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $pdf = \PDF::loadView('layouts\pdf', compact('persona','licencia','meses'));
        return $pdf->stream('historial de licencia.pdf'); 
    }
    public function imprimirpdf($nombres,$apellido_paterno,$apellido_materno,$curp,$numero_licencia) {

        $persona = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                ->select('Dat_DatosGral.*','Lic_Licencias.Lic_Expediente')
                ->where('Dat_Nombre','=',$nombres)
                ->where('Dat_Paterno','=',$apellido_paterno)
                ->where('Dat_Materno','=',$apellido_materno)
                ->where('Dat_CURP','=',$curp)
                ->firstOrFail();

        $licencia = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                ->join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
                ->select('Lic_Licencias.*','TipLic_TipoLicencia.TipLic_Descripcion')
                ->where('Dat_Folio','=',$numero_licencia)
                ->get();

        $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        
        $pdf = \PDF::loadView('layouts\pdf', compact('persona','licencia','meses'));
        return $pdf->download('historial de licencia.pdf');    
   }
}
