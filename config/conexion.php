<?php
session_start();

class Conectar {
    protected $dbn;

    protected function Conexion() {
        try {
            $engine = "mysql";
            $server = "localhost";
            $user = "root";
            $password = "";
            $database = "pagina";
            $charset = "utf8";
    
            $dsn = sprintf("%s:host=%s;dbname=%s;charset=%s", $engine, $server, $database, $charset);
    
            $this->dbn = new PDO($dsn, $user, $password);
            $this->dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            echo "La conexión fue exitosa"; 
    
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
    
        
    }
    public function cerrarConexion() {
        $this->dbn = null;
    }
    
    public function getConexion() {
        if (!$this->dbn) {
            $this->Conexion();
        }
        return $this->dbn;
    }

    public function set_names() {
        if (is_object($this->dbn)) {
            return $this->dbn->exec("SET NAMES 'utf8'");
        } else {
            throw new Exception("Error: la conexión no está inicializada correctamente.");
        }
    }

    public static function ruta() {
        return "http://localhost/proyecto_pagina/";
    }
}
