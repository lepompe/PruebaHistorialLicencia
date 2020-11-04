<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusquedaController;
use App\DatoGral;
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
        $curps = DatoGral::select('Dat_DatosGral.*')
                 ->where('Dat_CURP','like','%'.$request->curp.'%')
                 ->get();
        return view('vista_previa.vista_curp', compact('curps'));
   }

   public function buscar_datos_personales(Request $request) {
        $datos_personales = DatoGral::select('Dat_DatosGral.*')
            ->where('Dat_Nombre','like','%'.$request->nombres.'%')
            ->where('Dat_Paterno','like','%'.$request->apellido_paterno.'%')
            ->where('Dat_Materno','like','%'.$request->apellido_materno.'%')
            ->where('Dat_RFC','like','%'.$request->rfc.'%')
            ->get();
        return view('vista_previa.vista_datos_personales', compact('datos_personales'));
   }
}
