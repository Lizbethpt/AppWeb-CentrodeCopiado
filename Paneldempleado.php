<?php
// Establecer conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de los pedidos y sus detalles, incluyendo los datos del cliente
$sql = "SELECT pedidos.id AS pedido_id, pedidos.codigo AS codigo_pedido, pedidos.fecha AS fecha_pedido, 
               pedidos.estado AS estado_pedido, detalle_pedidos.cantidad AS cantidad_producto, 
               detalle_pedidos.precio_unitario AS precio_unitario_producto, 
               detalle_pedidos.cantidad * detalle_pedidos.precio_unitario AS total_producto,
               productos.nombre AS nombre_producto,
               clientes.id AS cliente_id, clientes.nombre AS nombre_cliente
        FROM pedidos
        INNER JOIN detalle_pedidos ON pedidos.id = detalle_pedidos.pedido_id
        INNER JOIN productos ON detalle_pedidos.producto_id = productos.id
        INNER JOIN clientes ON pedidos.cliente_id = clientes.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Empleado</title>
    <!-- Estilos CSS -->
    <style>
            body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #00171f;
            padding: 20px;
            color: #fff;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        main {
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 20px;
            color: #00171f;
        }

        .summary {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .summary h2 {
            color: #00171f;
            margin-bottom: 10px;
        }

        .orders table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders th, .orders td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .orders th {
            background-color: #f0f0f0;
        }

        footer {
            background-color: #00171f;
            padding: 20px;
            color: #fff;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <!-- Encabezado y navegación -->
    <header>
        <!-- Encabezado y navegación aquí -->
    </header>

    <!-- Contenido principal -->
    <main>
        <div class="container">
            <h1>Panel de Control del Empleado</h1>
            <div class="summary">
                <h2>Resumen de Pedidos</h2>
                <!-- Resumen de pedidos aquí -->
            </div>
            <div class="orders">
                <h2>Lista de Pedidos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Código de Orden</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>ID Cliente</th>
                            <th>Nombre Cliente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Conexión a la base de datos
                        $mysqli = new mysqli("tu_host", "tu_usuario", "tu_contraseña", "tu_base_de_datos");

                        // Comprobar la conexión
                        if ($mysqli->connect_error) {
                            die("Error en la conexión: " . $mysqli->connect_error);
                        }

                        // Obtener los detalles de los pedidos
                        $sql = "SELECT * FROM tabla_de_pedidos";
                        $result = $mysqli->query($sql);

                        // Mostrar los datos de los pedidos y sus detalles en la tabla
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["pedido_id"] . "</td>";
                                echo "<td>" . $row["codigo_pedido"] . "</td>";
                                echo "<td>" . $row["fecha_pedido"] . "</td>";
                                echo "<td>" . $row["estado_pedido"] . "</td>";
                                echo "<td>" . $row["cliente_id"] . "</td>";
                                echo "<td>" . $row["nombre_cliente"] . "</td>";
                                echo "<td>" . $row["nombre_producto"] . "</td>";
                                echo "<td>" . $row["cantidad_producto"] . "</td>";
                                echo "<td>" . $row["precio_unitario_producto"] . "</td>";
                                echo "<td>" . $row["total_producto"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='10'>No hay pedidos disponibles</td></tr>";
                        }

                        // Cerrar la conexión
                        $mysqli->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    

    <!-- Pie de página -->
    <footer>
        <!-- Pie de página aquí -->
    </footer>
</body>
</html>

<?php
// Cerrar conexión con la base de datos
$conn->close();
?>
x