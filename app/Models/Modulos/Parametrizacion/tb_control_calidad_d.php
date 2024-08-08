<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_control_calidad_d extends Model
{
    use HasFactory;
    protected $table = 'tb_control_calidad_d';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_control_calidad',
        'id_descripcion',
        'id_items',
        'inspeccion',
        'presion',
        'medida',
        'anio',
        'estado',
        'created_at',
        'updated_at'
    ];
}
