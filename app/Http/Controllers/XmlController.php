<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\datoGral;
use validator;
use App\token;
use App\Estado;
use App\Solicitud;
use DB;
use Response;

class XmlController extends Controller
{
    public function xml(Request $request){

        $token_web_form = token::select('tokens.*')->where('id_token','=','1')->get();

        foreach($token_web_form as $value){
                $token_web = $value->token;
        }

        $data = [
                "ews_token" => strip_tags(trim($request->input('ews_token'))),
                "ews_no_solicitud" => strip_tags(trim($request->input('ews_no_solicitud'))),
                "ews_id_electronico" => strip_tags(trim($request->input('ews_id_electronico'))),
                "ews_referencia_pago" => strip_tags(trim($request->input('ews_referencia_pago'))),
                "ews_fecha_pago" => strip_tags(trim($request->input('ews_fecha_pago'))),
                "ews_hora_pago" => strip_tags(trim($request->input('ews_hora_pago'))),
                "ews_stripe_orden_id" => strip_tags(trim($request->input('ews_stripe_orden_id'))),
                "ews_stripe_creado" => strip_tags(trim($request->input('ews_stripe_creado'))),
                "ews_stripe_mensaje" => strip_tags(trim($request->input('ews_stripe_mensaje'))),
                "ews_stripe_tipo" => strip_tags(trim($request->input('ews_stripe_tipo'))),
                "ews_stripe_digitos" => strip_tags(trim($request->input('ews_stripe_digitos'))),
                "ews_stripe_red" => strip_tags(trim($request->input('ews_stripe_red'))),
                "ews_stripe_estado" => strip_tags(trim($request->input('ews_stripe_estado')))
        ];
        $data = (object) $data;

        if($token_web==$data->ews_token){
                if(empty($data->ews_no_solicitud) ||
                empty($data->ews_id_electronico) ||
                empty($data->ews_referencia_pago) ||
                empty($data->ews_fecha_pago) ||
                empty($data->ews_hora_pago) ||
                empty($data->ews_stripe_orden_id) ||
                empty($data->ews_stripe_creado) ||
                empty($data->ews_stripe_mensaje) ||
                empty($data->ews_stripe_tipo) ||
                empty($data->ews_stripe_digitos) ||
                empty($data->ews_stripe_red) ||
                empty($data->ews_stripe_estado)
                ){
                        return response()->json(array("wsp_mensaje" => 'falta información' ), 400);
                }
                
                $solicitud = Solicitud::select('solicitudes.*')->where('no_solicitud','=',$data->ews_no_solicitud)->get();
                
                foreach($solicitud as $value){
                        $id_solicitud = $value->id_solicitud;
                        $no_solicitud_api = $value->no_solicitud_api;
                        $f_solicitud = $value->fecha_solicitud;
                        $h_solicitud = $value->hora_solicitud;
                        $no_licencia_api = $value->ews_licencia;
                        
                }
                
                $persona = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                        ->join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
                        ->select('Dat_DatosGral.Dat_Nombre',
                        'Dat_DatosGral.Dat_Paterno',
                        'Dat_DatosGral.Dat_Materno',
                        'Lic_Licencias.Lic_Expediente',
                        'Lic_Licencias.Lic_Expedicion',
                        'Lic_Licencias.Lic_Vencimiento',
                        'TipLic_TipoLicencia.TipLic_Descripcion')
                        ->where('Dat_DatosGral.Dat_Folio','=',$no_licencia_api)
                        ->get();

                foreach($persona as $value){
                        $nombre = $value->Dat_Nombre;
                        $ap_paterno = $value->Dat_Paterno;
                        $ap_materno = $value->Dat_Materno;
                        $n_expediente = $value->Lic_Expediente;
                        $f_expedicion = $value->Lic_Expedicion;
                        $f_vencimiento = $value->Lic_Vencimiento;
                        $tipo_licencia = $value->TipLic_Descripcion;      
                }
                
                $xmlstr = <<<XML
                        <?xml version='1.0' encoding='utf-8'?>
                        <Tramite>
                                <Documento>
                                        <no_solicitud>$data->ews_no_solicitud</no_solicitud>
                                        <fecha_solicitud>$f_solicitud</fecha_solicitud>
                                        <hora_solicitud>$h_solicitud</hora_solicitud>
                                        <id_electronico>$data->ews_id_electronico</id_electronico>
                                        <referencia_pago>$data->ews_referencia_pago</referencia_pago>
                                        <fecha_pago>$data->ews_fecha_pago</fecha_pago>
                                        <hora_pago>$data->ews_hora_pago</hora_pago>
                                        <stripe_orden_id>$data->ews_stripe_orden_id</stripe_orden_id>
                                        <stripe_creado>$data->ews_stripe_creado</stripe_creado>
                                        <stripe_mensaje>$data->ews_stripe_mensaje</stripe_mensaje>
                                        <stripe_tipo>$data->ews_stripe_tipo</stripe_tipo>
                                        <stripe_digitos>$data->ews_stripe_digitos</stripe_digitos>
                                        <stripe_red>$data->ews_stripe_red</stripe_red>
                                        <stripe_estado>$data->ews_stripe_estado</stripe_estado>
                                        <nombres>$nombre</nombres>
                                        <apellido_paterno>$ap_paterno</apellido_paterno>
                                        <apellido_materno>$ap_materno</apellido_materno>
                                        <expediente>$n_expediente</expediente>
                                        <fecha_expedicion>$f_expedicion</fecha_expedicion>
                                        <fecha_vencimiento>$f_vencimiento</fecha_vencimiento>
                                        <tipo_licencia>$tipo_licencia</tipo_licencia>
                                </Documento>
                                <Firma_Electronica>
                                        <Hash></Hash>
                                        <Hash_Validado></Hash_Validado>
                                        <Descripcion></Descripcion>
                                        <Fecha_Validez></Fecha_Validez>
                                </Firma_Electronica>
                        </Tramite>
                        XML;
                
                $nombre_archivo = md5(date('Y-m-d H:i:s').rand()).".xml";
                \Storage::disk('xml')->put($nombre_archivo,$xmlstr);
                $content = \Storage::disk('xml')->get($nombre_archivo);
                $url = asset('storage/create_xml/'.$nombre_archivo);

                $saveSolicitud = Solicitud::find($id_solicitud);
                $saveSolicitud->id_electronico = $data->ews_id_electronico;
                $saveSolicitud->referencia_pago = $data->ews_referencia_pago;
                $saveSolicitud->fecha_pago = date('Y-m-d');
                $saveSolicitud->hora_pago = date('H:i:s');
                $saveSolicitud->stripe_orden_id = $data->ews_stripe_orden_id;
                $saveSolicitud->stripe_creado = $data->ews_stripe_creado;
                $saveSolicitud->stripe_mensaje = $data->ews_stripe_mensaje;
                $saveSolicitud->stripe_tipo = $data->ews_stripe_tipo;
                $saveSolicitud->stripe_digitos = $data->ews_stripe_digitos;
                $saveSolicitud->stripe_red = $data->ews_stripe_red;
                $saveSolicitud->stripe_estado = $data->ews_stripe_estado;
                $saveSolicitud->xml_url = $url;
                $saveSolicitud->save();

                return response()->json(['wsp_mensaje'=>'Xml Generado',
                                                'wsp_no_Solicitud'=>$data->ews_no_solicitud,
                                                'wsp_no_Solicitud_api'=>$no_solicitud_api,
                                                'wsp_fecha_generacion'=>date('Y-m-d'),
                                                'wsp_hora_generacion'=> date('H:i:s'),
                                                'wsp_url_xml' => $url], 200); 

        }else{
                return response()->json(array("wsp_mensaje" => 'Token Inválido' ), 403);
        }
        

}
}
