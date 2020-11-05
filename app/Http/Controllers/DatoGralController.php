<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusquedaController;
use App\datoGral;
use App\TipoLicencia;
use validator;
use DB;

class DatoGralController extends Controller
{
    public function curp() {
        return view('busqueda.curp');
         

    }
    
    public function datos_personales() {
        return view('busqueda.datos_personales');
    }

    public function buscar_curp(Request $request) {
        
        $curp = datoGral::where('Dat_CURP','=',$request->input('curp'))
                ->firstOrFail();

        $licencias = TipoLicencia::where('Dat_Id','=',$curp->Dat_id)
                ->get();
        $tiplic = TipoLicencia::where('TipLic_Id','=',3);
            return view('vista_previa.vista_curp', compact('curp','licencias'));

       
   }

   public function buscar_datos_personales(Request $request) {
        $datos_personales = datoGral::where('Dat_Nombre','=',$request->input('nombres'))
            ->where('Dat_Paterno','=',$request->input('apellido_paterno'))
            ->where('Dat_Materno','=',$request->input('apellido_materno'))
            ->where('Dat_RFC','=',$request->input('rfc'))
            ->firstOrFail();

            $licencias = TipoLicencia::where('Dat_Id','=',$datos_personales->Dat_id)
            ->get();
            
        return view('vista_previa.vista_datos_personales', compact('datos_personales', 'licencias'));
   }
}
