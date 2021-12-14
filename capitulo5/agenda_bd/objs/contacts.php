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
   
     // create contacto
     function create(){
   
         //write query
         $query = "INSERT INTO
                     " . $this->table_name . " (id, nombre, telefono, create_time)
                 VALUES
                     (:id, :nombre, :telefono, :create_time)";
   
         $statement = $this->conn->prepare($query);
   
         // posted values
         $this->id=htmlspecialchars(strip_tags($this->id));
         $this->nombre=htmlspecialchars(strip_tags($this->nombre));
         $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->create_time=htmlspecialchars(strip_tags($this->create_time));
         
   
       
   
         // bind values 
         $statement->bindParam(":id", $this->id);
         $statement->bindParam(":nombre", $this->nombre);
         $statement->bindParam(":telefono", $this->telefono);
         $statement->bindParam(":create_time", $this->create_time);
         
   
         if($statement->execute()){
             return true;
         }else{
             return false;
         }
   
     }
     function readAll($from_record_num, $records_per_page){
   
         $query = "SELECT
                     id, nombre, telefono, create_time
                 FROM
                     " . $this->table_name . "
                 ORDER BY
                     id ASC
                 ";
       
         $statement = $this->conn->prepare( $query );
         $statement->execute();
       
         return $statement;
     }
     
 public function countAll(){
   
     $query = "SELECT id FROM " . $this->table_name . "";
   
     $statement = $this->conn->prepare( $query );
     $statement->execute();
   
     $num = $statement->rowCount();
   
     return $num;
 }
 function readOne(){
   
     $query = "SELECT
                 id, nombre, telefono, create_time
             FROM
                 " . $this->table_name . "
             WHERE
                 id = ?
             ";
   
     $statement = $this->conn->prepare( $query );
     $statement->bindParam(1, $this->id);
     $statement->execute();
   
     $row = $statement->fetch(PDO::FETCH_ASSOC);
   
     $this->id = $row['id'];
     $this->nombre = $row['nombre'];
     $this->telefono = $row['telefono'];
        $this->create_time = $row['create_time'];
     
 }
 function update(){
   
     $query = "UPDATE
                 " . $this->table_name . "
             SET
                 id = :id,
                 nombre = :nombre,
                 telefono = :telefono
                 create_time = :create_time
             WHERE
                 id = :id";
   
     $statement = $this->conn->prepare($query);
   
     // posted values
     $this->id=htmlspecialchars(strip_tags($this->id));
     $this->nombre=htmlspecialchars(strip_tags($this->nombre));
     $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        $this->create_time=htmlspecialchars(strip_tags($this->create_time));
     
 
   
     // bind parameters
     $statement->bindParam(':id', $this->id);
     $statement->bindParam(':nombre', $this->nombre);
     $statement->bindParam(':telefono', $this->telefono);
        $statement->bindParam(':create_time', $this->create_time);
 
   
     if($result = $statement->execute()){
         return true;
     }else{
         return false;
     }
 }
 // delete the contact
 function delete(){
   
     $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
       
     $statement = $this->conn->prepare($query);
     $statement->bindParam(1, $this->id);
   
     if($result = $statement->execute()){
         return true;
     }else{
         return false;
     }
 }
 // read contacts by search term
 public function search($search_term, $from_record_num, $records_per_page){
   
     // select query
     $query = "SELECT
                id,nombre,telefono
             FROM
                 " . $this->table_name . " ";
   
     // prepare query statement
     $statement = $this->conn->prepare( $query );
   
     // bind variable values
     $search_term = "%{$search_term}%";
     $statement->bindParam(1, $search_term);
     $statement->bindParam(2, $search_term);
     $statement->bindParam(3, $from_record_num, PDO::PARAM_INT);
     $statement->bindParam(4, $records_per_page, PDO::PARAM_INT);
   
     // execute query
     $statement->execute();
   
     // return values from database
     return $statement;
 }
   
 public function countAll_BySearch($search_term){
   
     // select query
     $query = "SELECT
                 COUNT(*) as total_rows
             FROM
                 " . $this->table_name . " p 
             WHERE
                 p.name LIKE ? OR p.description LIKE ?";
   
     // prepare query statement
     $statement = $this->conn->prepare( $query );
   
     // bind variable values
     $search_term = "%{$search_term}%";
     $statement->bindParam(1, $search_term);
     $statement->bindParam(2, $search_term);
   
     $statement->execute();
     $row = $statement->fetch(PDO::FETCH_ASSOC);
   
     return $row['total_rows'];
 }
 }
?>