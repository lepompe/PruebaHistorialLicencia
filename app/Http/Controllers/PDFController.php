<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datoGral;
use App\Solicitud;
use App\Estado;
use App\token;
use App\Http\Controllers\DatoGralController;
use validator;
use DB;

class PDFController extends Controller
{

    public function verpdf(Request $request){
        $token_web_form = token::select('tokens.*')->where('id_token','=','1')->get();

        foreach($token_web_form as $value){
                $token_web = $value->token;
        }
        $data = [
                "ews_token" => strip_tags(trim($request->input('ews_token'))),
                "ews_no_solicitud" => strip_tags(trim($request->input('ews_no_solicitud'))),
                "ews_llave" => strip_tags(trim($request->input('ews_llave'))),
                "ews_id_electronico" => strip_tags(trim($request->input('ews_id_electronico'))),
        ];
        $data = (object) $data;
        if($token_web == $data->ews_token){
                if(empty($data->ews_llave) || 
                empty($data->ews_id_electronico) 
                ){
                        return response()->json(array("wsp_mensaje" => 'falta información' ), 400);
                }

                $solicitud = Solicitud::select('solicitudes.*')->where('no_solicitud','=',$data->ews_no_solicitud)->get();
                
                foreach($solicitud as $value){
                        $id_solicitud = $value->id_solicitud;
                        $nombre_persona = $value->ews_nombre;
                        $materno_persona = $value->ews_apellido_materno;
                        $paterno_persona = $value->ews_apellido_paterno;
                        $curp_persona = $value->ews_curp;
                        $datos_licencia = $value->ews_licencia;
                        $no_consulta = $value->no_consulta;
                }

                $persona = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                        ->select('Dat_DatosGral.Dat_Nombre','Dat_DatosGral.Dat_Paterno','Dat_DatosGral.Dat_Materno','Dat_DatosGral.Dat_CURP','Lic_Licencias.Lic_Expediente')
                        ->where('Dat_Nombre','=',$nombre_persona)
                        ->where('Dat_Paterno','=',$paterno_persona)
                        ->where('Dat_Materno','=',$materno_persona)
                        ->where('Dat_CURP','=',$curp_persona)
                        ->where('Dat_Folio','=',$datos_licencia)
                        ->first();
                $licencia = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                        ->join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
                        ->select('Lic_Licencias.*','TipLic_TipoLicencia.TipLic_Descripcion')
                        ->where('Dat_Folio','=',$datos_licencia)
                        ->get();
                
                $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

                $nueva_consulta = $no_consulta++;
                $saveConsulta = Solicitud::find($id_solicitud);
                if($no_consulta == ''){
                        $saveConsulta->no_consulta = '1';
                }elseif($no_consulta != '1'){
                        $saveConsulta->no_consulta = $nueva_consulta;
                }
                $saveConsulta->save();
                
                $pdf = \PDF::loadView('layouts\pdf', compact('persona','licencia','meses'));
                return $pdf->stream('historial de licencia.pdf');
        }else{
                return response()->json(array("wsp_mensaje" => 'Token Inválido' ), 403);
        }
         
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
