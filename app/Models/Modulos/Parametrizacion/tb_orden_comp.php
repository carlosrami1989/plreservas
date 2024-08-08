<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_orden_comp extends Model
{
    use HasFactory;
    protected $table = 'tb_orden_compl';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'orden',
        'cliente',
        'estacion',
        'codigo',
        'cod_estacion',
        'id_estacion_w',
        'estacion_w',
        'fecha_emision',
        'fecha_vencimiento',
        'fecha_venta',
        'guia',
        'nombre',
        'placa',
        'km',
        'galones',
        'estado_upload',
        'observacion',
        'estado_orden',
        'created_at',
        'updated_at'
    
    ];
}
