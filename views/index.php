<?php
include("../config/conexion_worksync.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"] ?? '';
    $clave = $_POST["contrasena"] ?? '';

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        // Compara la clave directamente sin hash
        if ($clave === $row["contrasena_hash"]) {
            session_start();
            $_SESSION["usu_id"] = $row["id"];
            $_SESSION["correo"] = $row["correo"];
            header("Location: inicio.php");
            exit();
        } else {
            echo "Correo o contraseña incorrectos";
        }
    } else {
        echo "Correo o contraseña incorrectos";
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WorkSync</title>
  <link rel="stylesheet" href="../public/css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="container">

    <!-- Pantalla Inicial -->
    <div id="pantalla-inicial" class="login-box">
      <img src="../images/logo.png.png" alt="Logo WorkSync" class="logo" />
      <img src="../images/ilustracion.png.jpg" alt="Ilustración" class="illustration" />
      <button class="btn white-btn" onclick="mostrarPantalla('login')">INICIAR SESIÓN</button>
      <button class="btn outlined-btn" onclick="mostrarPantalla('registro')">REGISTRARSE</button>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

    <!-- Login -->
    <div id="pantalla-login" class="login-box oculto">
  <i class="fas fa-arrow-left back" onclick="volver()"></i>
  <img src="../images/logo.png.png" alt="Logo WorkSync" class="logo" />
  <p class="subtitulo">Inicia Sesión para continuar</p>
  <form action="login.php" method="POST">
    <input type="email" name="correo" placeholder="Introduce tu correo electrónico" class="input" required />
    <input type="password" name="contrasena" placeholder="Introduce tu contraseña" class="input" required /> <!-- Cambié 'clave' por 'contrasena' -->
    <label class="recordarme">
      <input type="checkbox" name="recordar" />
      Recordarme
    </label>
    <button type="submit" class="btn blue-btn">Iniciar sesión</button> <!-- Cambié 'Continuar' por 'Iniciar sesión' para mejor claridad -->
  </form>
  <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
  <p class="footer-text">
    Al registrarte aceptas el <a href="#">Aviso al Usuario</a><br />
    y <a href="#">Políticas de Privacidad</a>
  </p>
</div>


<div id="pantalla-registro" class="login-box oculto">
  <i class="fas fa-arrow-left back" onclick="mostrarPantalla('login')"></i>
  <img src="../images/logo.png.png" alt="Logo WorkSync" class="logo" />
  <p class="subtitulo">Regístrate para continuar</p>
  <form action="registro.php" method="POST">
    <input type="text" name="nombre" placeholder="Tu nombre completo" class="input" required />
    <input type="email" name="correo" placeholder="Tu correo electrónico" class="input" required />
    <input type="text" name="telefono" placeholder="Tu número de teléfono" class="input" required />
    <input type="password" name="contrasena" placeholder="Crea una contraseña" class="input" required /> <!-- Cambié 'clave' por 'contrasena' -->
    <button type="submit" class="btn blue-btn">Registrarme</button>
  </form>
  <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
  <p class="footer-text">
    Al registrarte aceptas el <a href="#">Aviso al Usuario</a> y <a href="#">Políticas de Privacidad</a>
  </p>
</div>



   <!-- Pantalla Recuperar Contraseña -->
<div id="pantalla-recuperar" class="login-box oculto">
  <i class="fas fa-arrow-left back" onclick="volver()"></i>
  <img src="../images/logo.png.png" alt="Logo WorkSync" class="logo" />
  <p class="subtitulo">Recupera tu contraseña</p>
  <form action="recuperar_contrasena.php" method="POST">
    <input type="email" name="correo" placeholder="Correo registrado" class="input" required />
    <input type="password" name="nueva_clave" placeholder="Nueva contraseña" class="input" required />
    <input type="password" name="confirmar_clave" placeholder="Confirmar contraseña" class="input" required />
    <button type="submit" class="btn blue-btn">Cambiar contraseña</button>
  </form>
</div>


  <script src="../public/js/scripts.js"></script>
</body>
</html>
