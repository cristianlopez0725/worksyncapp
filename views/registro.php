<?php 
require_once("../config/conexion_worksync.php");
require_once("../models/Usuario.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proceso de login
if (isset($_POST["enviar"]) && $_POST["enviar"] === "si") {
    $usuario = new Usuario();
    $usuario->login();
}
?>
<div id="pantalla-registro" class="login-box oculto">
      <i class="fas fa-arrow-left back" onclick="volver()"></i>
      <img src="imagenes/logo.png.png" alt="Logo WorkSync" class="logo" />
      <p class="subtitulo">Regístrate para continuar</p>
      <input type="email" placeholder="Introduce tu correo electrónico" class="input" />
      <input type="password" placeholder="Crea una contraseña" class="input" />
      <label class="recordarme">
        <input type="checkbox" />
        <i class="fas fa-check-circle"></i> Recordarme
      </label>
      <button class="btn blue-btn">Continuar</button>
      <button class="btn lightblue-btn" onclick="mostrarPantalla('login')">Iniciar sesión</button>
      <a href="#" class="recuperar" onclick="mostrarPantalla('recuperar')">Recuperar contraseña</a>
      <p class="footer-text">
        Al registrarse aceptas el <a href="#">Aviso al Usuario</a><br />
        y <a href="#">Políticas de Privacidad</a>
      </p>
    </div>