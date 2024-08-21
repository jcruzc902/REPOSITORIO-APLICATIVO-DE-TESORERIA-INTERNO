<?php
/**
 
 * Date: 17/1/2023
 * Time: 13:00
 */
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWORD', '');
define('BD', 'sistemadedevoluciondedinero');

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

$dia_actual = date("d"); //dia
$mes_actual = date("m"); //mes

//se cae la pagina el primer dia del año
if ($dia_actual >= 01 && $mes_actual == 01) {

    
}else{
    try {
        $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        //echo "La conexión a la base de datos fue con exito";
    } catch (PDOException $e) {
        //print_r($e);
        echo "Error al conectar a la base de datos";
    }
    
    $URL = "http://10.200.0.46/aplicativotesoreriainterno";

    //bloquea la pagina web para hacer mantenimiento
    #$URL = "hbg2@16http://10.200.0.21/sistemadedevoluciondedinerounfv";
    
    date_default_timezone_set("America/Lima");
    $fechaHora = date('Y-m-d H:i:s');
}




