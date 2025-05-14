<?php
session_start();
include('../config/conexion_worksync.php');

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['error' => 'No autenticado']);
    exit;
}

$creador_id = $_SESSION['usuario_id'];
$sql = "SELECT id, nombre, descripcion, fecha_creacion FROM proyectos WHERE creador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $creador_id);
$stmt->execute();
$result = $stmt->get_result();

$proyectos = [];
while ($row = $result->fetch_assoc()) {
    $proyectos[] = $row;
}

echo json_encode($proyectos);

$stmt->close();
$conn->close();
?>
