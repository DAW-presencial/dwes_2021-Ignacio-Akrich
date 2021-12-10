<?php
class Contactos {
    // conexión a la base de datos y nombre de la tabla
    private $conn;
    private $table_name = "contactos";
    // Propiedades del objeto
    public $id;
    public $name;
    public $telephoe;
    private $create_time;

    public function __construct($db){
        $this->conn = $db;
    }

    function create(){

        // to get time stamp for 'created' field
        $this->create_time=date('Y-m-d H:i:s');

        // insert query
        $query = "INSERT INTO " . $this->table_name . " SET name = :name, telephone = :telephone, create_time = :create_time, update_time = :create_time";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars($this->name);
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));

        // bind the values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':create_time', $this->create_time);

        // execute the query, also check if query was successful
        if($stmt->execute()){
                return true;
        }else{
                $this->showError($stmt);
                return false;
        }
    }

    public function DropRow(){

         // insert query
         $query = "DELETE FROM " . $this->table_name . " WHERE name = :name";
         // prepare the query
         $stmt = $this->conn->prepare($query);
         
         // sanitize
         $this->name = htmlspecialchars($this->name);
         
         // bind values
         $stmt->bindParam(":name", $this->name);
         
         // execute query
         if ($stmt->execute()) {
             echo "<div class='alert alert-success'>El contacto fue eliminado.</div>";
         } else {
             echo "<div class='alert alert-danger'>El contacto no se eliminó.</div>";
         }
    } 

    public function UpdateRow() {
            
        // to get time stamp for 'created' field
        $this->create_time=date('Y-m-d H:i:s');
        
        // insert query
        $query = "UPDATE " . $this->table_name . " SET telephone = :telephone, update_time = :create_time WHERE name = :name";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // sanitize
        $this->name = htmlspecialchars($this->name);
        $this->telephone = htmlspecialchars($this->telephone);
        $this->create_time = htmlspecialchars($this->create_time);
        
        // bind values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':create_time', $this->create_time);
        
        // execute query
        if($stmt->execute()){
                return true;
        }
                return false;
        }
                
    

       public function ContarRows() {
        // insert query
        $query = "SELECT COUNT(*) FROM  " . $this->table_name . " WHERE name = :name";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars($this->name);

        // bind values
        $stmt->bindParam(':name', $this->name);

        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(intval($row["COUNT(*)"]) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function ContarAllRows() {
        // insert query
        $query = "SELECT COUNT(*) FROM  " . $this->table_name;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(intval($row["COUNT(*)"]) > 0){
            return true;
        }else{
            return false;
        }
    }

    function readUserContactos(){
        //select all data
        $query = "SELECT
                    id, name, telephone, create_time
                FROM
                    " . $this->table_name . "
                ORDER BY
                    create_time ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }
    
    public function showError($stmt){
        echo "<pre>";
                print_r($stmt->errorInfo());
        echo "</pre>";
    }

    // used to read message name by its ID
    function readAllContactos(){
        
        //select all data
        $query = "SELECT
                    id, name, telephone, create_time, update_time
                FROM
                    " . $this->table_name . "
                ORDER BY
                    create_time ASC";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }


}

?>