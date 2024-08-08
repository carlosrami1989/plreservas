<?php

namespace App\Models\Modulos\Parametrizacion;

use App\Models\Modulos\Parametrizacion\tb_sucursal;
use App\Models\Modulos\Parametrizacion\tb_sucursal_mesa;
use App\Models\Modulos\Parametrizacion\tb_cliente;
use App\Models\Modulos\Parametrizacion\tb_datafast;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_reservas_clientes extends Model
{
    use HasFactory;
    protected $table = 'tb_resrvaciones';
    protected $fillable = [
        'id',
        'id_empresa',
        'id_sucursal',
        'id_mesa',
        'id_cliente_reserva',
        'numero_persona',
        'fecha_reserva',
        'hora_reserva',
        'hora_reserva_t',
        'descripcion',
        'celular',
        'pago',
        'transaccion',
        'src',
        'valor',
        'color',
        'icono',
        'created_at',
        'updated_at',
        'estado'
    ];

    public $timestamps = false;

    protected $casts = [
       
        'created_at' =>   'date:Y-m-d',
       
    ];

    public function scopeDatosReserva($query)
    {
        $sucursal = tb_sucursal::select('Sucursal_Nombre')
            ->whereColumn('id_sucursal', 'Sucursal_Id')
            ->limit(1);
		//cirujano
        $sucursa_mesa = tb_sucursal_mesa::select('descripcion')
        ->whereColumn('id_mesa', 'id')
        ->limit(1);

        $apellidos = tb_cliente::select('apellidos')
        ->whereColumn('id_cliente_reserva', 'id')
        ->limit(1);

        $nombres = tb_cliente::select('nombres')
        ->whereColumn('id_cliente_reserva', 'id')
        ->limit(1);
        $correo = tb_cliente::select('correo')
        ->whereColumn('id_cliente_reserva', 'id')
        ->limit(1);

        $datafast = tb_datafast::select('mensaje')
        ->whereColumn('transaccion', 'ndc')
        ->limit(1);

 
        $query->addSelect([
            'sucursal' => $sucursal,
            'sucursa_mesa' => $sucursa_mesa,
            'apellidos' => $apellidos,
            'nombres' => $nombres,
            'correo' => $correo,
            'datafast' => $datafast,
            
        ]);
    }
}
