<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareasAdicional extends Model
{
    use HasFactory;
    protected $table = 'tb_tareas_adicional';
    /**
     * @var string
     */

     public $timestamps = false;

     protected $fillable = [
      'id',
      'id_tareas',
      'id_persona',
      'created_at',
      'updated_at'
     ];
}
