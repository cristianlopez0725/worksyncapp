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
  <title>Proyectos</title>
  <link rel="stylesheet" href="../public/css/styleproyetcos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
                    <a class="nav-link" href="perfil.php"><i class="bi bi-person-circle"></i> Perfil</a>
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

  <!-- Formulario único para proyecto -->
  <section id="project-controls">
    <input type="text" id="project-name" placeholder="Nombre del proyecto">
    <textarea id="project-description" placeholder="Descripción del proyecto"></textarea>
    <button class="action-btn primary-btn" id="save-project-btn">
      <i class="fas fa-save"></i> Guardar
    </button>
    <button class="action-btn" id="load-project-btn">
      <i class="fas fa-folder-open"></i> Cargar
    </button>
  </section>

  <main id="board">
    <!-- Listas por estado -->
    <div class="list">
      <div class="list-header">
        <h2>Por hacer</h2>
        <button class="delete-list"><i class="fas fa-trash-alt"></i></button>
      </div>
      <div class="task-container" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <input type="text" placeholder="Nueva tarea..." class="task-input">
      <button class="add-task"><i class="fas fa-plus"></i> Agregar tarea</button>
    </div>

    <!-- Otras listas iguales... -->

    <button id="add-list-btn"><i class="fas fa-plus"></i> Añadir otra lista</button>
  </main>

  <!-- Controles globales -->
  <section class="global-controls">
    <button id="save-all-btn"><i class="fas fa-save"></i> Guardar cambios</button>
    <button id="load-all-btn"><i class="fas fa-sync-alt"></i> Cargar Proyecto</button>
  </section>

  <!-- Panel de detalle de tarea -->
  <div id="task-detail" class="hidden">
    <div class="detail-content">
      <span id="close-detail">&times;</span>

      <input id="task-title-input" placeholder="Título de la tarea" disabled />
      <textarea id="task-description" placeholder="Añadir una descripción más detallada..." disabled></textarea>
      <input type="date" id="task-date" disabled />
      <input type="file" id="task-file" disabled />
      <input type="text" id="task-tags" placeholder="Etiquetas (separadas por coma)" disabled />

      <div class="actions">
        <button id="edit-toggle"><i class="fas fa-pen"></i> Editar</button>
        <button id="edit-task" disabled><i class="fas fa-save"></i> Guardar</button>
        <button id="delete-task"><i class="fas fa-trash"></i> Eliminar</button>
      </div>
    </div>
  </div>

  <script src="../public/js/proyectos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
