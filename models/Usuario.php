<?php
require_once("../config/conexion.php");


class Usuario extends Conectar {
    public function login() {
        $conectar = parent::getConexion();
        parent::set_names();
        session_start();

        if (isset($_POST["enviar"]) && $_POST["enviar"] === "si") {
            $correo = trim($_POST["correo"]);
            $password = trim($_POST["password"]);

            if (empty($correo) || empty($password)) {
                header("location:" . Conectar::ruta() . "views/login.php?m=2");
                exit();
            } else {
                $sql = "SELECT * FROM usuarios WHERE usu_correo = ? AND usu_pass = ? AND est = 1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->bindValue(2, $password);
                $stmt->execute();

                $result = $stmt->fetch();

                if ($result) { 
                    $_SESSION["usu_id"] = $result["usu_id"];
                    $_SESSION["usu_nom"] = $result["usu_nom"];
                    $_SESSION["usu_apep"] = $result["usu_apep"];
                    $_SESSION["usu_correo"] = $result["usu_correo"];
                    header("location:" . Conectar::ruta() . "views/home.php");
                    
                } else {
                    header("location:" . Conectar::ruta() . "views/login.php?m=1");
                    exit();
                }
            }
        }
    }
    
    public function get_usuario(){
        $usuario = parent::getConexion();
        parent::set_names();
        $sql = "SELECT * FROM usuarios";
        $sql=$usuario->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchALL();


    }

    public function get_usuarioxid($usu_id){
        $usuario = parent::getConexion();
        parent::set_names();
        $sql = "SELECT * FROM usuarios WHERE usu_id=?";
        $sql=$usuario->prepare($sql);
        $sql->execute();
        $sql->bindValue(1, $usu_id);
        return $resultado = $sql->fetchALL();
    }

    public function insert_usuario($usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_telf,){
        $usuario = parent::getConexion();
        parent::set_names();
        $sql = "INSERT INTO  usuarios (usu_id, usu_nom, usu_apep, usu_apem, usu_correo, usu_telf, est)
            VALUES (NULL, ?, ?,?,?,? 1)";
        $sql=$usuario->prepare($sql);
        $sql->execute();
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(2, $usu_apem);
        $sql->bindValue(2, $usu_correo);
        $sql->bindValue(2, $usu_telf);
        return $resultado = $sql->fetchALL();
    }
    public function update_usuario($usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_telf,$usu_id ){
        $usuario = parent::getConexion();
        parent::set_names();
        $sql = "UPDATE usuario 
            SET usu_nom=?, $usu_apep=?,usu_apem=?, $usu_correo=?,$usu_telf=?
            WHERE usu_id=?";
        $sql=$usuario->prepare($sql);
        $sql->execute();
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_correo);
        $sql->bindValue(5, $usu_telf);
        $sql->bindValue(6, $usu_id);
        return $resultado = $sql->fetchALL();
    }
    public function delete_usuario($usu_id){
        $usuario = parent::getConexion();
        parent::set_names();
        $sql = "UPDATE usuarios
            SET est=0
            WHERE usu_id=?";
        $sql=$usuario->prepare($sql);
        $sql->execute();
        $sql->bindValue(1, $usu_id);
        return $resultado = $sql->fetchALL();
    }

}

  