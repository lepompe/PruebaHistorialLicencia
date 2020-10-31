<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    public function busqueda() {
        return view('busqueda.buscar');
    }
    public function curp() {
        return view('busqueda.curp');
    }
    public function datos_personales() {
        return view('busqueda.datos_personales');
    }
}
