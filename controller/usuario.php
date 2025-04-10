<?php
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
$usuario = new Usuario();

switch ($_GET["op"]) {
    // Guardar o editar
    case "guardaryeditar":
        if (empty($_POST["usu_id"])) {
            $usuario->insert_usuario(
                $_POST["usu_nom"],
                $_POST["usu_apep"],
                $_POST["usu_apem"],
                $_POST["usu_correo"],
                $_POST["usu_telf"]
            );
        } else {
            $usuario->update_usuario(
                $_POST["usu_nom"],
                $_POST["usu_apep"],
                $_POST["usu_apem"],
                $_POST["usu_correo"],
                $_POST["usu_telf"],
                $_POST["usu_id"]
            );
        }
        break;

    // Mostrar usuario por ID
    case "mostrar":
        $datos = $usuario->get_usuarioxid($_POST["usu_id"]);
        if (is_array($datos) && !empty($datos)) {
            echo json_encode($datos); // Responde con los datos en JSON
        } else {
            echo json_encode(["error" => "No se encontró el usuario"]);
        }
        break;

    // Listar todos los usuarios
    case "listar":
        $datos = $usuario->get_usuario();
        $data = [];
        foreach ($datos as $row) {
            $subarray = [];
            $subarray[] = $row["usu_nom"];
            $subarray[] = $row["usu_apep"];
            $subarray[] = $row["usu_apem"];
            $subarray[] = $row["usu_correo"];
            $subarray[] = $row["usu_telf"];
            $subarray[] = '<button type="button" onClick="editar(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-app"><i class="fas fa-edit"></i>Editar</button>';
            $subarray[] = '<button type="button" onClick="eliminar(' . $row["usu_id"] . ');" id="' . $row["usu_id"] . '" class="btn btn-danger"><i class="bx bxs-trash"></i>Eliminar</button>';
            $data[] = $subarray;
        }
        echo json_encode(["data" => $data]); // Responde con el arreglo para DataTables
        break;

    // Eliminar usuario
    case "eliminar":
        $usuario->delete_usuario($_POST["usu_id"]);
        echo json_encode(["success" => "Usuario eliminado correctamente"]);
        break;
}
?>
