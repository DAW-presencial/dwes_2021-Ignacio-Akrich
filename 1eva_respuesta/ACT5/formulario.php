<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <!-- formulario -->
    <form action="formulario.php" method="post" enctype="multipart/form-data">
        <!-- input del nombre -->
        <input type="text" name="nombre" placeholder="Nombre"><br>
        <!-- input del apellido -->
        <input type="text" name="apellidos" placeholder="Apellidos"><br>
        <!-- input tipo fecha de la fecha de naciminto -->
        <input type="date" name="fechaNacimiento"><br>
        <!-- dos imputs de subida de ficheros -->
        <input type="file" name="archivo"><br>
        <input type="file" name="archivo2"><br>
        <!-- boton de envio -->
        <input type="submit" value="Enviar">
    </form>
    <?php
   
        if(isset($_POST['nombre'])){
            echo '<br>';
            echo "Nombre: ".$_POST['nombre'];
            echo "<br>";
            echo "Apellidos: ".$_POST['apellidos'];
            echo "<br>";
            echo "Fecha de nacimiento: ".$_POST['fechaNacimiento'];
            echo "<br>";
            echo "El nombre del archivo1 es: ".$_FILES['archivo']['name'];
            //muestra el tamano del archivo
            echo " y su tamaño es de ".$_FILES['archivo']['size']. ' bytes';;
            echo "<br>";
            echo "El nombre del archivo2 es: ".$_FILES['archivo2']['name'];
            echo " y su tamaño es de ".$_FILES['archivo2']['size']. ' bytes';

            if(isset($_FILES['archivo'])){
                move_uploaded_file($_FILES['archivo']['tmp_name'], 'uploads/'.$_FILES['archivo']['name']);
                echo '<br>';
                echo "Se ha subido el archivo1 a la carpeta img";
            }
            else{
                echo '<br>';
                echo "No se ha subido el archivo1";
            }
            if(isset($_FILES['archivo2'])){
                move_uploaded_file($_FILES['archivo2']['tmp_name'], 'uploads/'.$_FILES['archivo2']['name']);
                echo '<br>';
                echo "Se ha subido el archivo2 a la carpeta img";
            }
            else{
                echo '<br>';
                echo "No se ha subido el archivo2";
            }
        }
        
       

    ?>
    
</body>
</html>