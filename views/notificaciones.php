<?php
include('../config/conexion_worksync.php'); // Incluye la conexión a la base de datos
session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gestor de Tareas</title>
  <link rel="stylesheet" href="../public/css/noti.css" />
  <link rel="stylesheet" href="../public/css/menu.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../images/logo2.png" alt="Logo WorkSync" style="height: 60px; width: auto; margin-right: 10px;">
            
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="home.php"><i class="bi bi-house"></i> Inicio</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="perfilUsuario.php"><i class="bi bi-person-circle"></i> Perfil</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="proyectos.php"><i class="bi bi-folder2-open"></i> Proyectos</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="logros.php"><i class="bi bi-trophy"></i> Logros</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="estadisticas.php"><i class="bi bi-bar-chart-line"></i> Estadísticas</a>
                </li>
                <li class="nav-item mx-2">
                    <span class="nav-link text-white"><i class="bi bi-person-check"></i> <?php echo $_SESSION['correo']; ?></span>
                </li>
                <li class="nav-item mx-2">
                    <a class="btn btn-outline-light btn-sm" href="index.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
  <div class="container">
    <form id="task-form">
      <input type="text" id="task-title" placeholder="Título de la tarea" required />
      <input type="datetime-local" id="task-deadline" required />
      <input type="email" id="task-email" placeholder="Correo para notificación" required />
      <button type="submit">Agregar Tarea</button>
    </form>
    <ul id="task-list"></ul>
    <!-- Botón para redirigir a ChatGPT -->
    <a href="https://chat.openai.com/" target="_blank" class="chatgpt-button">Consulta con IA</a>
  </div>
  <script src="../public/js/noti.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>>