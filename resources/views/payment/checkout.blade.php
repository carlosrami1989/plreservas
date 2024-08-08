<!-- resources/views/payment/checkout.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Pagar</title>
</head>
<body>
<h1>Pagar</h1>
<form action="{{ route('payment.status') }}" class="paymentWidgets"
      data-brands="VISA MASTER">
</form>
<script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{ $response['id'] }}"></script>
<script type="text/javascript" src="https://www.datafast.com.ec/js/dfAdditionalValidations1.js"></script>
</body>
</html>
