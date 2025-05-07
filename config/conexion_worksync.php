<?php
$host = "localhost";
$usuario = "root";
$contrasena = ""; // cambia esto si tu BD tiene contraseña
$base_de_datos = "worksync";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
