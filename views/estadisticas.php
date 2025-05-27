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
  <title>Estadísticas de Tareas</title>
  <link rel="stylesheet" href="../public/css/estadisticas.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->
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
                    <a class="nav-link" href="proyectos.php"><i class="bi bi-folder"></i> Proyecto</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="perfilUsuario.php"><i class="bi bi-person-circle"></i> Perfil</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="notificaciones.php"><i class="bi bi-bell"></i> Notificaciones</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="logros.php"><i class="bi bi-trophy"></i> Logros</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="calendario.php"><i class="bi bi-calendar"></i> Calendario</a>
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
    <h1>Estadísticas de Tareas</h1>

    <div class="stats-section">
      <h2>Tareas por Usuario</h2>
      <canvas id="userChart" width="400" height="200"></canvas>
    </div>

    <div class="stats-section">
      <h2>Tareas por Estado</h2>
      <canvas id="statusChart" width="400" height="200"></canvas>
    </div>
  </div>

  <script src="../public/js/estadistica.js"></script>
  <script>
  const usuarioIdActual = <?php echo $_SESSION['id']; ?>;
  </script>

</body>
</html>