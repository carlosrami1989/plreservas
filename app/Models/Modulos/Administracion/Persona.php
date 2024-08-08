<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'tb_persona';
    /**
     * @var string
     */

     public $timestamps = false;

     protected $fillable = [
        'id',
        'cedula',
        'apellidos',
        'nombres',
        'id_tipo',
        'telefono',
        'celular',
        'direccion',
        'sexo',
        'ciudad',
        'provincia',
        'parroquia',
        'email',
        'email_corp',
        'tipo_sangre',
        'fecha_na',
        'estado',
        'created_at',
        'updated_at'
     ];
    //  protected $casts = [
    //     'nombres' => 'nombres',
    //     'apellidos' => trim('apellidos'),
    // ];
     protected $appends = [
           'FULLNAME' 
     ];
     public function getFULLNAMEattribute()
     {
         $nombres =  trim($this->apellidos).' '.trim($this->nombres);
 
         return $nombres;
     }
   
}
