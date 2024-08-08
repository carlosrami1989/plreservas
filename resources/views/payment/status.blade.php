<!-- resources/views/payment/status.blade.php -->
<!DOCTYPE html>
 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
     
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">

    <!-- Icono de la Pestaña -->
    <link rel="shortcut icon" href="{{ asset('img/icono.jpg') }}">

 
    <!-- Fonts -->
    

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

    <!-- Scripts -->
 
</head>

<body >
    <div style="text-align:center;">
    @if ($statusResponse['result']['code'] == '000.100.110')
        <span>
        <a href="/"> Transaccion realizada con éxito</a>    
        {{ print_r($statusResponse) }}
       </span>

    @else
    <span><a href="/"></a>Error a realizar la reserva</a></span>
    {{ print_r($statusResponse) }}
    @endif 
   
       
    </div>

 
    </body>
    <!-- App JS de Vue -->
 <style>
    div {
        position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
    background-color: white;
   
    justify-content: center;
    align-items: center;
    
}

div span {
   
    text-align: center;
}
body {
  background: url( "/img/fondo.jpg"); 
  background-size: cover;
  background-repeat: no-repeat;
  margin: 0;
  height: 100vh;
}
 </style>
</html>





