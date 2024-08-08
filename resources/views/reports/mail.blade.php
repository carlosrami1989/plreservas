<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sistemas Reserva Pizza Libre</title>
   <style type="text/css">
      h1 {
         color: #0c0c0c;
      }

      p {
         font-size: 1rem;
      }

      img {
         width: 10rem;
         height: 10rem;
      }
   </style>
</head>

<body>
   <h1>SISTEMA DE REGISTRO DE RESERVA</h1>
   <hr>
   <h3>Pizza Libre Gye</h3>
   <hr>
   <span>Buenas tardes estimad@,{{  $distressCall->nombres }} {{  $distressCall->apellidos  }} le saluda la
      administración de Pizza Libre, comunicanto su reserva </span>
   <br>
   <br>
   <br>
   <table>
      <tr>
         <td><b>LOCAL:</b>
         </td>
         <td>{{  $distressCall->sucursal }}
         </td>
      </tr>
      <tr>
         <td><b>AMBIENTE:</b>
         </td>
         <td>{{  $distressCall->sucursa_mesa }}
         </td>
      <tr>
         <td><b>HORA:</b>
         </td>
         <td>{{  $distressCall->hora_reserva }}
         </td>
      <tr>
      <tr>
         <td><b>FECHA:</b>
         </td>
         <td>{{  $distressCall->fecha_reserva }}
         </td>
      <tr>
   </table>
   <h3>Términos y condiciones</h3>
   <ul>
      <li>Consentimiento para recibir comunicaciones de Pizza Libre </li>
      <li> Debe de estar el 70 % de las personas para las cuales se solicita la reserva para poder pasar a la mesa</li>
      <li>Solo podría reservarse el 50 % del local
      </li>
      <li>El tiempo de espera es de 10 minutos para mantener la reserva</li>
      <li>El abono es consumible no reembolsable</li>
   </ul>
</body>

</html>