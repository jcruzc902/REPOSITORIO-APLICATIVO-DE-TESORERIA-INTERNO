<?php

include('../../config.php');

$id_detalle_egreso = $_POST['id_detalle_egreso'];
$id_usuario = $_POST['id_usuario'];
$nt = $_POST['nt'];
$id_anio_nt = $_POST['anio_nt'];
$proveido_contabilidad = $_POST['proveido_contabilidad'];
$fecha_proveido_contabilidad = $_POST['fecha_proveido_contabilidad'];
$proveido_diga = $_POST['proveido_diga'];
$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$oficio_oclsa_orh = mb_strtoupper($_POST['oficio_oclsa_orh']);
$fecha_oclsa_orh = $_POST['fecha_oclsa_orh'];
$detalle = mb_strtoupper($_POST['detalle']);
$orden_compra = $_POST['orden_compra'];
$orden_servicio = $_POST['orden_servicio'];
$siaf = $_POST['siaf'];

$monto = floatval($_POST['monto']);
$monto = number_format($monto, 2, '.', ''); //convertir int a decimal

$comprobante = $_POST['comprobante'];
$fecha_pago = $_POST['fecha_pago'];
$fecha_giro = $_POST['fecha_giro'];
$asunto = mb_strtoupper($_POST['asunto']);

//REEMPLAZAR EL GUION LARGO DEL ASUNTO
$asunto= str_replace('−','-', $asunto);

$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$resolucion = $_POST['resolucion'];
$fecha_resolucion = $_POST['fecha_resolucion'];


$facultad = $_POST['facultad'];
$actividad = $_POST['actividad'];
$subactividad = $_POST['subactividad'];
$periodo = $_POST['periodo'];


$sentencia = $pdo->prepare("UPDATE tb_detalle_egresos 
    SET nt=:nt,
    anio_nt=:anio_nt,
    proveido_contabilidad=:proveido_contabilidad,
    fecha_proveido_contabilidad=:fecha_proveido_contabilidad,
    proveido_diga=:proveido_diga,
    fecha_diga=:fecha_diga,
    oficio=:oficio,
    fecha_oficio=:fecha_oficio,
    detalle=:detalle,
    nro_orden_compra=:nro_orden_compra,
    nro_orden_servicio=:nro_orden_servicio,
    siaf=:siaf,
    monto=:monto,
    comprobante_pago=:comprobante_pago,
    fecha_pago=:fecha_pago,
    fecha_giro=:fecha_giro,
    asunto=:asunto,
    informe=:informe,
    fecha_informe=:fecha_informe,
    resolucion=:resolucion,
    fecha_resolucion=:fecha_resolucion,
    facultad=:facultad,
    actividad_principal=:actividad_principal,
    subactividad=:subactividad,
    periodo=:periodo,
    id_usuario=:id_usuario,
    fyh_actualizacion=:fyh_actualizacion 
    WHERE id_detalle_egreso=:id_detalle_egreso");

$sentencia->bindParam('nt', $nt);
$sentencia->bindParam('anio_nt', $id_anio_nt);
$sentencia->bindParam('proveido_contabilidad', $proveido_contabilidad);
$sentencia->bindParam('fecha_proveido_contabilidad', $fecha_proveido_contabilidad);
$sentencia->bindParam('proveido_diga', $proveido_diga);
$sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
$sentencia->bindParam('oficio', $oficio_oclsa_orh);
$sentencia->bindParam('fecha_oficio', $fecha_oclsa_orh);
$sentencia->bindParam('detalle', $detalle);
$sentencia->bindParam('nro_orden_compra', $orden_compra);
$sentencia->bindParam('nro_orden_servicio', $orden_servicio);
$sentencia->bindParam('siaf', $siaf);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('comprobante_pago', $comprobante);
$sentencia->bindParam('fecha_pago', $fecha_pago);
$sentencia->bindParam('fecha_giro', $fecha_giro);
$sentencia->bindParam('asunto', $asunto);
$sentencia->bindParam('informe', $informe);
$sentencia->bindParam('fecha_informe', $fecha_informe);
$sentencia->bindParam('resolucion', $resolucion);
$sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
$sentencia->bindParam('facultad', $facultad);
$sentencia->bindParam('actividad_principal', $actividad);
$sentencia->bindParam('subactividad', $subactividad);
$sentencia->bindParam('periodo', $periodo);
$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_detalle_egreso', $id_detalle_egreso);
$sentencia->execute();

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el detalle del estado de egreso de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/detalle_estado_egresos/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/detalle_estado_egresos/update.php?id=' . $id_detalle_cheque);
}







