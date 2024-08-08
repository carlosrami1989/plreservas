<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_consulta_mes extends Model
{
    use HasFactory;
    protected $table = 'tb_consulta_mes';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'mes',
        'anio',
        'descripcion',
        'galones',
        'total',
        'estacion',
        'created_at',
        'updated_at'
    ];
}
