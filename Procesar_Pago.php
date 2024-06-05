<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seleccionar Método de Pago</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="radio"] {
      margin-right: 10px;
    }

    button[type="submit"] {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Selecciona tu método de pago</h1>
    
    <form id="payment-form">
      <label>
        <input type="radio" name="metodo_pago" value="Tarjeta de Crédito o débito" required> Tarjeta de Crédito o Débito
      </label>
      <label>
        <input type="radio" name="metodo_pago" value="PayPal" required> PayPal
      </label>
      <label>
        <input type="radio" name="metodo_pago" value="Transferencia Bancaria" required> Transferencia Bancaria
      </label>
      <label>
        <input type="radio" name="metodo_pago" value="Efectivo" required> Efectivo
      </label>
      <button type="submit">Continuar</button>
    </form>
  </div>

  <script>
    document.getElementById('payment-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const metodoPago = document.querySelector('input[name="metodo_pago"]:checked').value;
      localStorage.setItem('metodo_pago', metodoPago);
      window.location.href = 'ConfirmaCompra.php';
    });
  </script>
</body>
</html>
