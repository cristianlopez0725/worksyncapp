<?php
class Experiencia extends Conectar {
    // Obtener todas las experiencias
    public function get_experiencia() {
        $sql = "SELECT * FROM experiencia ORDER BY fecha_inicio DESC";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener experiencia por ID
    public function get_experiencia_by_id($exp_id) {
        $sql = "SELECT * FROM experiencia WHERE exp_id = ?";  // Se cambia 'id' por 'exp_id'
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $exp_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insertar nueva experiencia
    public function insert_experiencia($usu_id, $empresa, $puesto, $fecha_inicio, $fecha_fin) {
        $sql = "INSERT INTO experiencia (usu_id, empresa, puesto, fecha_inicio, fecha_fin) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $usu_id, PDO::PARAM_INT);  // Bind usuario ID
        $stmt->bindValue(2, $empresa);
        $stmt->bindValue(3, $puesto);
        $stmt->bindValue(4, $fecha_inicio);
        $stmt->bindValue(5, $fecha_fin);
        return $stmt->execute();
    }

    // Actualizar experiencia
    public function update_experiencia($exp_id, $usu_id, $empresa, $puesto, $fecha_inicio, $fecha_fin) {
        $sql = "UPDATE experiencia SET usu_id = ?, empresa = ?, puesto = ?, fecha_inicio = ?, fecha_fin = ? 
                WHERE exp_id = ?";  // Se cambia 'id' por 'exp_id'
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $usu_id, PDO::PARAM_INT);  // Bind usuario ID
        $stmt->bindValue(2, $empresa);
        $stmt->bindValue(3, $puesto);
        $stmt->bindValue(4, $fecha_inicio);
        $stmt->bindValue(5, $fecha_fin);
        $stmt->bindValue(7, $exp_id, PDO::PARAM_INT);  // Bind exp_id
        return $stmt->execute();
    }

    // Eliminar experiencia
    public function delete_experiencia($exp_id) {
        $sql = "DELETE FROM experiencia WHERE exp_id = ?";  // Se cambia 'id' por 'exp_id'
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $exp_id, PDO::PARAM_INT);  // Bind exp_id
        return $stmt->execute();
    }
}
?>
