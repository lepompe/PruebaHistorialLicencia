<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusquedaController;
use App\datoGral;
use validator;
use App\token;
use DB;
use Response;

class DatoGralController extends Controller
{

   public function buscar_datos(Request $request) 
        {
                $token_web_form = '234534563241456789654321456789654322145678';

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

                if($token_web_form == $data->ews_token) {
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
                                ->where('Dat_Folio','=',$data->ews_licencia)
                                ->get();

                                $cadena = [];
                                foreach ($persona as $value) 
                                {
                                        $cadena[] = [
                                                '0' =>[
                                                        '0' => 'Datos del Historial de Licencias'
                                                ],
                                                '1' =>[
                                                        '0' => 'Numero de Folio',
                                                        '1' => $value->Dat_Folio
                                                ],
                                                '2' =>[
                                                        '0' => 'Tipo de Licencia',
                                                        '1' => $value->TipLic_Descripcion
                                                ],
                                                '3' =>[
                                                        '0' => 'Numero de Expediente',
                                                        '1' => $value->Lic_Expediente
                                                ],
                                                '4' =>[
                                                        '0' => 'Vigencia',
                                                        '1' => $value->Lic_Vigencia
                                                ],
                                                '5' =>[
                                                        '0' => 'Fecha de Expedicion',
                                                        '1' => $value->Lic_Expedicion
                                                ],
                                                '6' =>[
                                                        '0' => 'Fecha de Vencimiento',
                                                        '1' => $value->Lic_Vencimiento
                                                ]
                                        ];

                                
                        }
                        return response()->json(['wsp_mensaje'=>'Ciudadano Encontrado',
                                                'wsp_no_Solicitud'=>$data->ews_no_solicitud,
                                                'wsp_no_Solicitud_api'=>date('Y').'-'.'000001',
                                                'wsp_nivel'=>'2',
                                                'wsp_datos'=>$cadena], 200);
                } elseif($token_web_form != $data->ews_token){
                        return response()->json(array("wsp_mensaje" => 'Token Invalido' ), 400); 
                }               
        }
}
