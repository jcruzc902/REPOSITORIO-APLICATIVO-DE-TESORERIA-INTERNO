<?php

include ('../../config.php');

$nombre_rol = $_GET['nombre_rol'];

$contador = 0;
$sql_roles = "SELECT * FROM tb_roles where visible!=1";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($roles_datos as $roles_dato) {
    if ($roles_dato["rol"]== $nombre_rol) {
        $contador = 1;
    }
}

if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El nombre del rol ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/roles";
    </script>
    <?php
} else {

    $sentencia = $pdo->prepare("INSERT INTO tb_roles (rol,fyh_creacion) 
    VALUES (:rol,:fyh_creacion)");

    $sentencia->bindParam('rol', $nombre_rol);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el rol de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/roles";
        </script>
        <?php
    } else {
        #echo "Error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
        $_SESSION['icono'] = "error";
        #header('Location: ' . $URL . '/categorias');

    }

}




