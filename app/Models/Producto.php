<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'stock', 'descripcion', 'fechacreacion', 'codigo', 'precio', 'idcategoria', 'activo'];
    public $timestamps = false;
    protected $table = 'producto';
}
