<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos de la compra desde la solicitud POST
    $cart = json_decode($_POST['cart'], true);
    $metodo_pago = $_POST['metodo_pago'];

    // Verificar que la variable de sesión 'cliente_id' esté establecida
    if (!isset($_SESSION['cliente_id'])) {
        echo "Error: No se encontró el ID del cliente en la sesión.";
        exit();
    }

    try {
        // Iniciar la transacción y preparar la consulta para insertar la orden en la tabla de pedidos
        $mysqli->begin_transaction();
        $stmt = $mysqli->prepare("INSERT INTO pedidos (codigo, cliente_id, fecha, estado) VALUES (?, ?, NOW(), 'pendiente')");
        if (!$stmt) {
            throw new Exception("Falló la preparación de la consulta: " . $mysqli->error);
        }
        
        // Obtener el ID del cliente de la sesión
        $cliente_id = $_SESSION['cliente_id'];

        // Generar un código de orden único
        $order_code = 'ORD-' . date('YmdHis') . rand(1000, 9999);

        // Ejecutar la consulta para insertar la orden
        $stmt->bind_param("si", $order_code, $cliente_id);
        $stmt->execute();
        $pedido_id = $stmt->insert_id;  // Obtener el ID del pedido insertado
        $stmt->close();

        // Insertar los detalles de la orden en la tabla de detalles_pedidos
        $stmt = $mysqli->prepare("INSERT INTO detalle_pedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Falló la preparación de la consulta de detalles: " . $mysqli->error);
        }
        foreach ($cart as $item) {
            $stmt->bind_param("iiid", $pedido_id, $item['id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }
        $stmt->close();

        // Confirmar la transacción
        $mysqli->commit();
        echo $pedido_id; // Devuelve el ID del pedido para mostrarlo en pedidos.html
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $mysqli->rollback();
        echo "Ocurrió un error al registrar la compra: " . $e->getMessage();
    }

    // Cerrar la conexión
    $mysqli->close();
}
?>
