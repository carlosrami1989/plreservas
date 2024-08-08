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

    <!-- Plantilla General de los CSS -->
    <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">

    <!-- Evitar ataques X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->

    <!-- Scripts -->
 
</head>

<body >
    

    <!-- Main Sidebar Container -->
    
    <div id="app"   >
    
     
    <home :user="{{ json_encode(Auth::user()) }}"></home>
    </v-app>
 
   
    </div>
 

    </body>
    <!-- App JS de Vue -->
    <script src="https://apis.google.com/js/api.js" ></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    
  
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Plantilla General de los JS -->
    <script src="{{ asset('js/plantilla.js') }}"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
   
 
<link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

<script type="text/javascript" src="https://www.datafast.com.ec/js/dfAdditionalValidations1.js"></script>
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    var wpwlOptions= {
        style: "card",
        locale: "es",
        labels: {cvv: "CVV", cardHolder: "Nombre(Igual que en la tarjeta)"},
            onBeforeSubmitCard: function(){
                if($("$.wpwl-control-cardHolder").val()===""){
                    $(".wpwl-control-cardHolder").addClass("wpwl-has-error");
                    $(".wpwl-button-CardHolder").after("<div class='wpwl-hint-cardHolderError'>Campo requerido</div>");
                    $(".wpwl-button-pay").addClass("wpwl-button-error").attr("disabled", "disabled");
                    return false;
                }else
                    return true;
                }
    }
</script>
 
</html>
