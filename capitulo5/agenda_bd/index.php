<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Agenda de Contactos con Base de Datos</title>
</head>
<body>
     <!--
        @author Juan Ignacio Akrich Vazquez
        Fecha Inicio: 3/12/2021
        Fecha Fin: 10/12/2021
        Curso: 2º DAW
        Modulo: DWES
        -->
        <h1>Añadir contacto</h1>
    <p>Instrucciones</p>
    <ul>
        <li>Para introducir un contacto a la agenda introduzca un nombre y un numero de teléfono.</li>
        <li>Para borrar un contacto introduza solo el nombre de este. </li>
        <li>Para actualizar un contacto escriba el mismo nombre y cambie el numero al que quiere actualizar</li>
    </ul>
        <form name="formulario" method="get" action="">
            <label for="name">Nombre: </label>
            <input type="text" id="username" name="name" required><br>
            <label for="telephone">Teléfono: </label>
            <input type="text" maxlength="9" id="telephone" name="telephone"><br><br>
            <input type="submit" value="Enviar">
        </form>   
        <?php
                include_once 'objs/contacts.php';
                include_once 'conf/database.php';
                
                $database = new Database();
                $db = $database->getConnection();
                $contacto = new Contactos($db);
        
                function mostratTabla($contacto) {
                    $query = "SELECT
                                id, nombre, telefono, create_time
                            FROM
                                " . $contacto->table_name . "
                            ORDER BY
                                id ASC";
                    $stmt = $contacto->conn->prepare($query);
                    $stmt->execute();
                    $num = $stmt->rowCount();
                    if($num>0){
                        echo "<table>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Nombre</th>";
                        echo "<th>Teléfono</th>";
                        echo "<th>Fecha de creación</th>";
                        echo "</tr>";
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                            echo "<tr>";
                            echo "<td>{$id}</td>";
                            echo "<td>{$nombre}</td>";
                            echo "<td>{$telefono}</td>";
                            echo "<td>{$create_time}</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }

                if(isset($_GET['name']) && isset($_GET['telephone'])){
                    $contacto->nombre = $_GET['name'];
                    $contacto->telefono = $_GET['telephone'];
                    $contacto->create();
                }
                if(isset($_GET['name'])){
                    $contacto->nombre = $_GET['name'];
                    $contacto->delete();
                }
                mostratTabla($contacto);
        ?>
                   
                                
    </body>
</html>