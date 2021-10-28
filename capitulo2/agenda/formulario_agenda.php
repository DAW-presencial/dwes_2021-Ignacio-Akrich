<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
</head>
<body>
    <h1>Añadir contacto</h1>
    <p>Instrucciones</p>
    <ul>
        <li>Para introducir un contacto a la agenda introduzca un nombre y un numero de teléfono.</li>
        <li>Para borrar un contacto introduza solo el nombre de este. </li>
        <li>Para actualizar un contacto escriba el mismo nombre y cambie el numero al que quiere actualizar</li>
    </ul>
    <?php
    //Si el contacto pasado por URL existe y no es nulo lo añade a la variable $contact, sino crea la variable $contact como matriz vacia
    if (isset($_GET['contact'])){
        $contact = $_GET['contact'];
    }else{
        $contact = [];
    }
    //Se asegura de que los datos enviados sean los visibles en la URL
    if (isset($_GET['submit'])) {
        $new_name = $_GET['name'];
        $new_phone = $_GET['phone'];
        //Si el telefono esta vacio borra el contacto con el nombre indicado
        if(empty($new_phone)){
            unset($contact[$new_name]); 
        //Si el nombre esta vacio aparece un mensaje    
        }elseif(empty($new_name)){
            echo "<p style='color:red'>Introduzca un Nombre</p>";
        //Sino se añade al contacto el nombre con su numero
        }else {
            $contact[$new_name] = $new_phone;
        }
    }
    ?>
    <!--Formulario con metodo GET -->
    <form method="get">
        <?php 
        //Por cada nombre con clave $name y valor $phone añadira el nombre y el telefono que añadamos en los inputs
        foreach($contact as $name => $phone){
            echo '<input type=hidden name="contact[' . $name . ']" value="' . $phone . '"/>';
        }            
        ?>
        <input type="text" name="name"/>
        <input type="number" name="phone"/>
        <input type="submit" name="submit" value="Agregar"/>
    </form>

    <h2>Agenda</h2>

    <?php
    //Si encuentra la matriz vacia imprime una mensaje, sino imprime el nombre y el telefono que se añadio en en los inputs
    if (count($contact)==0){
        echo "<p style='color:blue'>No hay ningun contacto</p>";
    }else{
        foreach($contact as $name => $phone){
            echo "<p>Nombre: $name " . "|" . " Telefono: $phone </p>";
        }
    }

    ?>
</body>
</html>