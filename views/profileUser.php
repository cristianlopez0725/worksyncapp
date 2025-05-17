
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Perfil de Usuario - WORKSYNC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../dashboard/stylesheets/perfilUsuario.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    body {
      background: linear-gradient(to bottom, #4dd0e1, #26c6da);
      font-family: Arial, sans-serif;
    }
    .profile-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 30px;
      max-width: 600px;
      margin: 40px auto;
    }
    .profile-img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #00acc1;
    }
    .profile-header {
      text-align: center;
      margin-bottom: 20px;
    }
    .profile-info label {
      font-weight: bold;
      color: #007c91;
    }
    .profile-info p {
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<!-- Navbar horizontal -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <a href="inicio.php" class="navbar-brand d-flex align-items-center">
    <img src="../images/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="height: 30px; width: 30px;">
    <span class="ml-2 font-weight-light">WORKSYNC</span>
  </a>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item mx-2"><a href="inicio.php" class="nav-link"><i class='bx bx-home'></i> Inicio</a></li>
    <li class="nav-item mx-2"><a href="proyectos.php" class="nav-link"><i class='bx bx-briefcase'></i> Proyectos</a></li>
    <li class="nav-item mx-2"><a href="agenda.php" class="nav-link"><i class='bx bx-calendar'></i> Agenda</a></li>
    <li class="nav-item mx-2"><a href="incidencias.php" class="nav-link"><i class='bx bx-error-circle'></i> Incidencias</a></li>
    <li class="nav-item dropdown mx-2">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
        <img src="../images/Profile-PNG-File.png" class="img-circle" style="height: 25px;">
        <?php echo $_SESSION['usu_nom']; ?>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="perfil.php" class="dropdown-item">Perfil</a>
        <a href="../logout.php" class="dropdown-item">Cerrar sesión</a>
      </div>
    </li>
  </ul>
</nav>

<!-- Perfil del usuario -->
<div class="profile-card">
  <div class="profile-header">
    <img src="../images/Profile-PNG-File.png" alt="Usuario" class="profile-img">
    <h3><?php echo $_SESSION['usu_nom'] . " " . $_SESSION['usu_apep']; ?></h3>
    <p class="text-muted">Usuario activo</p>
  </div>
  <div class="profile-info">
    <label>Correo:</label>
    <p><?php echo $_SESSION['usu_correo']; ?></p>

    <label>Teléfono:</label>
    <p><?php echo $_SESSION['usu_telefono'] ?? 'No especificado'; ?></p>

    <label>Rol:</label>
    <p><?php echo $_SESSION['usu_rol'] ?? 'Usuario'; ?></p>

    <label>Fecha de Registro:</label>
    <p><?php echo $_SESSION['usu_fecha'] ?? 'Desconocida'; ?></p>
  </div>
</div>

</body>
</html>
<?php
} else {
  header("location: " . Conectar::ruta() . "views/404.php");
  exit();
}
?>
