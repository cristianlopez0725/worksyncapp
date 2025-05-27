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
  <link rel="stylesheet" href="../public/css/menu.css">

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
   <!-- Pantalla de selección de proyecto -->
  <div id="pantallaInicio" class="container py-5">
    <div class="card p-4 shadow">
      <h1 class="mb-4 text-center">📁 Mis proyectos</h1>
      <ul id="listaProyectos" class="list-group mb-3"></ul>
      <div class="input-group">
        <input id="nuevoProyecto" type="text" class="form-control" placeholder="Nombre del nuevo proyecto" />
        <button id="crearProyecto" class="btn btn-primary">Crear proyecto</button>
      </div>
    </div>
  </div>
  
  <!-- Vista del tablero -->
  <div id="tablero" class="container-fluid d-none py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 id="nombreProyecto"></h2>
      <button class="btn btn-outline-secondary" onclick="volverInicio()">← Volver</button>
    </div>
    <div id="listasContainer" class="d-flex flex-row flex-nowrap overflow-auto gap-3"></div>
    <button class="btn btn-success mt-3" onclick="agregarLista()">+ Añadir otra lista</button>
    
  </div>

  <!-- Panel lateral de tarea -->
  <div id="panelTarea" class="d-none">
    <button id="cerrarPanel" onclick="cerrarPanelTarea()">&times;</button>
    <h4>📝 Detalles de la tarea</h4>
    
    <label for="tituloTarea" class="form-label">Título</label>
    <input id="tituloTarea" class="form-control" type="text" />

    <label for="descripcionTarea" class="form-label">Descripción</label>
    <textarea id="descripcionTarea" class="form-control" rows="5" placeholder="Agrega una descripción..."></textarea>

    <div id="nombreLista" class="text-muted mb-3"></div>
    <!-- Botón Exportar Archivos -->
    <button id="btnExportarArchivos" class="btn btn-outline-secondary mb-2">📄 Exportar Archivos</button>

    <!-- Etiquetas -->
    <label class="form-label">Etiquetas</label>
    <div id="etiquetasContainer"></div>
    <button id="btnAgregarEtiqueta" class="btn btn-sm btn-outline-primary mb-3">+ Añadir etiqueta</button>

    <!-- Selector de colores para etiquetas -->
    <div id="selectorColores" class="selector-colores d-none">
      <div class="color-option color-rojo" data-color="color-rojo" title="Rojo"></div>
      <div class="color-option color-verde" data-color="color-verde" title="Verde"></div>
      <div class="color-option color-azul" data-color="color-azul" title="Azul"></div>
      <div class="color-option color-naranja" data-color="color-naranja" title="Naranja"></div>
      <div class="color-option color-morado" data-color="color-morado" title="Morado"></div>
      <div class="color-option color-celeste" data-color="color-celeste" title="Celeste"></div>
      <div class="color-option color-gris" data-color="color-gris" title="Gris"></div>
      <button id="btnCerrarSelector" class="btn btn-sm btn-outline-danger ms-2">✕</button>
    </div>

    <!-- Barra lateral botones funcionales -->
    <hr />
    <div class="d-flex flex-column gap-2">

      <button id="btnCambiarMiembros" class="btn btn-outline-secondary">Cambiar miembros</button>
      <button id="btnCambiarPortada" class="btn btn-outline-secondary">Cambiar portada</button>
      <button id="btnEditarFechas" class="btn btn-outline-secondary">Editar las fechas</button>
      <button id="btnMoverTarjeta" class="btn btn-outline-secondary">Mover</button>

    </div>
  </div>


  <script src="../public/js/proyectos.js"></script>
  <script src="../controller/cargar_proyecto.php"></script>
  <script src="../controller/listar_proyecto.php"></script>
  <script src="../controller/guardar_proyecto.php"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>