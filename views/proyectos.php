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
  <h1>Gestor de Tareas</h1>
  <div id="board">
    <!-- Listas se agregan aquí -->
    <button id="addList">+ Añadir lista</button>
  </div>

  <script src="../public/js/proyectos.js"></script>
</body>
</html>
