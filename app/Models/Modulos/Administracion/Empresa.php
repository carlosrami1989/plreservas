<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    protected $table = 'tb_empresa';
    /**
     * @var string
     */
   
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'razon_social',
        'logos',
        'direccion',
        'ruc',
        'ciudad',
        'telefono',
        'parroquia',
        'email',
        'numpat',
        'representantel_legal',
        'ruc_representante_legal',
        'cargo',
        'usuario_ingreso',
        'usuario_modificacion',
        'created_at',
        'updated_at'
    ];
}
