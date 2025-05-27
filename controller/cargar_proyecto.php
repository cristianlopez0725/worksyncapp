<?php
include('../config/conexion_worksync.php');
session_start();

if (!isset($_SESSION['correo']) || !isset($_GET['id'])) {
    echo json_encode(["exito" => false]);
    exit();
}

$correo = $_SESSION['correo'];
$id = intval($_GET['id']);

$sql_usuario = "SELECT id FROM usuarios WHERE correo = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("s", $correo);
$stmt_usuario->execute();
$res_usuario = $stmt_usuario->get_result();
$usuario = $res_usuario->fetch_assoc();

if (!$usuario) {
    echo json_encode(["exito" => false]);
    exit();
}

$usuario_id = $usuario['id'];

$sql = "SELECT titulo, descripcion FROM proyectos WHERE id = ? AND creador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $proyecto = $res->fetch_assoc();
    echo json_encode(["exito" => true, "titulo" => $proyecto['titulo'], "descripcion" => $proyecto['descripcion']]);
} else {
    echo json_encode(["exito" => false]);
}


