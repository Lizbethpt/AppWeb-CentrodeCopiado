<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>
  <style>
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .navbar {
      background-color: #00171f;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
    }

    .navbar .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 20px;
    }

    .navbar-brand {
      color: #fff;
      text-decoration: none;
      font-size: 24px;
    }

    .navbar-nav {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }

    .navbar-nav li {
      margin-left: 20px;
    }

    .navbar-nav a {
      color: #fff;
      text-decoration: none;
      padding: 14px 20px;
    }

    .main {
      padding-top: 70px; /* Espacio para la barra de navegación fija */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Para centrar verticalmente */
    }

    .contact-info {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    .contact-info h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .contact-info p {
      margin-bottom: 10px;
      color: #666;
    }
  </style>
</head>
<body>
  <header>
  <nav class="navbar">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="logo.png" alt="logo" style="width: 40px; height: 40px;">
          Centro de Copiado
        </a>
        <ul class="navbar-nav">
          <li><a href="Index.html">Inicio</a></li>
          <li><a href="Productos.html">Productos</a></li>
          <li><a href="Procesar_contacto.php">Contacto</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <main class="main">
    <div class="contact-info">
      <h2>Datos de contacto</h2>
      <p><strong>Nombre de la Empresa:</strong> Centro de Copiado</p>
      <p><strong>Teléfono:</strong> 123-456-7890</p>
      <p><strong>Correo electrónico:</strong> centrodecopiado@gmail.com</p>
      <p><strong>Dirección:</strong> Francisco I. Madero #1113, Monclova, Coahuila, México</p>
    </div>
  </main>
</body>
</html>
