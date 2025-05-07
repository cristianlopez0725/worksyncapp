<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>WorkSync - Inicio</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #007bff;
      color: white;
      padding: 1rem;
      text-align: center;
    }
    nav {
      background-color: #333;
      overflow: hidden;
    }
    nav a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
    }
    nav a:hover {
      background-color: #575757;
    }
    .content {
      padding: 2rem;
    }
  </style>
</head>
<body>

<header>
  <h1>Bienvenido, <?php echo $_SESSION['nombre']; ?> a WorkSync</h1>
</header>

<nav>
  <a href="perfil.php">Perfil</a>
  <a href="proyectos.php">Proyectos</a>
  <a href="notificaciones.php">Notificaciones</a>
  <a href="logros.php">Logros</a>
  <a href="estadisticas.php">Estadísticas</a>
  <a href="calendario.php">Calendario</a>
  <a href="logout.php" style="float:right">Cerrar sesión</a>
</nav>

<div class="content">
  <h2>Página de Inicio</h2>
  <p>Selecciona una sección desde el menú para comenzar.</p>
</div>

</body>
</html>
