<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_cliente extends Model
{
    use HasFactory;
    protected $table = 'par_cliente';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $primary_key = 'cedula';
    

    protected $fillable = [
        'id',
    'nombres',
    'apellidos',
    'cedula',
    'telefono',
    'direccion',
    'correo',
    'usu_created',
    'usu_update',
    'created_at',
    'updated_at',
    'pcip',
    'status'
    ];

    protected $appends = [
        'FULLNAME' 
  ];
  public function getFULLNAMEattribute()
  {
      $nombres =  $this->apellidos.' '.$this->nombres.' - '.$this->placas;

      return $nombres;
  }
}
