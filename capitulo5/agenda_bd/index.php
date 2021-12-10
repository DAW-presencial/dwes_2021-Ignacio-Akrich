<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <form name="formulario" method="get" action="">
            <label for="name"><h1>Name: </h1></label>
            <input type="text" id="username" name="name" required><br>
            <label for="telephone"><h1>Contact Number: </h1></label>
            <input type="text" maxlength="9" id="telephone" name="telephone"><br><br>
            <input type="submit" value="Submit">
        </form>   
        <?php
                include_once 'objs/contacto.php';
                include_once 'conf/database.php';
                
                $database = new Database();
                $db = $database->getConnection();
                $message = new Messages($db);
        
                function mostratTabla($message) {
                    echo "<table class='table table-hover table-responsive table-bordered'>";
                    echo "<tr>";
                        echo "<th> Name </th>";
                        echo "<th> Telephone </th>";
                    echo "</tr>";
                    $stmt = $message->readAllMessages();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo "<tr>";
                            echo "<td> {$name} </td>";
                            echo "<td> {$telephone} </td>";
                        echo "</tr>";
                    };
                    echo "</table>";
                }
                
                if (!empty($_GET)) {
                    try {
                        $message->name = $_GET['name'];
                        $message->telephone = $_GET['telephone'];
                        
                        if (empty($message->telephone)) {
                            if ($message->CountRows()) {
                                $message->DropRow();
                            }
                        } else {
                            if ($message->CountRows() > 0) {
                                if($message->UpdateRow()){
                                    echo "<div class='alert alert-success'>Se actualizó el contacto.</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>El contacto no se actualizó.</div>";
                                }
                            } else {
                                if($message->create()){
                                    echo "<div class='alert alert-success'>Se creó el contacto.</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>No se creó el contacto.</div>";
                                }
                            }
                        }
                        if ($message->CountAllRows() > 0) {
                            mostratTabla($message);
                        }
                    // show Error
                    } catch (PDOException $exception) {
                        die('ERROR: ' . $exception->getMessage());
                    }
                } else {
                    if ($message->CountAllRows() > 0) {
                        mostratTabla($message);
                    }
                }
        ?>
    </body>
</html>