<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // si tienes contraseña ponla aquí
$base_datos = "worksync";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
