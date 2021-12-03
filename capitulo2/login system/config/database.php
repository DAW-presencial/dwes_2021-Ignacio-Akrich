<?php
// utilizado para obtener conexión a la base de datos mysql
class Database{
 
    // especifique sus propias credenciales de base de datos
    private $host = "localhost";
    private $db_name = "php_login_system";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // obtener la conexión a la base de datos
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>