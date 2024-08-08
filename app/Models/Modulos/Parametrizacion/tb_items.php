<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_items extends Model
{
    use HasFactory;
    protected $table = 'tb_items';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
    'id_descripcion',
    'descripcion_items',
    'estado',
    'created_at',
    'updated_at'
    ];
}
