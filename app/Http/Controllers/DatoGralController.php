<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datoGral;
use App\token;
use App\Estado;
use App\Solicitud;
use DB;
use Response;

class DatoGralController extends Controller
{

   public function buscar_datos(Request $request) 
        {
                
                $token_web_form = token::select('tokens.*')->where('id_token','=','1')->get();

                foreach($token_web_form as $value){
                        $token_web = $value->token;
                }
                $data = [
                        "ews_token" => strip_tags(trim($request->input('ews_token'))),
                        "ews_no_solicitud" => strip_tags(trim($request->input('ews_no_solicitud'))),
                        "ews_llave" => strip_tags(trim($request->input('ews_llave'))),
                        "ews_id_tramite" => strip_tags(trim($request->input('ews_id_tramite'))),
                        "ews_fecha_solicitud" => strip_tags(trim($request->input('ews_fecha_solicitud'))),
                        "ews_hora_solicitud" => strip_tags(trim($request->input('ews_hora_solicitud'))),
                        "ews_nombre" => strip_tags(trim($request->input('ews_nombre'))),
                        "ews_apellido_paterno" => strip_tags(trim($request->input('ews_apellido_paterno'))),
                        "ews_apellido_materno" => strip_tags(trim($request->input('ews_apellido_materno'))),
                        "ews_curp" => strip_tags(trim($request->input('ews_curp'))),
                        "ews_licencia" => strip_tags(trim($request->input('ews_licencia')))
                ];
                $data = (object) $data;
                
                if($token_web == $data->ews_token) {

                                if(empty($data->ews_llave) || 
                                empty($data->ews_id_tramite) || 
                                empty($data->ews_no_solicitud) || 
                                empty($data->ews_fecha_solicitud) || 
                                empty($data->ews_nombre) ||
                                empty($data->ews_apellido_paterno) ||
                                empty($data->ews_apellido_materno) ||
                                empty($data->ews_curp) ||
                                empty($data->ews_licencia) ||
                                empty($data->ews_hora_solicitud)
                                ){
                                        return response()->json(array("wsp_mensaje" => 'falta información' ), 400);
                                }
                                $persona = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                                ->join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
                                ->select('Dat_DatosGral.*','Lic_Licencias.*','TipLic_TipoLicencia.TipLic_Descripcion')
                                ->where('Dat_Nombre','=',$data->ews_nombre)
                                ->where('Dat_Paterno','=',$data->ews_apellido_paterno)
                                ->where('Dat_Materno','=',$data->ews_apellido_materno)
                                ->where('Dat_CURP','=',$data->ews_curp)
                                ->where('Dat_Folio','=',$data->ews_licencia)
                                ->get();
                                
                                if($persona == '[]'){
                                        return response()->json(array("wsp_mensaje" => 'Ciudadano No encontrado'), 200);
                                }else{
                                    
                                $saveEstado = new Estado;
                                $saveEstado->nombre = 'INICIADO';
                                $saveEstado->save();
                              
                                $saveSolicitud = new Solicitud;
                                $saveSolicitud->llave = $data->ews_llave;
                                $saveSolicitud->id_tramite = $data->ews_id_tramite;
                                $saveSolicitud->no_solicitud = $data->ews_no_solicitud;
                                $saveSolicitud->fecha_solicitud = $data->ews_fecha_solicitud;
                                $saveSolicitud->hora_solicitud = $data->ews_hora_solicitud;
                                $saveSolicitud->no_solicitud_api = '';
                                $saveSolicitud->fecha_solicitud_api = date('Y-m-d');
                                $saveSolicitud->hora_solicitud_api = date('H:i:s');
                                $saveSolicitud->id_estado = $saveEstado->id_estado;
                                $saveSolicitud->id_electronico = '';
                                $saveSolicitud->referencia_pago = '';
                                $saveSolicitud->fecha_pago = date('Y-m-d');
                                $saveSolicitud->hora_pago = date('H:i:s');
                                $saveSolicitud->stripe_orden_id = '';
                                $saveSolicitud->stripe_creado = '';
                                $saveSolicitud->stripe_mensaje = '';
                                $saveSolicitud->stripe_tipo = '';
                                $saveSolicitud->stripe_digitos = '';
                                $saveSolicitud->stripe_red = '';
                                $saveSolicitud->stripe_estado = '';
                                $saveSolicitud->xml_url = '';
                                $saveSolicitud->no_consulta = '1';
                                foreach ($persona as $dato){
                                        $saveSolicitud->ews_nombre = $dato->Dat_Nombre;
                                        $saveSolicitud->ews_apellido_paterno = $dato->Dat_Paterno;
                                        $saveSolicitud->ews_apellido_materno = $dato->Dat_Materno;
                                        $saveSolicitud->ews_curp = $dato->Dat_CURP;
                                        $saveSolicitud->ews_licencia = $dato->Dat_Folio;
                                }
                                foreach($token_web_form as $id_token){
                                        $saveSolicitud->id_token = $id_token->id_token;
                                }
                                $saveSolicitud->save();
                                
                                $id_save_solicitud = $saveSolicitud->id_solicitud;
                                $no_solicitud_api = Solicitud::find($id_save_solicitud);
                                $no_solicitud_api->no_solicitud_api = date('Y').'-'.str_pad($id_save_solicitud, 4, "0", STR_PAD_LEFT);
                                $no_solicitud_api->save();

                                foreach ($persona as $value) 
                                {
                                        
                                        $cadena = (object)array(
                                                '0' => (object)array(
                                                        '0' => (object)array(
                                                                '0' => 'Datos del Historial de Licencias'
                                                        ),
                                                        '1' => (object)array(
                                                                '0' => 'Numero de Folio',
                                                                '1' => $value->Dat_Folio
                                                        ),
                                                        '2' =>(object)array(
                                                                '0' => 'Tipo de Licencia',
                                                                '1' => $value->TipLic_Descripcion
                                                        ),
                                                        '3' =>(object)array(
                                                                '0' => 'Numero de Expediente',
                                                                '1' => $value->Lic_Expediente
                                                        ),
                                                        '4' =>(object)array(
                                                                '0' => 'Vigencia',
                                                                '1' => $value->Lic_Vigencia
                                                        ),
                                                        '5' =>(object)array(
                                                                '0' => 'Fecha de Expedicion',
                                                                '1' => $value->Lic_Expedicion
                                                        ),
                                                        '6' =>(object)array(
                                                                '0' => 'Fecha de Vencimiento',
                                                                '1' => $value->Lic_Vencimiento
                                                        ),
                                                )       
                                        );        
                                }
                        return response()->json(['wsp_mensaje'=>'Ciudadano Encontrado',
                                                'wsp_no_Solicitud'=>$data->ews_no_solicitud,
                                                'wsp_no_Solicitud_api'=>$no_solicitud_api->no_solicitud_api,
                                                'wsp_nivel'=>'1',
                                                'wsp_datos'=>$cadena], 200);   
                                }

                                 
                } elseif($token_web != $data->ews_token){
                        return response()->json(array("wsp_mensaje" => 'Token Invalido' ), 400); 
                }                
        }
}
