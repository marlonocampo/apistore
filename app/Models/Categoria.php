<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable =['nombre', 'fechacreacion', 'activo'];
    protected $table = 'categoria'; //nombre real de tabla en la BD
    public $timestamps = false;
}
