<?php
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

    <!-- Pantalla principal -->
    <div id="pantalla-inicial" class="login-box">
      <img src="imagenes/logo.png.png" alt="Logo WorkSync" class="logo" />
      <img src="imagenes/ilustracion.png.jpg" alt="Ilustración" class="illustration" />
      <button class="btn white-btn" onclick="mostrarPantalla('login')">INICIAR SESIÓN</button>
      <button class="btn outlined-btn" onclick="mostrarPantalla('registro')">REGISTRARSE</button>
      <p class="continuar">o continua con</p>
      <button class="btn google-btn"><i class="fab fa-google icono"></i> Google</button>
      <button class="btn facebook-btn"><i class="fab fa-facebook-f icono"></i> Facebook</button>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

    <!-- Pantalla de Login -->
    <div id="pantalla-login" class="login-box oculto">
      <i class="fas fa-arrow-left back" onclick="volver()"></i>
      <img src="imagenes/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Inicia Sesión para continuar</p>
      <input type="email" placeholder="Introduce tu correo electrónico" class="input" />
      <input type="password" placeholder="Introduce tu contraseña" class="input" />
      <label class="recordarme">
        <input type="checkbox" />
        <i class="fas fa-check-circle"></i> Recordarme
      </label>
      <button class="btn blue-btn">Continuar</button>
      <p class="continuar">o continua con</p>
      <button class="btn google-btn"><i class="fab fa-google icono"></i> Google</button>
      <button class="btn facebook-btn"><i class="fab fa-facebook-f icono"></i> Facebook</button>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

    <div id="pantalla-registro" class="login-box oculto">
      <i class="fas fa-arrow-left back" onclick="mostrarPantalla('login')"></i>
      <img src="imagenes/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Regístrate para continuar</p>
      <input type="email" placeholder="Introduce tu correo electrónico" class="input" />
      <input type="password" placeholder="Crea una contraseña" class="input" />
      <input type="tel" placeholder="Número de teléfono" class="input" />
      <label class="recordarme">
        <input type="checkbox" />
        <i class="fas fa-check-circle"></i> Recordarme
      </label>
      <button class="btn blue-btn">Continuar</button>
      <p class="continuar">o continua con</p>
      <button class="btn google-btn"><i class="fab fa-google icono"></i> Google</button>
      <button class="btn facebook-btn"><i class="fab fa-facebook-f icono"></i> Facebook</button>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

    <div id="pantalla-recuperar" class="login-box oculto">
      <i class="fas fa-arrow-left back" onclick="volver()"></i>
      <img src="imagenes/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Recupera tu contraseña</p>
      <input type="email" placeholder="Introduce tu correo electrónico" class="input" />
      <button class="btn blue-btn">Enviar enlace de recuperación</button>
      <p class="footer-text">
        Al recuperar tu contraseña, aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>

  </div>

  <script src="../public/js/main.js"></script>
</body>
</html>
?>