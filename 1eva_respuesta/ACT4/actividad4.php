<?php
/* sea una subclase  que no tine definidas las funciones magicas __get() y __set() pero la clase padre si. Sea $obj una instancia de esa subclase*/
class Padre {
    // public $publico = 1;
    protected $protegido = 2;
    // private $privada = 3; 

    function __get($a) {
        echo "Hola soy padre";
        return $this->$a;

        
    }

    function __set($a, $b) {
        echo "Llamada a __set()<br>";
        $this->$a = $b;
    }

}

class Hijo extends Padre {

    function __get($nombre) {
        echo "Hola soy hijo";
    }

}

$obj = new Hijo();
@$prueba = $obj;
// @$obj->noexiste = 7;

//echo "<br/>El valor de noexiste es: " . $obj->privada;
//$obj2 = new NoClase;
echo "<p>Fin</p>"
?>
