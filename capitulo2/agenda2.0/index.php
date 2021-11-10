<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    
    if (isset($_GET['submit'])) {
        $new_name = $_GET['name'];
        $new_phone = $_GET['phone'];
        $_SESSION[$new_name] = $new_phone;
        
    }
    ?>
    <form method="get">
        <input type="text" name="name"/>
        <input type="number" name="phone"/>
        <input type="submit" name="submit" value="Agregar"/>
    </form>

    <h2>Agenda</h2>

    <?php
        print_r($_SESSION);
    ?>
    
</body>
</html>