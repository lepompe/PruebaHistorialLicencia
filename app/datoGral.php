<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TiopLicencia;

class datoGral extends Model
{
    protected $table = "dbo.Dat_DatosGral";

    public function licencia() {
        return $this->hasMany(TipoLicencia::class);
    }
}
