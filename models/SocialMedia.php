<?php 
    class SocialMedia extends Conectar{
        public function get_socialMedia(){
            $social = parent::getConexion();
            parent::set_names();
            $sql = "SELECT * FROM social_media";
            $sql=$social->prepare($sql);
            $sql->execute();
            return $resultado = $sql->fetchALL();


        }

        public function get_socialMediaxid($socmed_id){
            $social = parent::getConexion();
            parent::set_names();
            $sql = "SELECT * FROM social_media WHERE socmed_id=?";
            $sql=$social->prepare($sql);
            $sql->execute();
            $sql->bindValue(1, $socmed_id);
            return $resultado = $sql->fetchALL();
        }

        public function insert_socialMedia($socmed_icono, $socmed_url){
            $social = parent::getConexion();
            parent::set_names();
            $sql = "INSERT INTO  social_media (socmed_id, socmed_icono, socmed_url, est)
                VALUES (NULL, ?, ?, 1)";
            $sql=$social->prepare($sql);
            $sql->execute();
            $sql->bindValue(1, $socmed_icono);
            $sql->bindValue(1, $socmed_url);
            return $resultado = $sql->fetchALL();
        }
        public function update_socialMedia($socmed_icono, $socmed_url,$socmed_id ){
            $social = parent::getConexion();
            parent::set_names();
            $sql = "UPDATE social_media 
                SET socmed_icono=?, socmed_url=?
                WHERE socmed_id=?";
            $sql=$social->prepare($sql);
            $sql->execute();
            $sql->bindValue(1, $socmed_icono);
            $sql->bindValue(2, $socmed_url);
            $sql->bindValue(3, $socmed_id);
            return $resultado = $sql->fetchALL();
        }
        public function delete_socialMedia($socmed_id){
            $social = parent::getConexion();
            parent::set_names();
            $sql = "UPDATE social_media 
                SET est=0
                WHERE socmed_id=?";
            $sql=$social->prepare($sql);
            $sql->execute();
            $sql->bindValue(1, $socmed_id);
            return $resultado = $sql->fetchALL();
        }
    }
?>
