<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_sucursal_mesa extends Model
{
    use HasFactory;
    protected $table = 'tb_sucursal_mesa';
    protected $fillable = [
        'id',
    'id_empresa',
    'id_sucursal',
    'descripcion',
    'src',
    'valor',
    'color',
    'icono',
    'created_at',
    'updated_at'
    ];

    public $timestamps = false;
}
