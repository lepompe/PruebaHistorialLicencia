<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLicencia extends Model
{
    protected $fillable = ['Lic_Id', 'Dat_Id', 'Lic_Numero', 'TipLic_Id', 'Vig_id', 'Lic_Expedicion','Lic_Vencimiento','Lic_Expediente','Lic_Activa','Lic_FolioPago','Lic_Costo','Lic_Vigencia','Lic_Activo','Usu_id','Lic_NumFolioAnterior','Lic_NumSerie','Lic_impresa'];

    protected $table = "dbo.Lic_Licencias";

}
