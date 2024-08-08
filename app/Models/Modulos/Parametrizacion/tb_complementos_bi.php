<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_complementos_bi extends Model
{
    use HasFactory;
    protected $table = 'tb_complementos_bi';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'descripcion',
        'valor',
        'color',
        'icono',
        'estacion',
        'mes',
        'created_at',
        'updated_at'
    ];

   
}
