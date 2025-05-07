<?php
include '../config/conexion_worksync.php';

$correo = $_POST['correo'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Consulta segura
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ? AND contrasena_hash = ?");
$stmt->bind_param("ss", $correo, $contrasena);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    session_start();
    $_SESSION['correo'] = $correo;
    header("Location: inicio.php"); // Redirige a la página de inicio
    exit();
} else {
    echo "<script>
        alert('Correo o contraseña incorrectos');
        window.location.href = 'index.php';
    </script>";
}

$stmt->close();
$conn->close();
?>

