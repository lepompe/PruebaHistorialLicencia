<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Licencia;

class TipoLicencia extends Model
{
    protected $table = "dbo.TipLic_TipoLicencia";
    protected $connection = 'sqlsrv';

    public function licencia() {
        return $this->hasMany(Licencia::class);
    }
}
