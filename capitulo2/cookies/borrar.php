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
        //delete cookie;
        function delete_cookies(){
            if(isset($_COOKIE['nombre'])){
                setcookie('nombre', '', time()-1);
                unset($_COOKIE['nombre']);
            }
            session_unset();
            session_destroy();
        }
    ?>
</body>
</html>