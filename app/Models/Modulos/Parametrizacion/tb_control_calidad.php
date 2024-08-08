<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_control_calidad extends Model
{
    use HasFactory;
    protected $table = 'tb_control_calidad';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_cliente',
        'orden_entrada',
        'orden_salida',
        'km',
        'fecha_revision',
        'hora_revision',
        'cedula_entrega',
        'cedula_recibe',
        'firma_entrega',
        'firma_recibe',
        'motivo',
        'observacion',
        'estado',
        'created_at',
        'updated_at'
    ];
}
