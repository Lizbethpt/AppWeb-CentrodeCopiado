<?php
include 'conexion.php'; // Incluye las variables y la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $usertype = $_POST['usertype']; // Tipo de usuario seleccionado

    // Verificar si el nombre de usuario ya existe
    $sql_check = "SELECT * FROM usuarios WHERE nombre = ?";
    if ($stmt_check = $mysqli->prepare($sql_check)) {
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $stmt_check->store_result();
        if ($stmt_check->num_rows > 0) {
            $stmt_check->close();
            $mysqli->close();
            echo "Ya existe un usuario con ese nombre.";
            exit();
        }
        $stmt_check->close();
    } else {
        echo "Error al preparar la consulta de verificación: " . $mysqli->error;
        exit();
    }

    // Si el nombre de usuario no existe, procedemos a insertar el nuevo usuario
    $sql_insert = "INSERT INTO usuarios (nombre, contraseña, correo_electronico, telefono, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
    if ($stmt_insert = $mysqli->prepare($sql_insert)) {
        $stmt_insert->bind_param("sssss", $username, $password, $email, $phone, $usertype);
        if ($stmt_insert->execute()) {
            // Obtener el ID del nuevo usuario insertado
            $last_id = $stmt_insert->insert_id;

            // Si el usuario registrado es un cliente, también lo insertamos en la tabla de clientes
            if ($usertype == 'cliente') {
                $sql_insert_cliente = "INSERT INTO clientes (id, nombre, correo_electronico, telefono, tipo_usuario) VALUES (?, ?, ?, ?, ?)";
                if ($stmt_insert_cliente = $mysqli->prepare($sql_insert_cliente)) {
                    $stmt_insert_cliente->bind_param("issss", $last_id, $username, $email, $phone, $usertype);
                    if ($stmt_insert_cliente->execute()) {
                        echo "Registro exitoso";
                        header('Location: Inicio_Sesioon.php');
                        exit();
                    } else {
                        echo "Error al registrar el cliente: " . $stmt_insert_cliente->error;
                    }
                    $stmt_insert_cliente->close();
                } else {
                    echo "Error al preparar la consulta de inserción de cliente: " . $mysqli->error;
                }
            } else {
                // Si el usuario registrado es un administrador, no se inserta en la tabla de clientes
                echo "Registro exitoso";
                header('Location: Inicio_Sesioon.php');
                exit();
            }
        } else {
            echo "Error al registrar el usuario: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    } else {
        echo "Error al preparar la consulta de inserción: " . $mysqli->error;
    }

    $mysqli->close(); // Cierra la conexión
}
?>
