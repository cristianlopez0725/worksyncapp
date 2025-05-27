<?php
include('../config/conexion_worksync.php');
session_start();

if (!isset($_SESSION['correo'])) {
    echo json_encode([]);
    exit();
}

$correo = $_SESSION['correo'];
$sql_usuario = "SELECT id FROM usuarios WHERE correo = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $correo);
$stmt_usuario->execute();
$res_usuario = $stmt_usuario->get_result();
$usuario = $res_usuario->fetch_assoc();

if (!$usuario) {
    echo json_encode([]);
    exit();
}

$usuario_id = $usuario['id'];

$sql = "SELECT id, titulo, descripcion FROM proyectos WHERE creador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$res = $stmt->get_result();

$proyectos = [];
while ($row = $res->fetch_assoc()) {
    $proyectos[] = $row;
}

echo json_encode($proyectos);
