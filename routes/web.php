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
Route::get('busqueda', 'BusquedaController@busqueda');

route::get('busqueda/curp', 'DatoGralController@curp');
route::get('busqueda/buscar-curp', 'DatoGralController@buscar_curp');
route::get('busqueda/datos_personales', 'DatoGralController@datos_personales');

