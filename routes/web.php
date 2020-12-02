<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/API1', 'DatoGralController@buscar_datos');
/* route::get('busqueda/vista-datos/{nombres}/{apellido_paterno}/{apellido_materno}/{curp}/{numero_licencia}', 'DatoGralController@buscar_datos'); */

/* route::get('busqueda', 'BusquedaController@busqueda'); */
/*  Route::get('busqueda/vista_datos', 'DatoGralController@buscar_datos'); */

Route::get('busqueda/vista_datos/{nombres}/{apellido_paterno}/{apellido_materno}/{curp}/{numero_licencia}/ver_pdf', 'PDFController@verpdf');
Route::get('busqueda/vista_datos/{nombres}/{apellido_paterno}/{apellido_materno}/{curp}/{numero_licencia}/imprimir_pdf', 'PDFController@imprimirpdf');
