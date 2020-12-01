<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Licencia;

class datoGral extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = "dbo.Dat_DatosGral";
    

    public function usu_licencia() {
        return $this->belongsTo(Licencia::class);
    }
}
