<?php
require '../config/conexion_worksync.php'; // Asegúrate que este archivo contiene $conn (mysqli)

header('Content-Type: application/json');

$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$creador_id = 1; 

if (empty($nombre)) {
  echo json_encode(['success' => false, 'message' => 'El nombre del proyecto es obligatorio.']);
  exit;
}

try {
  $stmt = $conn->prepare("INSERT INTO proyectos (nombre, descripcion, creador_id) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $nombre, $descripcion, $creador_id);
  $stmt->execute();

  echo json_encode(['success' => true, 'message' => 'Proyecto guardado correctamente']);
} catch (Exception $e) {
  echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>