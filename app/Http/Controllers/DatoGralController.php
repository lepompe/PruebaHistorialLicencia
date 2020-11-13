<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusquedaController;
use App\datoGral;
use App\TipoLicencia;
use App\Licencia;
use validator;
use DB;
use Response;

class DatoGralController extends Controller
{

   public function buscar_datos(Request $request) {

        $persona = datoGral::where('Dat_Nombre','=',$request->input('nombres'))
                ->where('Dat_Paterno','=',$request->input('apellido_paterno'))
                ->where('Dat_Materno','=',$request->input('apellido_materno'))
                ->where('Dat_CURP','=',$request->input('curp'))
                ->firstOrFail();

        $licencia = Licencia::join('dbo.TipLic_TipoLicencia', 'TipLic_TipoLicencia.TipLic_id', '=', 'Lic_Licencias.TipLic_Id')
        ->select('Lic_Licencias.*','TipLic_TipoLicencia.TipLic_Descripcion')
        ->where('Lic_NumFolioAnterior','=',$request->input('numero_licencia'));
        
        $json = array();
        $data = $licencia->get()->toArray();
        $json = json_decode(json_encode($data), true);
        
        foreach ($json as $value) {
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

/*         return view('vista_previa.vista_datos', compact('licencia'));  */
   }
}
