<?php
class Menu extends Conectar {
    public function insert_menu($opcion, $url, $est) {
        $conectar = parent::getConexion();
        parent::set_names();
        $sql = "INSERT INTO menu (opcion, url, est) VALUES (?, ?, ?)";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$opcion, $url, $est]);
    }

    
    public function update_menu($id, $opcion, $url) {
        $conectar = parent::getConexion();
        parent::set_names();
        $sql = "UPDATE menu SET opcion = ?, url = ? WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$opcion, $url,  $id]);
    }

    public function get_menu_by_id($id) {
        $conectar = parent::getConexion();
        parent::set_names();
        $sql = "SELECT * FROM menu WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     
    public function get_menu() {
        $conectar = parent::getConexion();
        parent::set_names();
        $sql = "SELECT * FROM menu";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     
    public function delete_menu($id) {
        $conectar = parent::getConexion();
        parent::set_names();
        $sql = "DELETE FROM menu WHERE id = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
