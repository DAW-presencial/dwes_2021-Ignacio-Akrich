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

        // para obtener la marca de tiempo para el campo 'creado'
        $this->create_time=date('Y-m-d H:i:s');

        // insertar consulta
        $query = "INSERT INTO " . $this->table_name . " SET name = :name, telephone = :telephone, create_time = :create_time, update_time = :create_time";

        // preparar la consulta
        $stmt = $this->conn->prepare($query);

        // limpiar
        $this->name = htmlspecialchars($this->name);
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));

        // enlazar valores
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':create_time', $this->create_time);

        // ejecutar la consulta, también verifique si la consulta fue exitosa 
        if($stmt->execute()){
                return true;
        }else{
                $this->showError($stmt);
                return false;
        }
    }

    public function DropRow(){

         // insertar consulta
         $query = "DELETE FROM " . $this->table_name . " WHERE name = :name";
         // preparar la consulta
         $stmt = $this->conn->prepare($query);
         
         // limpiar
         $this->name = htmlspecialchars($this->name);
         
         // enlazar valores 
         $stmt->bindParam(":name", $this->name);
         
         // ejecutar la solicitud 
         if ($stmt->execute()) {
             echo "<div class='alert alert-success'>El contacto fue eliminado.</div>";
         } else {
             echo "<div class='alert alert-danger'>El contacto no se eliminó.</div>";
         }
    } 

    public function UpdateRow() {
            
        // para obtener la marca de tiempo para el campo 'creado'
        $this->create_time=date('Y-m-d H:i:s');
        
        // insertar consulta
        $query = "UPDATE " . $this->table_name . " SET telephone = :telephone, update_time = :create_time WHERE name = :name";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // limpiar
        $this->name = htmlspecialchars($this->name);
        $this->telephone = htmlspecialchars($this->telephone);
        $this->create_time = htmlspecialchars($this->create_time);
        
        // enlazar valores 
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':create_time', $this->create_time);
        
        // ejecutar la solicitud 
        if($stmt->execute()){
                return true;
        }
                return false;
        }
                
    

       public function ContarRows() {
        // insertar consulta
        $query = "SELECT COUNT(*) FROM  " . $this->table_name . " WHERE name = :name";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // limpiar
        $this->name = htmlspecialchars($this->name);

        // enlazar valores 
        $stmt->bindParam(':name', $this->name);

        // ejecutar la solicitud 
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(intval($row["COUNT(*)"]) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function ContarAllRows() {
        // insertar consulta
        $query = "SELECT COUNT(*) FROM  " . $this->table_name;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // ejecutar la solicitud 
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if(intval($row["COUNT(*)"]) > 0){
            return true;
        }else{
            return false;
        }
    }

    function readUserContactos(){
        //selecionar toda data
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

    function readAllContactos(){
        
        //selecionar toda data
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