<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\datoGral;

class TipoLicencia extends Model
{
    protected $table = "dbo.Lic_Licencias";

    public function datogral() {
        return $this->belongsTo(datoGral::class);
    }
}
