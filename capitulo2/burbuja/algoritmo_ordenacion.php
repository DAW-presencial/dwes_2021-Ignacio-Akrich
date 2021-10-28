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
    function ordenacion_matriz($matriz){
        $estado_ordenado = false;
        $elem_matriz = count($matriz);
        while(!$estado_ordenado){
            $estado_ordenado = true;
            for ($i=1; $i < $elem_matriz; $i++) { 
                if($matriz[$i]<$matriz[$i-1]){
                    $aux = $matriz[$i];
                    $matriz[$i]=$matriz[$i-1];
                    $matriz[$i-1]=$aux;
                    $estado_ordenado=false;
                }
            }
        }
        return $matriz;
    }

    $numeros = array(3, 2, 5, 4, 1);
    $numeros_ordenados = ordenacion_matriz($numeros);
    var_dump($numeros); ?><?=  ": Matriz desordeada";?><br><?php
    var_dump($numeros_ordenados); ?><?=  ": Matriz ordenada" ;
?>
</body>
</html>