<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modulos\Administracion\Persona;
use App\Models\Modulos\Administracion\Empresa;
use App\Models\Modulos\Administracion\Seguimiento;

class Tareas extends Model
{
    use HasFactory;
    protected $table = 'tb_tareas';
    /**
     * @var string
     */

    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_empresa',
        'descripcion',
        'observacion',
        'id_persona',
        'estado_tarea',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'usuario_ingreso',
        'usuario_modificacion',
        'created_at',
        'updated_at'
    ];
    public function Totales()
    {
        return $this->hasMany(Seguimiento::class, 'id_tareas', 'id');
    }
    public function scopeDatosPersona($query)
    {
        //cedula
        $cedula = Persona::select('cedula')
            ->whereColumn('id_persona', 'tb_persona.id')
            ->limit(1);
        //genero
        //paciente
        $apellidos = Persona::select('apellidos')
            ->whereColumn('id_persona', 'tb_persona.id')
            ->limit(1);
        $nombres = Persona::select('nombres')
            ->whereColumn('id_persona', 'tb_persona.id')
            ->limit(1);

        $razon_social = Empresa::select('razon_social')
            ->whereColumn('id_empresa', 'tb_empresa.id')
            ->limit(1);
        // $seguimiento = Seguimiento::where('id', 'tb_tareas_seguimiento.id_tareas')
        // ->count();


        $query->addSelect([
            'cedula' => $cedula,
            'apellidos' => $apellidos,
            'nombres' => $nombres,
            'porcentaje' => $cedula,
            'razon_social' => $razon_social,
            //'seguimiento' => $seguimiento,

            //'firma_medico'  => $firma_medico,
        ]);
    }
}