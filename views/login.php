<?php
include '../config/conexion_worksync.php';

$correo = $_POST['correo'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Consulta solo por el correo
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Comparación directa si NO usas password_hash
    if ($usuario['contrasena_hash'] === $contrasena) {
        session_start();
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['usu_nom'] = $usuario['nombre']; // Si quieres mostrarlo en la navbar
        header("Location: home.php");
        exit();
    } else {
        echo "<script>
            alert('Contraseña incorrecta');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Correo no encontrado');
        window.location.href = 'index.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
