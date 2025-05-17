<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Calendario de Proyectos - WORKSYNC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- FullCalendar CSS -->
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="../styles/calendario.css">
</head>
<body>

<nav class="navbar">
  <div class="navbar-brand">
    <img src="../images/logo2.png" alt="WORKSYNC" width="30">
    <span><strong>WORKSYNC</strong></span>
  </div>
</nav>

<div class="calendar-container">
  <div id="calendar"></div>
</div>

<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<!-- Simulación de datos (esto luego se puede cargar desde la BD con PHP/JSON) -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listWeek'
      },
      events: [
        {
          title: 'Inicio Proyecto Alpha',
          start: '2025-05-20',
          color: '#00acc1'
        },
        {
          title: 'Reunión de avance',
          start: '2025-05-25',
          color: '#26c6da'
        },
        {
          title: 'Entrega tarea diseño UI',
          start: '2025-05-28',
          color: '#4dd0e1'
        },
        {
          title: 'Deploy final Proyecto Alpha',
          start: '2025-06-01',
          color: '#00838f'
        }
      ]
    });

    calendar.render();
  });
</script>

</body>
</html>
<?php
} else {
  header("Location: " . Conectar::ruta() . "views/404.php");
  exit();
}
?>
