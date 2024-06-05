<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cp";
$port = 3307;

$mysqli = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar la conexión
if ($mysqli->connect_errno) {
    echo "Falló la conexión: " . $mysqli->connect_error;
    exit();
}

// Configurar el método de autenticación
$mysqli->options(MYSQLI_INIT_COMMAND, 'SET SESSION sql_mode="NO_ENGINE_SUBSTITUTION"; SET default_authentication_plugin=mysql_native_password');

// Restablecer la conexión después de configurar la opción
$mysqli->real_connect($servername, $username, $password, $dbname, $port);

// Verificar la conexión de nuevo después de restablecer
if ($mysqli->connect_errno) {
    echo "Falló la conexión: " . $mysqli->connect_error;
    exit();
}
?>
