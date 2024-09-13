<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');



$resolucion = $_POST["resolucion"];
$nuevo_resolucion = mb_strtoupper($_POST["nuevo_resolucion"]);
$archivo_resolucion = $_POST["archivo_resolucion"];
$monto = floatval($_POST["monto"]);
$monto = number_format($monto, 2, '.', '');
$estado = $_POST["id_estado_resolucion"];
$observacion = mb_strtoupper($_POST["observacion"]);
$visible = 0;
$usuario = $_POST["id_usuario"];
$codigo_pago = $_POST["codigo_pago"];
$modalidad = $_POST["modalidad"];
$concepto = $_POST["concepto"];
$referencia = $_POST["referencia"];
$dependencia = $_POST["dependencia"];




if ($resolucion == "OTROS") {
    

    // Definir la carpeta de destino
    $carpeta_destino = "../detalle_tasas/files/";
    $nombre_archivo = basename($_FILES["nuevo_archivo"]["name"]);
    $nombre_archivo = mb_strtoupper($nombre_archivo); //convierte el nombre de archivo en mayusculas
    $nombre_archivo = str_replace('PDF', 'pdf', $nombre_archivo); //reemplaza PDF por pdf

    // Mover el archivo a la carpeta de destino
    if (move_uploaded_file($_FILES["nuevo_archivo"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {
        //registro de datos con nuevo resolucion
        $sentencia3 = $pdo->prepare('INSERT INTO tb_resoluciones_tyt(nombre_resolucion_tyt,archivo,visible) 
        VALUES (:nombre_resolucion_tyt,:archivo,:visible)');

        $sentencia3->bindParam('nombre_resolucion_tyt', $nuevo_resolucion);
        $sentencia3->bindParam('archivo', $nombre_archivo);
        $sentencia3->bindParam('visible', $visible);
        $sentencia3->execute();
    }

    $resolucion = $nuevo_resolucion;
    $archivo_resolucion = $nombre_archivo;

}



//registro de datos con tasas y tarifas
$sentencia = $pdo->prepare('INSERT INTO tb_detalle_tyt(resolucion,archivo,monto,observacion,codigo_pago,modalidad,concepto,referencia,dependencia,id_estado_resolucion,visible,id_usuario,fyh_creacion) 
    VALUES (:resolucion,:archivo,:monto,:observacion,:codigo_pago,:modalidad,:concepto,:referencia,:dependencia,:id_estado_resolucion,:visible,:id_usuario,:fyh_creacion)');

$sentencia->bindParam('resolucion', $resolucion);
$sentencia->bindParam('archivo', $archivo_resolucion);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('codigo_pago', $codigo_pago);
$sentencia->bindParam('modalidad', $modalidad);
$sentencia->bindParam('concepto', $concepto);
$sentencia->bindParam('referencia', $referencia);
$sentencia->bindParam('dependencia', $dependencia);
$sentencia->bindParam('id_estado_resolucion', $estado);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $usuario);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->execute();

session_start();
$_SESSION['mensaje'] = "Se registro la resolucion de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/detalle_tasas/');

