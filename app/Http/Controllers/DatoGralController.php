<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusquedaController;
use App\datoGral;
use validator;
use DB;
use Response;

class DatoGralController extends Controller
{

   public function buscar_datos($nombres,$apellido_paterno,$apellido_materno,$curp,$numero_licencia) 
        {

                $persona = datoGral::join('dbo.Lic_Licencias','Lic_Licencias.Dat_Id','=','Dat_DatosGral.Dat_id')
                        ->join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
                        ->select('Dat_DatosGral.*','Lic_Licencias.*','TipLic_TipoLicencia.TipLic_Descripcion')
                        ->where('Dat_Nombre','=',$nombres)
                        ->where('Dat_Paterno','=',$apellido_paterno)
                        ->where('Dat_Materno','=',$apellido_materno)
                        ->where('Dat_CURP','=',$curp)
                        ->where('Dat_Folio','=',$numero_licencia)
                        ->get();
                
                        $json = array();
                        $data = $persona->toArray();
                        $json = json_decode(json_encode($data), true);
                        
                        foreach ($json as $value) 
                        {
                                $cadena = response()->json([
                                        "datos" => (object)array(
                                                "0" => (object)array(
                                                        "0" => (object)array(
                                                                "0" => "Datos del Historial de Licencias"
                                                        ),
                                                        "1" => (object)array(
                                                                "0" => "Numero de Licencia",
                                                                "1" => $value['Lic_NumFolioAnterior']
                                                        ),
                                                        "2" => (object)array(
                                                                "0" => "Tipo de Licencia",
                                                                "1" => $value['TipLic_Descripcion']
                                                        ),
                                                        "3" => (object)array(
                                                                "0" => "Numero de Expediente",
                                                                "1" => $value['Lic_Expediente']
                                                        ),
                                                        "4" => (object)array(
                                                                "0" => "Vigencia",
                                                                "1" => $value['Lic_Vigencia']
                                                        ),
                                                        "5" => (object)array(
                                                                "0" => "Fecha de Expedicion",
                                                                "1" => $value['Lic_Expedicion']
                                                        ),
                                                        "6" => (object)array(
                                                                "0" => "Fecha de Vencimiento",
                                                                "1" => $value['Lic_Vencimiento']
                                                        )
                                                )
                                        )
                                ]);
                                return $cadena;        
                        }
                /* $licencia = DB::connection('sqlsrv')->table('dbo.Dat_DatosGral')
                ->get(); */
/*                 if($token == 'hthggfh') {
                           
                } */
                 
        }
}
