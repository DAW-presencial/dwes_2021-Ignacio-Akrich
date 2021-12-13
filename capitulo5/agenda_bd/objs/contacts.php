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
        $query = "INSERT INTO " . $this->table_name . " SET \"name\" = :name, \"telephone\" = :telephone, \"create_time\" = :create_time, \"update_time\" = :create_time";

        // preparar la consulta
        $declaracion = $this->conn->prepare($query);

        // limpiar
        $this->name = htmlspecialchars($this->name);
        $this->telephone=htmlspecialchars(strip_tags($this->telephone));

        // enlazar valores
        $declaracion->bindParam(':name', $this->name);
        $declaracion->bindParam(':telephone', $this->telephone);
        $declaracion->bindParam(':create_time', $this->create_time);

        // ejecutar la consulta, también verifique si la consulta fue exitosa 
        if($declaracion->execute()){
                return true;
        }else{
                $this->showError($declaracion);
                return false;
        }
    }

    public function DropRow(){

         // insertar consulta
         $query = "DELETE FROM " . $this->table_name . " WHERE \"name\" = :name";
         // preparar la consulta
         $declaracion = $this->conn->prepare($query);
         
         // limpiar
         $this->name = htmlspecialchars($this->name);
         
         // enlazar valores 
         $declaracion->bindParam(":name", $this->name);
         
         // ejecutar la solicitud 
         if ($declaracion->execute()) {
             echo "<div class='alert alert-success'>El contacto fue eliminado.</div>";
         } else {
             echo "<div class='alert alert-danger'>El contacto no se eliminó.</div>";
         }
    } 

    public function UpdateRow() {
            
        // para obtener la marca de tiempo para el campo 'creado'
        $this->create_time=date('Y-m-d H:i:s');
        
        // insertar consulta
        $query = "UPDATE " . $this->table_name . " SET \"telephone\" = :telephone, \"update_time\" = :create_time WHERE \"name\" = :name";
        
        // prepare query
        $declaracion = $this->conn->prepare($query);
        
        // limpiar
        $this->name = htmlspecialchars($this->name);
        $this->telephone = htmlspecialchars($this->telephone);
        $this->create_time = htmlspecialchars($this->create_time);
        
        // enlazar valores 
        $declaracion->bindParam(':name', $this->name);
        $declaracion->bindParam(':telephone', $this->telephone);
        $declaracion->bindParam(':create_time', $this->create_time);
        
        // ejecutar la solicitud 
        if($declaracion->execute()){
                return true;
        }
                return false;
        }
                
    

       public function ContarRows() {
        // insertar consulta
        $query = "SELECT COUNT(*) FROM  " . $this->table_name . " WHERE \"name\" = :name";

        // prepare query
        $declaracion = $this->conn->prepare($query);

        // limpiar
        $this->name = htmlspecialchars($this->name);

        // enlazar valores 
        $declaracion->bindParam(':name', $this->name);

        // ejecutar la solicitud 
        $declaracion->execute();
        $row = $declaracion->fetch(PDO::FETCH_ASSOC);
        
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
        $declaracion = $this->conn->prepare($query);

        // ejecutar la solicitud 
        $declaracion->execute();
        $row = $declaracion->fetch(PDO::FETCH_ASSOC);
        
        if(intval($row["COUNT(*)"]) > 0){
            return true;
        }else{
            return false;
        }
    }

    function readUserContactos(){
        //selecionar toda data
        $query = "SELECT
                    \"id\", \"name\", \"telephone\", \"create_time\"
                FROM
                    " . $this->table_name . "
                ORDER BY
                \"create_time\" ASC";

        $declaracion = $this->conn->prepare( $query );
        $declaracion->execute();

        return $declaracion;
    }
    
    public function showError($declaracion){
        echo "<pre>";
                print_r($declaracion->errorInfo());
        echo "</pre>";
    }

    function readAllContactos(){
        
        //selecionar toda data
        $query = "SELECT
                    \"id\", \"name\", \"telephone\", \"create_time\", \"update_time\"
                FROM
                    " . $this->table_name . "
                ORDER BY
                \"create_time\" ASC";

        $declaracion = $this->conn->prepare( $query );
        $declaracion->execute();

        return $declaracion;
    }


}

?>