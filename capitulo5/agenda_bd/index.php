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
                    echo "<p>Contactos</p>";
                    echo "<table class='table table-hover table-responsive table-bordered'>";
                    echo "<tr>";
                        echo "<th> Nombre </th>";
                        echo "<th> Telefono </th>";
                    echo "</tr>";
                    $declaracion = $contacto->readAllContactos();
                    while ($row = $declaracion->fetch(PDO::FETCH_ASSOC)) {
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
                        $contacto->name = $_GET['name'];
                        $contacto->telephone = $_GET['telephone'];
                        
                        if (empty($contacto->telephone)) {
                            if ($contacto->ContarRows( $contacto->name ) > 0) {
                                if ($contacto->delete( $contacto->name )) {
                                    echo "<div class='alert alert-success'>";
                                    echo "<strong>Contacto borrado correctamente</strong>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>";
                                    echo "<strong>Error al borrar el contacto</strong>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<div class='alert alert-danger'>";
                                echo "<strong>No existe el contacto</strong>";
                                echo "</div>";
                            }
                        } else {
                            if ($contacto->ContarRows( $contacto->name ) > 0) {
                                if ($contacto->update( $contacto->name, $contacto->telephone )) {
                                    echo "<div class='alert alert-success'>";
                                    echo "<strong>Contacto actualizado correctamente</strong>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>";
                                    echo "<strong>Error al actualizar el contacto</strong>";
                                    echo "</div>";
                                }
                            } else {
                                if ($contacto->create()) {
                                    echo "<div class='alert alert-success'>";
                                    echo "<strong>Contacto añadido correctamente</strong>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>";
                                    echo "<strong>Error al añadir el contacto</strong>";
                                    echo "</div>";
                                }
                            }
                        }
                    } catch (Exception $e) {
                        echo "<div class='alert alert-danger'>";
                        echo "<strong>Error al añadir el contacto</strong>";
                        echo "</div>";
                    }
                }
                mostratTabla($contacto);
        ?>

                                
    </body>
</html>