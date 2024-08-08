<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_inspeccion extends Model
{
    use HasFactory;
    protected $table = 'tb_inspeccion';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
    'descripcion',
    'tipo',
    'estado',
    'created_at',
    'updated_at'
    ];
}
