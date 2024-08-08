<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_estaciones extends Model
{
    use HasFactory;
    protected $table = 'tb_estaciones';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
    'descripcion',
    'direccion',
    'latitud',
    'longitud',
    'telefono',
    'galones',
    'total',
    'created_at',
    'updated_at'
    ];
}
