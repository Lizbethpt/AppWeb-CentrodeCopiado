<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Inicio de sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-header img {
            width: 80px;
            height: 57px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .checkbox label {
            display: flex;
            align-items: center;
        }

        .checkbox input {
            margin-right: 10px;
        }

        .btn-custom {
            background-color: #00171f;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #002233;
        }

        .text-center a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <img src="logo.png" alt="Logo">
            </div>
            <div class="card-body">
                <form action="Inicio_Sesion.php" method="POST">
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="usertype">Tipo de Usuario:</label>
                        <select name="usertype" id="usertype" class="form-control" required>
                            <option value="administrador">Administrador</option>
                            <option value="cliente">Cliente</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-custom w-100 mb-3">Iniciar sesión</button>
                    <?php
                    if(isset($error)) {
                        echo "<p style='color: red; margin-top: 10px;'>$error</p>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>