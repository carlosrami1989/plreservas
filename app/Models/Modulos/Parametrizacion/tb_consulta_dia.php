<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_consulta_dia extends Model
{
    use HasFactory;

    protected $table = 'tb_consulta_dia';
    /**
     * @var string
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'dia',
        'mes',
        'anio',
        'descripcion',
        'galones',
        'total',
        'estacion',
        'created_at',
        'updated_at'
    ];
    

    public function scopeDatosEstacion($query)
    {
        $des_estacion = tb_estaciones::select('descripcion')
            ->whereColumn('estacion', 'id')
            ->limit(1);
		//cirujano
		 

 
        $query->addSelect([
            'des_estacion' => $des_estacion,
           
            
        ]);
    }
}
