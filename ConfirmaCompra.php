<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmación de Compra</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
    }
    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
    }
    .header {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
    }
    .header img {
      width: 50px;
      height: 50px;
      margin-right: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table, th, td {
      border: 1px solid #ccc;
    }
    th, td {
      padding: 10px;
      text-align: left;
    }
    .total {
      text-align: right;
      margin-top: 20px;
      font-size: 1.2em;
    }
    .method {
      text-align: center;
      margin-top: 20px;
      font-size: 1.1em;
      font-weight: bold;
    }
    .button {
      display: block;
      width: 100%;
      padding: 10px;
      text-align: center;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1em;
      cursor: pointer;
    }
    .button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="logo.png" alt="Logo">
      <h1>Centro de Copiado</h1>
    </div>
    <h2>Detalles de Compra</h2>
    <p><strong>Código de Orden:</strong> <span id="order-code"></span></p>
    <table class="order-details">
      <thead>
        <tr>
          <th>Producto</th>
          <th>Cantidad</th>
          <th>Precio Unitario</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody id="order-items">
        <!-- Productos aquí -->
      </tbody>
    </table>
    <p class="total">Total: $<span id="order-total"></span></p>
    <p class="method">Método de Pago: <span id="payment-method"></span></p>
    <button class="button" onclick="confirmarCompra()">Confirmar Compra</button>
  </div>
  <script>
    function generateOrderCode() {
      // Genera un código único basado en la fecha y hora actuales
      const date = new Date();
      const components = [
        date.getFullYear(),
        ("0" + (date.getMonth() + 1)).slice(-2),
        ("0" + date.getDate()).slice(-2),
        ("0" +         date.getHours()).slice(-2),
        ("0" + date.getMinutes()).slice(-2),
        ("0" + date.getSeconds()).slice(-2),
        date.getMilliseconds()
      ];
      return 'ORD-' + components.join('');
    }

    function loadOrderDetails() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const paymentMethod = localStorage.getItem('metodo_pago') || 'No especificado';
      const orderCode = generateOrderCode();

      document.getElementById('order-code').textContent = orderCode;
      document.getElementById('payment-method').textContent = paymentMethod;

      const orderItems = document.getElementById('order-items');
      let total = 0;

      cart.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${item.name}</td>
          <td>${item.quantity}</td>
          <td>$${item.price.toFixed(2)}</td>
          <td>$${(item.price * item.quantity).toFixed(2)}</td>
        `;
        orderItems.appendChild(tr);
        total += item.price * item.quantity;
      });
      document.getElementById('order-total').textContent = total.toFixed(2);
    }

// Llama a esta función después de que se confirme una compra exitosamente
confirmarCompra()
  .then(compraId => cargarDetallesCompra(compraId))
  .catch(error => console.error('Error al confirmar la compra:', error));

function confirmarCompra() {
  const cart = JSON.parse(localStorage.getItem('cart')) || [];
  const paymentMethod = localStorage.getItem('metodo_pago') || 'No especificado';

  return fetch('Confirmacioncompra.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: new URLSearchParams({
      cart: JSON.stringify(cart),
      metodo_pago: paymentMethod
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('No se pudo confirmar la compra');
    }
    return response.text();
  })
  .catch(error => {
    console.error('Error al confirmar la compra:', error);
    alert('Ocurrió un error al procesar la compra.');
  });
}

    // Cargar los detalles de la orden al cargar la página
    window.onload = loadOrderDetails;
  </script>
</body>
</html>

