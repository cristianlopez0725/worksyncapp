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
  <title>Gestor tipo Trello</title>
  <link rel="stylesheet" href="../public/css/styleproyetcos.css">
</head>
<body>
  <header>
    <h1>WORKSYNC</h1>
  </header>

  <main id="board">
    <div class="list">
      <h2>Por hacer</h2>
      <div class="task-container" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <input type="text" placeholder="Nueva tarea..." class="task-input">
      <button class="add-task">+ Agregar tarea</button>
    </div>

    <div class="list">
      <h2>En proceso</h2>
      <div class="task-container" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <input type="text" placeholder="Nueva tarea..." class="task-input">
      <button class="add-task">+ Agregar tarea</button>
    </div>

    <div class="list">
      <h2>En espera</h2>
      <div class="task-container" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <input type="text" placeholder="Nueva tarea..." class="task-input">
      <button class="add-task">+ Agregar tarea</button>
    </div>

    <div class="list">
      <h2>Finalizado</h2>
      <div class="task-container" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
      <input type="text" placeholder="Nueva tarea..." class="task-input">
      <button class="add-task">+ Agregar tarea</button>
    </div>

    <button id="add-list-btn">+ Añadir otra lista</button>
  </main>
  <div id="task-detail" class="hidden">
    <div class="detail-content">
      <span id="close-detail">&times;</span>
      
      <input id="task-title-input" placeholder="Título de la tarea" disabled />
      <textarea id="task-description" placeholder="Añadir una descripción más detallada..." disabled></textarea>
      
      <input type="date" id="task-date" disabled />
      
      <input type="file" id="task-file" disabled />
      
      <input type="text" id="task-tags" placeholder="Etiquetas (separadas por coma)" disabled />
  
      <div class="actions">
        <button id="edit-toggle">Editar</button>
        <button id="edit-task" disabled>Guardar</button>
        <button id="delete-task">Eliminar</button>
      </div>
    </div>
  </div>
  

  <script src="../public/js/proyectos.js"></script>
</body>
</html>
