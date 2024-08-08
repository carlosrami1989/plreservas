<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Seguimiento extends Model
{
    use HasFactory;
    protected $table = 'tb_tareas_seguimiento';
    /**
     * @var string
     */

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_tareas',
        'titulo',
        'observacion',
        'ruta_imagen',
        'fecha_seguimiento',
        'usuario_ingreso',
        'usuario_modificacion',
        'created_at',
        'updated_at'
    ];
    // public function Usuario()
    // {
    //     return $this->hasOne(Auth::class, 'usuario_ingreso', 'id');
    // }
    public function scopeDatosSeguimiento($query)
    {

        $nombres = User::select('name')
            ->whereColumn('usuario_ingreso', 'users.id')
            ->limit(1);

        $id_persona = User::select('id_persona')
            ->whereColumn('usuario_ingreso', 'users.id')
            ->limit(1);

        $id_perfil = User::select('perfil')
            ->whereColumn('usuario_ingreso', 'users.id')
            ->limit(1);




        $query->addSelect([
            'nombres' => $nombres,
            'id_persona' => $id_persona,
            'id_perfil' => $id_perfil,


            //'firma_medico'  => $firma_medico,
        ]);
    }
}