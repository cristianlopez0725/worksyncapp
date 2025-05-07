<?php
include '../config/conexion_worksync.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena_hash'];

$sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND contrasena_hash = '$contrasena'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    echo "Inicio de sesión exitoso";
    // Puedes redirigir: header("Location: dashboard.php");
} else {
    echo "Correo o contraseña incorrectos";
}

$conn->close();
?>

