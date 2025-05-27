<?php
session_start();
header('Content-Type: application/json');
require_once '../config/conexion_worksync.php'; // Cambia a tu archivo de conexión

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}
file_put_contents('debug.txt', print_r($_POST, true));

$data = json_decode(file_get_contents('php://input'), true);
$titulo = $data['titulo'] ?? '';
$tipo = $data['tipo'] ?? '';
$fecha_evento = $data['fecha_evento'] ?? '';
$usuario_id = $_SESSION['usuario_id'];

if ($titulo && $fecha_evento) {
    $stmt = $conn->prepare("INSERT INTO eventos_calendario (usuario_id, titulo, tipo, fecha_evento) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $usuario_id, $titulo, $tipo, $fecha_evento);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se pudo insertar']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan datos']);
}
?>
