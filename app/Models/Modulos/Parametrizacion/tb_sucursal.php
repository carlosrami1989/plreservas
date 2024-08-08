<?php

namespace App\Models\Modulos\Parametrizacion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_sucursal extends Model
{
    use HasFactory;
    protected $table = 'config_sucursales';

    protected $fillable = [
        'Sucursal_Id',
        'Empresa_Id',
        'Sucursal_Nombre',
        'Sucursal_Direccion',
        'Sucursal_Telefonos',
        'Sucursal_Administrador',
        'Sucursal_EMail',
        'Sucursal_Fax',
        'Sucursal_Actividad',
        'Sucursal_Actividad_Inicio',
        'Sucursal_Matriz',
        'Sucursal_Provincia',
        'Sucursal_Canton',
        'Sucursal_Parroquia',
        'campo1',
        'campo2',
        'campo3',
        'registro',
        'usu_created',
        'created_at',
        'usu_update',
        'updated_at',
        'pcip',
        'status',
        'hora_inicio',
        'hora_fin'
    ];
}
