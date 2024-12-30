<?php
/**
 
 * Date: 17/1/2023
 * Time: 16:19
 */

include('../../config.php');

$user= $_POST['user'];
$password_user = $_POST['password_user'];


$contador = 0;
$sql = "SELECT * FROM tb_usuarios WHERE usuario= '$user'";
$query = $pdo->prepare($sql);
$query->execute();
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuario){
    $contador = $contador + 1;
    $email = $usuario['email'];
    $nombres = $usuario['nombres'];
    $apaterno = $usuario['apaterno'];
    $amaterno = $usuario['amaterno'];
    $password_user_tabla = $usuario['password_user'];
}


if(($contador > 0) && password_verify($password_user, $password_user_tabla)){
    #echo "Datos correctos";
    session_start();
    $_SESSION['sesion_user_sistemadedevoluciondedinero'] = $user;
    $nombres= explode(" ", $nombres);//separa la cadena en palabras
    $primer_nombre= $nombres[0]; //obtiene la primera palabra empezando con indice 0

    if($primer_nombre=="PATHERSON"){
        $primer_nombre="PATERSON";
    }else if($primer_nombre=="JOEL"){
        $primer_nombre="YOEL";
    }


    $_SESSION['nombre_usuario']= "Bienvenido al sistema, $primer_nombre"." $apaterno"; //audio con API DE MICROSOFT
    $_SESSION['mensaje'] = "Bienvenido al sistema $email";
    $_SESSION["icono"] = "success";
    header('Location: '.$URL);
}else{
    #echo "Datos incorrectos, vuelva a intentarlo";
    session_start();
    $_SESSION['mensaje'] = "Error datos incorrectos";
    $_SESSION["icono"] = "error";
    header('Location: '.$URL.'/login');
}

