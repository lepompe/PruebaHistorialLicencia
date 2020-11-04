<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datoGral extends Model
{
    protected $fillable = ['Dat_id', 'Dat_folio', 'Dat_Nombre', 'Dat_Paterno', 'Dat_Materno', 'Dat_fecnac','Dat_RFC','Dat_CURP','Sex_id','Nac_id','Iden_id','Per_id','Dat_correo','Dat_telefono','Dat_Celular','Eciv_id','Act_Id','Dat_NomReferencia','Dat_Estatura','Dat_Edad','Dat_telefono_trabajo','Dat_LugTrabajo','Dat_Ocupacion','Dat_LugOrigen','Dat_Lentes','Dat_Alergias','Dat_Padecimientos','TipSan_id','Len_id','Dat_rutaFoto','Dat_rutaFirma','Dat_rutaHuella','Dat_NomAccidente','Dat_DirAccidente','Dat_TelAccidente','Dat_Ciu_Accidente'];

    protected $table = "dbo.Dat_DatosGral";

}
