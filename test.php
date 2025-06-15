<?php

$host = "localhost";
$usuario = "postulaciones";
$clave = 'z$c6D4g07';
$db = "postulaciones";


error_reporting(E_ALL);
ini_set('display_errors', 1);
// Crear conexión
$conn = new mysqli($host, $usuario, $clave, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}
echo "Conexion exitosa<br>";


// Cerrar la conexión
$conn->close();
?>
