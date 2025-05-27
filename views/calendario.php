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
        <title>Calendario | WorkSync</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link rel="stylesheet" href="../public/css/calendario.css">
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css' rel='stylesheet' />
        <header>
            <h1>Calendario de Actividades - WorkSync</h1>
        </header>
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
                    <span class="nav-link text-white"><i class="bi bi-person-check"></i> <?php echo $_SESSION['correo']; ?></span>
                </li>
                <li class="nav-item mx-2">
                    <a class="btn btn-outline-light btn-sm" href="index.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    
        <div class="calendar-container">
            <div class="calendar-header">
                <div>Lunes</div><div>Martes</div><div>Miércoles</div><div>Jueves</div><div>Viernes</div><div>Sábado</div><div>Domingo</div>
            </div>

            <div class="calendar-grid" id="calendar">
                <!-- Días generados por JS -->
            </div>

            <div class="legend">
                <span><div class="legend-box" style="background:#19cc09;"></div> En proceso</span>
                <span><div class="legend-box" style="background:#cb25ad;"></div> Por hacer</span>
                <span><div class="legend-box" style="background:#cba020;"></div> Por entregar</span>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal" id="eventModal">
            <div class="modal-content">
                <h3>Agregar Evento</h3>
                <input type="text" id="eventTitle" placeholder="Título del evento">
                <select id="eventType">
                    <option value="en-proceso">En proceso</option>
                    <option value="por-hacer">Por hacer</option>
                    <option value="por-entregar">Por entregar</option>
                    <option value="modificar">Modificar</option>
                </select>
                <button onclick="saveEvent()">Guardar</button>
            </div>
        </div>
    </body>
    <script src="../public/js/calendario.js"></script>
    <script src="../controller/guardar_eventos.php"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/plugin/multimonth.min.js'></script>
    
</html>