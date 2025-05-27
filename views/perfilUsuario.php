<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "worksync"); // Ajusta tu host, usuario y BD
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$correo = $_SESSION['correo'];
$sql = "SELECT nombre, correo, telefono, descripcion, rol FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

$conexion->close();
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
                    <a class="nav-link" href="calendario.php"><i class="bi bi-calendar"></i> Calendario</a>
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
    <h1><span><i class="bx bx-user"></i>Usuario Activo </span> </h1>
  </div>

  <div class="cards-grid">
  <div class="card">
    <div class="card-title"><i class='bx bx-user'></i> Nombre</div>
    <p><?php echo htmlspecialchars($usuario['nombre']); ?></p>
  </div>

  <div class="card">
    <div class="card-title"><i class='bx bx-phone'></i> Teléfono</div>
    <p><?php echo htmlspecialchars($usuario['telefono']); ?></p>
  </div>

  <div class="card">
    <div class="card-title"><i class='bx bx-envelope'></i> Correo</div>
    <p><?php echo htmlspecialchars($usuario['correo']); ?></p>
  </div>

  <div class="card">
    <div class="card-title"><i class='bx bx-info-circle'></i> Descripción</div>
    <p><?php echo htmlspecialchars($usuario['descripcion']); ?></p>
  </div>

  <div class="card">
    <div class="card-title"><i class='bx bx-user-pin'></i> Rol</div>
    <p><?php echo htmlspecialchars($usuario['rol']); ?></p>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>