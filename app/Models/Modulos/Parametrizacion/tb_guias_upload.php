<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Modulos\Parametrizacion\tb_orden_comp;

class tb_guias_upload extends Model
{
    use HasFactory;
    protected $table = 'tb_guias_upload';
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
        'fecha_emision',
        'fecha_vencimiento',
        'fecha_venta',
        'volumen',
        'producto',
        'valor',
        'factura',
        'autorizacion',
        'fecha_autorizacion',
        'clave_acceso',
        'correo',
        'identificacion',
        'created_at',
        'updated_at',
        'estado_upload',
        'estado_orden',
    ];

    public function OrdenLis()
    {
        return $this->hasOne(tb_orden_comp::class, 'orden', 'orden');
    }
}
