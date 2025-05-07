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
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WorkSync</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="container">

    <!-- Pantalla Inicial -->
    <div id="pantalla-inicial" class="login-box">
      <img src="images/logo.png.png" alt="Logo WorkSync" class="logo" />
      <img src="images/ilustracion.png.jpg" alt="Ilustración" class="illustration" />
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
      <img src="images/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Inicia Sesión para continuar</p>
      <form action="login.php" method="POST">
        <input type="email" name="correo" placeholder="Introduce tu correo electrónico" class="input" required />
        <input type="password" name="clave" placeholder="Introduce tu contraseña" class="input" required />
        <label class="recordarme">
          <input type="checkbox" name="recordar" />
          Recordarme
        </label>
        <button type="submit" class="btn blue-btn">Continuar</button>
      </form>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

    <!-- Registro -->
    <div id="pantalla-registro" class="login-box oculto">
      <i class="fas fa-arrow-left back" onclick="mostrarPantalla('login')"></i>
      <img src="images/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Regístrate para continuar</p>
      <form action="registro.php" method="POST">
        <input type="email" name="correo" placeholder="Introduce tu correo electrónico" class="input" required />
        <input type="password" name="clave" placeholder="Crea una contraseña" class="input" required />
        <input type="tel" name="telefono" placeholder="Número de teléfono" class="input" required />
        <label class="recordarme">
          <input type="checkbox" name="recordar" />
          Recordarme
        </label>
        <button type="submit" class="btn blue-btn">Continuar</button>
      </form>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

    <!-- Recuperar Contraseña -->
    <div id="pantalla-recuperar" class="login-box oculto">
      <i class="fas fa-arrow-left back" onclick="volver()"></i>
      <img src="images/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Recupera tu contraseña</p>
      <form action="recuperar.php" method="POST">
        <input type="email" name="correo" placeholder="Introduce tu correo electrónico" class="input" required />
        <button type="submit" class="btn blue-btn">Enviar enlace de recuperación</button>
      </form>
      <p class="footer-text">
        Al recuperar tu contraseña, aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

  </div>

  <script src="scripts.js"></script>
</body>
</html>
