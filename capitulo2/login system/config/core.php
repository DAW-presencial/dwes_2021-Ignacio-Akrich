<?php
// mostrar informe de errores
error_reporting(E_ALL);
 
// iniciar sesión php
session_start();
 
// establece tu zona horaria predeterminada
date_default_timezone_set('Asia/Manila');
 
// URL de la Pagina Principal
$home_url="http://localhost/php-login-script-level-1/";
 
// página dada en el parámetro de URL, la página predeterminada es una
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// establecer el número de registros por página
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>