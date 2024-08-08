<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modulos\Parametrizacion\tb_items;

class tb_descripcion_check extends Model
{
    use HasFactory;
    protected $table = 'tb_descripcion_check';
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

    public function Items()
    {
        return $this->hasMany(tb_items::class, 'id_descripcion', 'id');
    }
}
