<?php

include ('../../config.php');

$codigo_pago= $_POST['codigo_pago'];
$modalidad= $_POST['modalidad'];
$concepto= $_POST['concepto'];
$nuevo_concepto = mb_strtoupper($_POST["nuevo_concepto"]);
/*$monto= floatval($_POST["monto"]);
$monto= number_format($monto, 2, '.', '');*/
$referencia= $_POST['referencia'];
$clasificador= mb_strtoupper($_POST['clasificador']);
$codigo_facultad= mb_strtoupper($_POST['codigo_facultad']);
$dependencia= $_POST['dependencia'];
$codigo_serv_banco= mb_strtoupper($_POST['codigo_serv_banco']);
$banco = $_POST["banco"];
$cuenta= $_POST['cuenta'];
/*$resolucion= $_POST['resolucion'];
$nuevo_resolucion = mb_strtoupper($_POST["nuevo_resolucion"]);
$archivo_resolucion= $_POST['archivo_resolucion'];*/
$vigencia= $_POST['vigencia'];
$situacion= $_POST['situacion'];
$tipo= $_POST['tipo'];
$estado = $_POST["estado"];
$observacion = mb_strtoupper($_POST["observacion"]);
$id_tasas_tarifas = $_POST['id_tasas_tarifas'];
$id_usuario = $_POST['id_usuario'];
$visible = 0;

if ($concepto == "OTROS") {
    $concepto = $nuevo_concepto;

    //registro de datos con nuevo concepto
    $sentencia2 = $pdo->prepare('INSERT INTO tb_concepto_tyt(nombre_concepto_tyt,visible) 
    VALUES (:nombre_concepto_tyt,:visible)');

    $sentencia2->bindParam('nombre_concepto_tyt', $nuevo_concepto);
    $sentencia2->bindParam('visible', $visible);
    $sentencia2->execute();


}


/*
if ($resolucion == "OTROS") {
    

    // Definir la carpeta de destino
    $carpeta_destino = "../tasas_tarifas/files/";
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
*/

$sentencia = $pdo->prepare("UPDATE tb_tasas_tarifas
    SET codigo_pago=:codigo_pago,
    modalidad=:modalidad,
    concepto=:concepto,
    referencia=:referencia,
    clasificador=:clasificador,
    codigo_facultad=:codigo_facultad,
    dependencia=:dependencia,
    codigo_ser_banco=:codigo_ser_banco,
    banco=:banco,
    cta=:cta,
    vigencia=:vigencia,
    situacion=:situacion,
    categoria_transaccion=:categoria_transaccion,
    observacion=:observacion,
    id_estado=:id_estado,
    visible=:visible,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_tasas_tarifas= :id_tasas_tarifas");

$sentencia->bindParam('codigo_pago', $codigo_pago);
$sentencia->bindParam('modalidad', $modalidad);
$sentencia->bindParam('concepto', $concepto);
//$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('referencia', $referencia);
$sentencia->bindParam('clasificador', $clasificador);
$sentencia->bindParam('codigo_facultad', $codigo_facultad);
$sentencia->bindParam('dependencia', $dependencia);
$sentencia->bindParam('codigo_ser_banco', $codigo_serv_banco);
$sentencia->bindParam('banco', $banco);
$sentencia->bindParam('cta', $cuenta);
//$sentencia->bindParam('resolucion', $resolucion);
//$sentencia->bindParam('archivo_resolucion', $archivo_resolucion);
$sentencia->bindParam('vigencia', $vigencia);
$sentencia->bindParam('situacion', $situacion);
$sentencia->bindParam('categoria_transaccion', $tipo);
$sentencia->bindParam('observacion', $observacion);
$sentencia->bindParam('id_estado', $estado);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_tasas_tarifas', $id_tasas_tarifas);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo los datos de la tasa/tarifa de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/tasas_tarifas/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/tasas_tarifas/update.php?id=' . $id_tasas_tarifas);
}







