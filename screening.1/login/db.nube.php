<?php
    class db{
        private $host="jelaprendizajecom.netfirmsmysql.com";
        private $dbname="jeldata_24";
        private $user="nacho";
        private $password="nacho2024";
        public function conexion(){
            try {
                $PDO = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,$this->user,$this->password);
                return $PDO;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
    }
?>