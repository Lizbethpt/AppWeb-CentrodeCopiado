<?php
include 'conexion.php';

// Consultar los pedidos de la base de datos
$result = $mysqli->query("SELECT p.id, p.codigo, p.fecha, c.nombre AS cliente 
                          FROM pedidos p 
                          JOIN clientes c ON p.cliente_id = c.id");

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>ID Pedido</th><th>Cliente</th><th>Fecha</th><th>Estado</th></tr></thead><tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['cliente'] . "</td>";
        echo "<td>" . $row['fecha'] . "</td>";
        echo "<td>Pendiente</td>";  // Puedes agregar lógica para el estado del pedido
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "No hay pedidos registrados.";
}
?>
