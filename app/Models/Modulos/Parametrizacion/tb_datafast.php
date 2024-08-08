<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_datafast extends Model
{
    use HasFactory;
    protected $table = 'tb_datafast';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
      'id',
    'ndc',
    'codigo',
    'mensaje',
    'holder',
    'des_campo1',
    'created_at',
    'updated_at'
    ];


}
