<?php
    class Database{

        // especificar credenciales de base de datos
        private $host = "localhost";
        private $db_name = "agenda_ignacio_db";
        private $username = "root";
        private $password = "";
        public $conn;

        // obtener la conexión a la base de datos
        public function getConnection(){

            try{
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>