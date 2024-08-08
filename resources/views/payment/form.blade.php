<!DOCTYPE html>
<html>
<head>
    <title>Generar Pago</title>
</head>
<body>
<h1>Generar Pago</h1>
<form action="{{ route('payment.create') }}" method="POST">
    @csrf
    <label for="amount">Monto:</label>
    <input type="text" id="amount" name="amount" required>
    <br>
    <label for="currency">Moneda:</label>
    <input type="text" id="currency" name="currency" required>
    <br>
    <button type="submit">Generar Pago</button>
</form>
</body>
</html>
