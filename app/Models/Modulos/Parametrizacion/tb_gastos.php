<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_gastos extends Model
{
    use HasFactory;
    protected $table = 'tb_gastos';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
    'mes',
    'anio',
    'id_estacion',
    'id_estacion_obrero',
    'estacion',
    'pc_codcta',
    'pc_nomcta',
    'cc_concepto',
    'cc_fecha',
    'cc_fechagra',
    'dc_glosa',
    'dc_valhab',
    'dc_valdeb',
    'created_at',
    'updated_at'
    ];
}
