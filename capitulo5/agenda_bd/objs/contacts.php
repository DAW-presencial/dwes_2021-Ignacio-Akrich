<?php
class Contactos {
    // conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "contactos";
    // Propiedades del objeto
    public $id;
    public $name;
    public $telephoe;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
        $query = "INSERT INTO {$this->table_name} (name, telephone) VALUES (:name, :telephone)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":telephone", $this->telephone);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
      
    }

    public function DropRow(){

        $query = "DELETE FROM {$this->table_name} WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
        
    } 

    public function UpdateRow() {
            
        $query = "UPDATE {$this->table_name} SET telephone = :telephone WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":telephone", $this->telephone);
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
        }

       public function ContarRows() {
      
        $query = "SELECT COUNT(*) FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $this->name = htmlspecialchars($this->name);
        $stmt->execute();
        $num = $stmt->fetch(PDO::FETCH_ASSOC);
        if(intval($num) > 0){
            return true;
        }else{
            return false;
        }

    }
    
    public function ContarAllRows() {

        $query = "SELECT COUNT(*) FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $num = $stmt->fetch(PDO::FETCH_ASSOC);
        if(intval($num) > 0){
            return true;
        }else{
            return false;
        }

      
    }

    function readUserContactos(){
       
        $query = "SELECT * FROM {$this->table_name} WHERE name = :name";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();
        return $stmt;
    }
    
    public function showError($declaracion){
       
        if ($declaracion->errorInfo()[0] == 00000) {
            return false;
        } else {
            return true;
        }
    }

    function readAllContactos(){
        
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
      
    }


}

?>