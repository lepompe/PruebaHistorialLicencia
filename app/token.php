<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class token extends Model
{
    protected $connection = 'mysql';
    protected $table = "token";
}
