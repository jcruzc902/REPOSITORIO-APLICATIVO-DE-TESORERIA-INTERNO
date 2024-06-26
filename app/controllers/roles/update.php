<?php

include('../../config.php');

$nombre_rol = $_GET['nombre_rol'];
$id_rol = $_GET['id_rol'];

$sentencia = $pdo->prepare("UPDATE tb_roles SET 
rol=:rol,
fyh_actualizacion=:fyh_actualizacion
WHERE id_rol=:id_rol");

$sentencia->bindParam('rol', $nombre_rol);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_rol', $id_rol);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el rol de la manera correcta";
    $_SESSION['icono'] = "success";
    #header('Location: ' . $URL . '/roles/');
    ?>
    <script>
        location.href= "<?php echo $URL; ?>/roles";
    </script>
    
    <?php
} else {
    #echo "Error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
  
    <script>
        location.href= "<?php echo $URL; ?>/roles";
    </script>
    <?php
}





