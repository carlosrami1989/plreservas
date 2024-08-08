<?php

namespace App\Models\Modulos\Administracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaeeasNormales extends Model
{
    use HasFactory;
    protected $table = 'tb_tareas_normal';
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
        'id_persona_solicita',
        'estado_tarea',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'prioridad',
        'usuario_ingreso',
        'usuario_modificacion',
        'created_at',
        'updated_at'
    ];
    public function Totales()
    {
        return $this->hasMany(Seguimiento::class, 'id_tareas', 'id');
    }
    protected $appends = [
        'FULLNAMEPERRSONA',
        'FULLNAMEPERRSONASOLICITA',

  ];
  public function getFULLNAMEPERRSONAattribute()
  {
  
      $nombres =  trim($this->apellidos).' '.trim($this->nombres);

      return $nombres;
  }

  public function getFULLNAMEPERRSONASOLICITAattribute()
  {
  
      $nombres =  trim($this->apellidos_solicita).' '.trim($this->nombres_solicita);

      return $nombres;
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
        //paciente
        $apellidos_solicita = Persona::select('apellidos')
            ->whereColumn('id_persona_solicita', 'tb_persona.id')
            ->limit(1);
        $nombres_solicita = Persona::select('nombres')
            ->whereColumn('id_persona_solicita', 'tb_persona.id')
            ->limit(1);


        $query->addSelect([
            'cedula' => $cedula,
            'apellidos' => $apellidos,
            'nombres' => $nombres,
            'porcentaje' => $cedula,
            'razon_social' => $razon_social,
            'apellidos_solicita' => $apellidos_solicita,
            'nombres_solicita' => $nombres_solicita,
            //'seguimiento' => $seguimiento,

            //'firma_medico'  => $firma_medico,
        ]);
    }
}
