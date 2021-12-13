<?php
    class Database{

        // especificar credenciales de base de datos
        private $host = "51.178.152.213";
        private $db_name = "agenda_jakrich_db";
        private $username = "jakrich_usr";
        private $password = "abc123.";
        public $conn;

        // obtener la conexión a la base de datos
        public function getConnection(){

            try{
                $this->conn = new PDO("pgsql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>