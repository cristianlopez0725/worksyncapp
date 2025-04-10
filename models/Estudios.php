<?php
class Estudios extends Conectar {
    public function get_estudios() {
        $sql = "SELECT * FROM estudios ORDER BY fecha_inicio DESC";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_estudio_by_id($est_id) {
        $sql = "SELECT * FROM estudios WHERE est_id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $est_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert_estudio($titulo, $institucion, $fecha_inicio, $fecha_fin ) {
        $sql = "INSERT INTO estudios (titulo, institucion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $titulo);
        $stmt->bindValue(2, $institucion);
        $stmt->bindValue(3, $fecha_inicio);
        $stmt->bindValue(4, $fecha_fin);
        return $stmt->execute();
    }

    public function update_estudio($est_id, $titulo, $institucion, $fecha_inicio, $fecha_fin, ) {
        $sql = "UPDATE estudios SET titulo = ?, institucion = ?, fecha_inicio = ?, fecha_fin = ? WHERE est_id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $titulo);
        $stmt->bindValue(2, $institucion);
        $stmt->bindValue(3, $fecha_inicio);
        $stmt->bindValue(4, $fecha_fin);
        $stmt->bindValue(6, $est_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete_estudio($est_id) {
        $sql = "DELETE FROM estudios WHERE est_id = ?";
        $stmt = parent::getConexion()->prepare($sql);
        $stmt->bindValue(1, $est_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
