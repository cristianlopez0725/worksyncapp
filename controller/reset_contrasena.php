<?php
session_start();
include("../config/conexion_worksync.php");

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar token válido y no expirado
    $stmt = $conn->prepare("SELECT id, token_expira FROM usuarios WHERE token_recuperacion = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (strtotime($usuario['token_expira']) >= time()) {
            // Mostrar formulario para cambiar contraseña
            ?>
            <form method="POST" action="reset_password.php">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <input type="password" name="nueva_contrasena" placeholder="Nueva contraseña" required>
                <input type="password" name="confirmar_contrasena" placeholder="Confirmar contraseña" required>
                <button type="submit">Cambiar contraseña</button>
            </form>
            <?php
        } else {
            echo "El enlace ha expirado.";
        }
    } else {
        echo "Token inválido.";
    }

} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Procesar cambio de contraseña
    $token = $_POST['token'] ?? '';
    $nueva_contrasena = $_POST['nueva_contrasena'] ?? '';
    $confirmar_contrasena = $_POST['confirmar_contrasena'] ?? '';

    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Validar token y que no haya expirado
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE token_recuperacion = ? AND token_expira >= NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Hashear contraseña (recomendado)
        $password_hash = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

        // Actualizar contraseña y borrar token
        $stmt_update = $conn->prepare("UPDATE usuarios SET contrasena_hash = ?, token_recuperacion = NULL, token_expira = NULL WHERE id = ?");
        $stmt_update->bind_param("si", $password_hash, $usuario['id']);
        $stmt_update->execute();

        echo "Contraseña cambiada exitosamente. <a href='login.php'>Inicia sesión</a>";

    } else {
        echo "Token inválido o expirado.";
    }

} else {
    echo "Solicitud inválida.";
}
