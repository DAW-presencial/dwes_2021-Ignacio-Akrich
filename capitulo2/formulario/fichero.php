<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- TODO Optimizar codigo -->
    <?php
   /*  if (isset($_POST['submit'])){
        $nombre = $_FILES['archivo']['name'];
        $nombre2 = $_FILES['archivo1']['name'];
        $ruta = $_FILES['archivo']['tmp_name'];
        $ruta2=$_FILES['archivo1']['tmp_name'];
        $destino = "img/".$nombre;
        $destino2 = "img/".$nombre2;
        move_uploaded_file($ruta, $destino);
        move_uploaded_file($ruta2, $destino2);
        echo "El archivo ".$nombre." y ".$nombre2." ha sido subido";
       
        
    }else{
        echo "Error al subir el archivo";
    } */
    if (isset($_POST['submit'])){
        for($i=0; $i<count($_FILES['archivo']['name']); $i++){
            $nombre = $_FILES['archivo']['name'][$i];
            $ruta = $_FILES['archivo']['tmp_name'][$i];
            $destino = "img/".$nombre;
            move_uploaded_file($ruta, $destino);
        }
            
    }
    ?>
</body>
</html>