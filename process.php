<?php
session_start();
include 'conexionviceversa.php'; // Incluye las variables y la conexión

// Insertar datos desde el formulario a la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $ciudad = $_POST["ciudad"];

    $sql = "INSERT INTO personas (nombre, edad, ciudad) VALUES ('$nombre', '$edad', '$ciudad')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error al insertar datos: " . $mysqli->error;
    }
}

// Obtener datos desde la base de datos y mostrarlos en la página
$sql = "SELECT * FROM personas";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["nombre"] . ", " . $row["edad"] . " años, Ciudad: " . $row["ciudad"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay datos en la base de datos.";
}

$mysqli->close();
?>
