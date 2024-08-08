<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
 
use App\Models\Modulos\Parametrizacion\tb_guias_upload;


class GuiasUpload implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        return [
            'product' => $collection[0],
            'units' => $collection[1]
        ];
       
    }
}
