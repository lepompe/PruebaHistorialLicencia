<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\datoGral;
use App\TipoLicencia;

class Licencia extends Model
{
    protected $table = "dbo.Lic_Licencias";

    public function datogral() {
        return $this->hasMany(datoGral::class);
    }

    public function tipolicencia() {
        return $this->belongsTo(TipoLicencia::class);
    }
}
