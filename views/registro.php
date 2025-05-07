<?php
include '../config/conexion_worksync.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $contrasena = $_POST['contrasena'] ?? ''; // Sin hashear aún (lo haremos después)
    
    // Hashear la contraseña para almacenarla de forma segura
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
    
    // Consulta para verificar si el correo ya existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si el correo ya existe, mostrar mensaje de error
        echo "<script>
            alert('Este correo ya está registrado');
            window.location.href = 'index.php';
        </script>";
    } else {
        // Si no existe, insertar los nuevos datos del usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, correo, telefono, contrasena_hash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $correo, $telefono, $contrasena_hash);
        
        if ($stmt->execute()) {
            echo "<script>
                alert('Registro exitoso');
                window.location.href = 'index.php'; // Regresar a la pantalla de inicio
            </script>";
        } else {
            echo "<script>
                alert('Error al registrar el usuario');
                window.location.href = 'index.php';
            </script>";
        }
    }
    
    $stmt->close();
    $conn->close();
}
?>
