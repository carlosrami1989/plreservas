<?php

namespace App\Imports;

 
use App\Models\Modulos\Parametrizacion\tb_guias_upload;

use Maatwebsite\Excel\Concerns\ToModel;

class GuiasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new tb_guias_upload([
            //
            'name'     => $row[0],
            'email'    => $row[0],
            'id' => $row[0],
            'orden' => $row[0],
            'cliente' => $row[0],
            'estacion' => $row[0],
            'codigo' => $row[0],
            'cod_estacion' => $row[0],
            'fecha_emision' => $row[0],
            'fecha_vencimiento' => $row[0],
            'fecha_venta' => $row[0],
            'volumen' => $row[0],
            'producto' => $row[0],
            'valor' => $row[0],
            'factura' => $row[0],
            'autorizacion' => $row[0],
            'fecha_autorizacion' => $row[0],
            'clave_acceso' => $row[0],
            'correo' => $row[0],
            'identificacion' => $row[0],
        ]);
    }
}
