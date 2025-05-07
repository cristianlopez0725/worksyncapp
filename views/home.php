<?php
session_start();


if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio | WorkSync</title>
    <link rel="stylesheet" href="../public/css/stylehome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <img src="../images/logo2.png">
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item me-3">
                    <span class="nav-link text-white">Bienvenido, <?php echo $_SESSION['correo']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="index.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenido principal -->
<div class="container mt-5">
    <div class="text-center">
        <h1 class="mb-4">¡Bienvenido a WorkSync!</h1>
        <p class="lead">Este es tu panel principal. Desde aquí podrás gestionar tus proyectos, agenda, incidencias y más.</p>
        <a href="proyectos.php" class="btn btn-primary mt-3">Ir a Proyectos</a>
    </div>
</div>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Logo y nombre -->
    <a href="../index.php" class="navbar-brand d-flex align-items-center">
      <img src="../images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="height: 30px; width: 30px;">
      <span class="ml-2 font-weight-light">Proyecto web</span>
    </a>

    <!-- Menú superior -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item mx-2">
        <a href="inicio.php" class="nav-link">
          <i class='bx bx-home'></i> Inicio
        </a>
      </li>
      <li class="nav-item mx-2">
        <a href="proyectos.php" class="nav-link">
          <i class='bx bx-briefcase'></i> Proyectos
        </a>
      </li>
      <li class="nav-item mx-2">
        <a href="agenda.php" class="nav-link">
          <i class='bx bx-calendar'></i> Agenda
        </a>
      </li>
      <li class="nav-item mx-2">
        <a href="incidencias.php" class="nav-link">
          <i class='bx bx-error-circle'></i> Incidencias
        </a>
      </li>
      <li class="nav-item dropdown mx-2">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
          <img src="../images/Profile-PNG-File.png" class="img-circle" alt="User Image" style="height: 25px;">
          <?php echo $_SESSION['usu_nom']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="perfil.php" class="dropdown-item">Perfil</a>
          <a href="index.php" class="dropdown-item">Cerrar sesión</a>
        </div>
      </li>
    </ul>
  </nav>
</body>
</html>
