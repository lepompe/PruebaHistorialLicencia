<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusquedaController;
use App\DatoGral;
use validator;
use DB;

class DatoGralController extends Controller
{
    public function curp() {
        return view('busqueda.curp');
         

    }
    public function buscar_curp(Request $request) {
         $curp = DatoGral::where('Dat_CURP', '=',$request->curp);
         return view('vista_previa.vista_previa', compact('curp'));
    }
    public function datos_personales() {
        return view('busqueda.datos_personales');
    }
}
