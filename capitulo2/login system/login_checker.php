<?php
// Comprobador de inicio de sesión para el nivel de acceso de 'customer'
 
// si el nivel de acceso no era 'Admin', redirigirlo a la página de inicio de sesión
if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Admin"){
    header("Location: {$home_url}admin/index.php?action=logged_in_as_admin");
}
 
// si se estableció $require_login y el valor es 'true'
else if(isset($require_login) && $require_login==true){
    // si el usuario aún no ha iniciado sesión, redirigir a la página de inicio de sesión
    if(!isset($_SESSION['access_level'])){
        header("Location: {$home_url}login.php?action=please_login");
    }
}
 
// si era la página de 'login' o 'register' o 'sign up' pero el cliente ya había iniciado sesión
else if(isset($page_title) && ($page_title=="Login" || $page_title=="Sign Up")){
    // si el usuario aún no ha iniciado sesión, redirigir a la página de inicio de sesión
    if(isset($_SESSION['access_level']) && $_SESSION['access_level']=="Customer"){
        header("Location: {$home_url}index.php?action=already_logged_in");
    }
}
 
else{
    // no hay problema, permanezca en la página actual
}
?>