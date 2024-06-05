<?php
include 'conexion.php';

// Consulta para obtener los datos de los pedidos
$sql = "SELECT pedidos.id, pedidos.codigo, clientes.nombre AS cliente, pedidos.fecha, pedidos.estado
        FROM pedidos
        INNER JOIN clientes ON pedidos.cliente_id = clientes.id";

$resultado = $mysqli->query($sql);

if ($resultado) {
    $pedidos = [];
    while ($fila = $resultado->fetch_assoc()) {
        // Agregar cada pedido a la lista de pedidos
        $pedidos[] = [
            'id' => $fila['id'],
            'codigo' => $fila['codigo'],
            'cliente' => $fila['cliente'],
            'fecha' => $fila['fecha'],
            'estado' => $fila['estado']
        ];
    }

    // Devolver los datos de los pedidos en formato JSON
    echo json_encode($pedidos);
} else {
    echo json_encode(['error' => 'Error al obtener los datos de los pedidos']);
}

// Cerrar la conexión
$mysqli->close();
?>
