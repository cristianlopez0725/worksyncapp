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
            $database = "db_worksync";
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
        return "http://localhost/worksync/";
    }
}
// Registro
if (isset($_POST['register'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena_hash) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nombre, $correo, $contrasena])) {
        echo "<script>alert('Usuario registrado correctamente');</script>";
    } else {
        echo "<script>alert('Error al registrar');</script>";
    }
}

// Login
if (isset($_POST['login'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contrasena, $usuario['contrasena_hash'])) {
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        header("Location: inicio.php");
    } else {
        $error = "Correo o contraseña incorrectos";
    }
}
?>