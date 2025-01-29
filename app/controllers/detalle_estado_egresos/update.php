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
$orden_compra = $_POST['orden_compra'];
$orden_servicio = $_POST['orden_servicio'];
$detalle = mb_strtoupper($_POST['detalle']);
$especialidad = mb_strtoupper($_POST['especialidad']);
$periodo_meses = mb_strtoupper($_POST['periodo_meses']);
$siaf = $_POST['siaf'];
$monto = $_POST['monto'];
$saldo_inicial = $_POST['saldo_inicial'];
$comprobante = $_POST['comprobante'];
$fecha_pago = $_POST['fecha_pago'];
$fecha_giro = $_POST['fecha_giro'];
$estado_giro = $_POST['estado_giro'];
$asunto = mb_strtoupper($_POST['asunto']);

//REEMPLAZAR EL GUION LARGO DEL ASUNTO
$asunto = str_replace('−', '-', $asunto);

$descripcion = $_POST['descripcion'];
$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$resolucion = $_POST['resolucion'];
$fecha_resolucion = $_POST['fecha_resolucion'];
$numero_estado_cuenta = $_POST['numero_estado_cuenta'];
$fecha_estado_cuenta = $_POST['fecha_estado_cuenta'];
$informe_ingreso = $_POST['informe_ingreso'];
$fecha_informe_ingreso = $_POST['fecha_informe_ingreso'];
$descripcion_ec = $_POST['descripcion_ec'];
$facultad = $_POST['facultad'];
$actividad = $_POST['actividad'];
$periodo = $_POST['periodo'];
$egresos = $_POST['egreso'];
$ingresos = $saldo_inicial-$egresos;
$saldo = $saldo_inicial-$egresos;
$total_egresos = $_POST['total_egresos'];



function conexion()
{

    try {
        $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', '');
    } catch (PDOException $e) {
        echo "Error " . $e;
    }

    return $conn;
}
//-------------------------------------------------------------------------------------------------------


$con = conexion();
$total_egresos_acumulado = current($con->query("SELECT MAX(egresos) as maximo_egresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND estado_giro='APROBADO' AND visible!=1")->fetch());

if ($total_egresos_acumulado == null) {
    $total_egresos_acumulado = 0;
}

/*
$con = conexion();
$total_ingresos_acumulado = current($con->query("SELECT MIN(ingresos) as minimo_ingresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND estado_giro='APROBADO' AND visible!=1 AND ingresos!=0.00")->fetch());


if ($total_ingresos_acumulado == null) {
    $total_ingresos_acumulado = $_POST['saldo_inicial'];
}
*/



//-------------------------------------------------------------------------------------------------------

if ($estado_giro == "APROBADO" && $egresos == 0.00) {
    $egresos = $total_egresos_acumulado + $monto; //aumenta egresos
    $ingresos = $saldo_inicial - $egresos; //disminuye ingresos
    $saldo = $saldo_inicial - $egresos;

    $total_egresos = $egresos;
}

if ($estado_giro == "PENDIENTE") {
    $egresos = 0;
    $ingresos = 0;
    $saldo = 0;

} else if ($estado_giro == "ANULADO") {
    $egresos = 0;
    $ingresos = 0;
    $saldo = 0;

    $total_egresos = 0;
}
/*
if ($saldo < 0) {
    $saldo = 0;
}*/



$sentencia = $pdo->prepare("UPDATE tb_detalle_egresos 
    SET nt=:nt,
    anio_nt=:anio_nt,
    proveido_contabilidad=:proveido_contabilidad,
    fecha_proveido_contabilidad=:fecha_proveido_contabilidad,
    proveido_diga=:proveido_diga,
    fecha_diga=:fecha_diga,
    oficio=:oficio,
    fecha_oficio=:fecha_oficio,
    total_egresos=:total_egresos,
    nro_orden_compra=:nro_orden_compra,
    nro_orden_servicio=:nro_orden_servicio,
    siaf=:siaf,
    monto=:monto,
    comprobante_pago=:comprobante_pago,
    fecha_pago=:fecha_pago,
    fecha_giro=:fecha_giro,
    estado_giro=:estado_giro,
    asunto=:asunto,
    descripcion=:descripcion,
    informe=:informe,
    fecha_informe=:fecha_informe,
    informe_ingresos=:informe_ingresos,
    fecha_informe_ingresos=:fecha_informe_ingresos,
    numero_ec=:numero_ec,
    fecha_ec=:fecha_ec,
    descripcion_ec=:descripcion_ec,
    detalle=:detalle,
    especialidad=:especialidad,
    periodo_meses=:periodo_meses,
    resolucion=:resolucion,
    fecha_resolucion=:fecha_resolucion,
    egresos=:egresos,
    ingresos=:ingresos,
    saldo=:saldo,
    facultad=:facultad,
    actividad_principal=:actividad_principal,
    saldo_inicial=:saldo_inicial,
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
$sentencia->bindParam('total_egresos', $total_egresos);
$sentencia->bindParam('nro_orden_compra', $orden_compra);
$sentencia->bindParam('nro_orden_servicio', $orden_servicio);
$sentencia->bindParam('siaf', $siaf);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('comprobante_pago', $comprobante);
$sentencia->bindParam('fecha_pago', $fecha_pago);
$sentencia->bindParam('fecha_giro', $fecha_giro);
$sentencia->bindParam('estado_giro', $estado_giro);
$sentencia->bindParam('asunto', $asunto);
$sentencia->bindParam('descripcion', $descripcion);
$sentencia->bindParam('informe', $informe);
$sentencia->bindParam('fecha_informe', $fecha_informe);
$sentencia->bindParam('informe_ingresos', $informe_ingreso);
$sentencia->bindParam('fecha_informe_ingresos', $fecha_informe_ingreso);
$sentencia->bindParam('numero_ec', $numero_estado_cuenta);
$sentencia->bindParam('fecha_ec', $fecha_estado_cuenta);
$sentencia->bindParam('descripcion_ec', $descripcion_ec);
$sentencia->bindParam('detalle', $detalle);
$sentencia->bindParam('especialidad', $especialidad);
$sentencia->bindParam('periodo_meses', $periodo_meses);
$sentencia->bindParam('resolucion', $resolucion);
$sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
$sentencia->bindParam('egresos', $egresos);
$sentencia->bindParam('ingresos', $ingresos);
$sentencia->bindParam('saldo', $saldo);
$sentencia->bindParam('facultad', $facultad);
$sentencia->bindParam('actividad_principal', $actividad);
$sentencia->bindParam('saldo_inicial', $saldo_inicial);
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







