<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda con base de datos</title>
</head>
<body>
    <h1>Agenda con base de datos</h1>

    <form method="get">
        <input type="text" name="name"/>
        <input type="number" name="phone"/>
        <input type="submit" name="submit" value="Agregar"/>
    </form>

    <h2>Agenda</h2>

    <?php

        $db = new mysqli('localhost', 'root', '', 'agenda');
        if ($db->connect_errno) {
            echo '<p>Error al conectar con la base de datos: ' . $db->connect_error . '</p>';
            exit();
        }

        if (isset($_GET['submit'])) {
            $name = $_GET['name'];
            $phone = $_GET['phone'];

            $sql = "INSERT INTO contactos (nombre, telefono) VALUES ('$name', '$phone')";
            $result = $db->query($sql);
        }

        $sql = "SELECT * FROM contactos";
        $result = $db->query($sql);

        if ($result-> num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Nombre</th><th>Teléfono</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['telefono'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No hay contactos</p>';
        }

    ?>
       
</body>
</html>