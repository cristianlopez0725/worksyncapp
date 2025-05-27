<?php
require_once '../config/conexion_worksync.php'; // Tu archivo de conexión

session_start();
$usuario_id = $_SESSION['usuario_id']; // Asegúrate de tener esto en la sesión

$sql = "SELECT id, titulo AS title, fecha_evento AS start FROM eventos_calendario WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

$result = $stmt->get_result();
$eventos = [];

while ($row = $result->fetch_assoc()) {
    $eventos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($eventos);
?>
