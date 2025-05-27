<?php
session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: index.php");
    exit();
}
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "worksync"); // Ajusta tus datos
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$correo = $_SESSION['correo'];

// Obtener el ID del usuario logueado
$stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

$id_usuario = $usuario['id'];

// Obtener proyectos creados por el usuario
$stmt = $conexion->prepare("SELECT id, nombre, descripcion, fecha_creacion FROM proyectos WHERE creador_id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$proyectos_resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio | WorkSync</title>
    <link rel="stylesheet" href="../public/css/stylehome.css">
    <link rel="stylesheet" href="../public/css/responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar con logo y menú horizontal -->
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
                    <a class="nav-link" href="proyectos.php"><i class="bi bi-folder2-open"></i> Proyectos</a>
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
                    <a class="nav-link" href="estadisticas.php"><i class="bi bi-bar-chart-line"></i> Estadísticas</a>
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

<!-- Contenido principal -->
<div class="main-container text-center">
    <h1 class="mb-4">¡Bienvenido a WorkSync!</h1>
    <p class="lead">Desde aquí podrás gestionar tus proyectos, tareas y rendimiento personal.</p>
    <div class="container mt-5">
    <h3>Mis proyectos</h3>
    <div class="row">
        <?php if ($proyectos_resultado->num_rows > 0): ?>
            <?php while ($proyecto = $proyectos_resultado->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($proyecto['nombre']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($proyecto['descripcion']); ?></p>
                            <small class="text-muted">Creado el <?php echo date('d/m/Y', strtotime($proyecto['fecha_creacion'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No tienes proyectos registrados.</p>
        <?php endif; ?>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
