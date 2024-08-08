 
  
 
<table class="configTableCaberaAll configBorderItem configTextItem2 topCabecera" >
    <tr class="cabeceras" >
        <td>Nº</td>
        <td>ESTACION</td>
        <td>Fecha </td>
        <td>Monto Total Efectivo</td>
        <td>Monto Total Galones</td>
       
        
    </tr>
    @php
    $cont = 0;
    @endphp
    @for($i=0; $i < sizeof($lista) ; $i++) <tr>
        @php
        $cont = $i;
        $cont +=1;

        @endphp
        <td   > {{$cont}}</td>
        <td > {{ $lista[$i]->des_estacion }}</td>
               <td > {{ $lista[$i]->dia  }}</td>
        <td > {{ $lista[$i]->total_dolares  }} </td>
        <td > {{ $lista[$i]->galones  }}</td>
       
        </tr>

        @endfor


</table>




<table style="position: fixed;bottom: 0px;">
    <thead>
        <tr>
            
        </tr>
    </thead>
</table>


 