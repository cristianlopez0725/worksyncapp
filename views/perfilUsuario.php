
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
  <meta charset="utf-8">
  <title>Perfil de usuario - WORKSYNC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../public/css/perfil.css">
  <link rel="stylesheet" href="../public/css/menu.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<header>
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
                    <a class="nav-link" href="proyectos.php"><i class="bi bi-folder2-open"></i> proyectos</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="notificaciones.php"><i class="bi bi-bell"></i> Notificaciones</a>
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
</header>

<div class="profile-container">
  <div class="profile-header">
     <li class="nav-item mx-2">
        <span class="nav-link text-white"><i class="bi bi-person-check"></i> <?php echo $_SESSION['correo']; ?></span>
                </li>
    <p>Usuario activo en WORKSYNC</p>
  </div>

  <div class="cards-grid">
    <div class="card">
      <div class="card-title"><i class='bx bx-user'></i> Edad</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-book'></i> Nivel educativo</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-briefcase-alt'></i> Industria</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-building'></i> Tamaño de la organización</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-news'></i> Información</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-target-lock'></i> Metas</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-heart'></i> Motivaciones</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-error'></i> Dificultades</div>
      <p>...</p>
    </div>

    <div class="card">
      <div class="card-title"><i class='bx bx-world'></i> Redes sociales</div>
      <div class="social-icons">
        <i class='bx bxl-facebook-circle'></i>
        <i class='bx bxl-instagram'></i>
        <i class='bx bxl-twitter'></i>
        <i class='bx bxl-linkedin-square'></i>
        <i class='bx bxl-pinterest'></i>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>