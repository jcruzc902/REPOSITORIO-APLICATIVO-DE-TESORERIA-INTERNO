<?php

include ('../../config.php');

$codigo_pago= $_POST['codigo_pago'];
$modalidad= $_POST['modalidad'];
$concepto= $_POST['concepto'];
$monto= floatval($_POST["monto"]);
$monto= number_format($monto, 2, '.', '');
$referencia= $_POST['referencia'];
$clasificador= mb_strtoupper($_POST['clasificador']);
$codigo_facultad= mb_strtoupper($_POST['codigo_facultad']);
$dependencia= $_POST['dependencia'];
$codigo_serv_banco= mb_strtoupper($_POST['codigo_serv_banco']);
$cuenta= $_POST['cuenta'];
$resolucion= $_POST['resolucion'];
$archivo_resolucion= $_POST['archivo_resolucion'];
$vigencia= $_POST['vigencia'];
$situacion= $_POST['situacion'];
$tipo= $_POST['tipo'];
$id_tasas_tarifas = $_POST['id_tasas_tarifas'];
$id_usuario = $_POST['id_usuario'];


$sentencia = $pdo->prepare("UPDATE tb_tasas_tarifas
    SET codigo_pago=:codigo_pago,
    modalidad=:modalidad,
    concepto=:concepto,
    monto=:monto,
    referencia=:referencia,
    clasificador=:clasificador,
    codigo_facultad=:codigo_facultad,
    dependencia=:dependencia,
    codigo_ser_banco=:codigo_ser_banco,
    cta=:cta,
    resolucion=:resolucion,
    archivo_resolucion=:archivo_resolucion,
    vigencia=:vigencia,
    situacion=:situacion,
    categoria_transaccion=:categoria_transaccion,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion  
    WHERE id_tasas_tarifas= :id_tasas_tarifas");

$sentencia->bindParam('codigo_pago', $codigo_pago);
$sentencia->bindParam('modalidad', $modalidad);
$sentencia->bindParam('concepto', $concepto);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('referencia', $referencia);
$sentencia->bindParam('clasificador', $clasificador);
$sentencia->bindParam('codigo_facultad', $codigo_facultad);
$sentencia->bindParam('dependencia', $dependencia);
$sentencia->bindParam('codigo_ser_banco', $codigo_serv_banco);
$sentencia->bindParam('cta', $cuenta);
$sentencia->bindParam('resolucion', $resolucion);
$sentencia->bindParam('archivo_resolucion', $archivo_resolucion);
$sentencia->bindParam('vigencia', $vigencia);
$sentencia->bindParam('situacion', $situacion);
$sentencia->bindParam('categoria_transaccion', $tipo);
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







