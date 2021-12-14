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
            <input type="submit" value="Crear">
            <input type="submit" value="Borrar">
            <input type="submit" value="Actualizar">
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
                
                // Si se ha pulsado el boton de crear contacto se ejecuta la funcion create()
                if (isset($_GET['name'])) {
                    $contacto->name = $_GET['name'];
                    $contacto->telephone = $_GET['telephone'];
                    if ($contacto->create()) {
                        echo "<div class='alert alert-success'>Contacto creado correctamente.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error al crear el contacto.</div>";
                    }
                }
                // Si se ha pulsado el boton de borrar contacto se ejecuta la funcion DropRow()
                if (isset($_GET['name'])) {
                    $contacto->name = $_GET['name'];
                    if ($contacto->DropRow()) {
                        echo "<div class='alert alert-success'>Contacto borrado correctamente.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error al borrar el contacto.</div>";
                    }
                }
                // Si se ha pulsado el boton de actualizar contacto se ejecuta la funcion update()
                if (isset($_GET['name'])) {
                    $contacto->name = $_GET['name'];
                    $contacto->telephone = $_GET['telephone'];
                    if ($contacto->UpdateRow()) {
                        echo "<div class='alert alert-success'>Contacto actualizado correctamente.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error al actualizar el contacto.</div>";
                    }
                }
               
        ?>
    </body>
</html>