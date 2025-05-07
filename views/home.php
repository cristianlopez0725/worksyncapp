<?php
define("BASE_URL", "/pagina/"); 
require_once("../config/conexion.php"); 

if (isset($_SESSION["usu_id"])) {
?>
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
          <a href="../logout.php" class="dropdown-item">Cerrar sesión</a>
        </div>
      </li>
    </ul>
  </nav>