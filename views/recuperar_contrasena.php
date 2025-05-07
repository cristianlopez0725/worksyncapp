<?php
include("../config/conexion_worksync.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"] ?? '';
    $nueva_clave = $_POST["nueva_clave"] ?? '';
    $confirmar_clave = $_POST["confirmar_clave"] ?? '';

    if ($nueva_clave === $confirmar_clave) {
        $stmt = $conn->prepare("UPDATE usuarios SET contrasena_hash = ? WHERE correo = ?");
        $stmt->bind_param("ss", $nueva_clave, $correo);

        if ($stmt->execute()) {
            echo "<script>alert('Contraseña actualizada con éxito'); window.location.href='index.php';</script>";
        } else {
            echo "Error al actualizar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Las contraseñas no coinciden.";
    }

    $conn->close();
}
?>
        