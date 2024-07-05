<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');


$nt = $_POST['nt'];
$id_anio_nt = $_POST['id_anio_nt'];
$proveido_diga = $_POST['proveido_diga'];
$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$proveido_conta = $_POST['proveido_conta'];
$fecha_proveido_conta = $_POST['fecha_proveido_conta'];
$asunto = mb_strtoupper($_POST['asunto']);
$siaf = $_POST['siaf'];
$id_tipo_gasto = $_POST['id_tipo_gasto'];
$oficio = mb_strtoupper($_POST['oficio']);
$fecha_oficio = $_POST['fecha_oficio'];
$id_cargo = $_POST['id_cargo'];
$id_actividad_principal = $_POST['id_actividad_principal'];
$id_subactividad = $_POST['id_subactividad'];
$anio_periodo = $_POST['anio_periodo'];
$monto = floatval($_POST['monto']);
$monto = number_format($monto,2,'.',''); //convertir int a decimal

$id_concepto_giro = $_POST['id_concepto_giro'];
$id_modalidad_pago = $_POST['id_modalidad_pago'];
$proveedor = mb_strtoupper($_POST['proveedor']);
$ruc = $_POST['ruc'];
$nro_orden_compra = $_POST['nro_orden_compra'];
$nro_orden_servicio = $_POST['nro_orden_servicio'];
$id_tipo_comprobante = $_POST['id_tipo_comprobante'];
$nro_comprobante = $_POST['nro_comprobante'];
$nro_comprobante_interno = $_POST['nro_comprobante_interno'];
$nota_pago = mb_strtoupper($_POST['nota_pago']);
$fecha_giro = $_POST['fecha_giro'];
$fecha_pago = $_POST['fecha_pago'];

$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$resolucion_directoral = $_POST['resolucion_directoral'];
$fecha_resolucion = $_POST['fecha_resolucion'];
$total_egresos = floatval($_POST['total_egresos']);
$total_egresos = number_format($total_egresos,2,'.',''); //convertir int a decimal

$total_acumulado= floatval($total_egresos+$monto);
$total_acumulado = number_format($total_acumulado,2,'.',''); //convertir int a decimal

$estado_egreso= $_POST['id_estado_egreso'];

$id_usuario = $_POST['id_usuario'];
$observacion= "";
$visible= 0;

$sql_egreso = "SELECT * FROM tb_egresos where visible!=1";
$query_egreso = $pdo->prepare($sql_egreso);
$query_egreso->execute();
$egreso_datos = $query_egreso->fetchAll(PDO::FETCH_ASSOC);

foreach ($egreso_datos as $egreso_dato) {
    if (($egreso_dato["nt_diga"] == $_POST['nt']) && ($egreso_dato["id_anio_nt_diga"] == $_POST['id_anio_nt'])) {
        $numero_tramite = $_POST['nt'];
        $anio_nt = $_POST['id_anio_nt'];
        $contador = 1;
    }
}

$sql_anio_nt = "SELECT * FROM tb_anio_nt WHERE id_anio_nt='$anio_nt'";
$query_anio_nt = $pdo->prepare($sql_anio_nt);
$query_anio_nt->execute();
$devolucion_anio_nt = $query_anio_nt->fetchAll(PDO::FETCH_ASSOC);

foreach ($devolucion_anio_nt as $anios_nt) {
    $anio = $anios_nt['anio_nt'];
}




if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El NT " . $numero_tramite . " del año " . $anio . " ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/egresos/create.php";
    </script>
    <?php
} else {
    $sentencia = $pdo->prepare('INSERT INTO tb_egresos(proveido_conta,fecha_conta,asunto_conta,siaf,id_tipo_gasto,nt_diga,id_anio_nt_diga,proveido_diga,
    fecha_diga,oficio_dependencia,fecha_dependencia,id_cargo_dependencia,id_actividad_dependencia,id_subactividad,anio_periodo,monto,id_concepto_giro,id_modalidad_pago,
    proveedor,ruc,nro_orden_compra,nro_orden_servicio,id_comprobantes,numero_comprobante,nro_cp_interno,nota_pago,fecha_giro,fecha_pago,observacion_egreso,
    informe,fecha_informe,resolucion_directoral,fecha_resolucion,total_egresos,total_acumulado,id_estado_egreso,visible,id_usuario,fyh_creacion) 
    VALUES (:proveido_conta,:fecha_conta,:asunto_conta,:siaf,:id_tipo_gasto,:nt_diga,:id_anio_nt_diga,:proveido_diga,:fecha_diga,:oficio_dependencia,
    :fecha_dependencia,:id_cargo_dependencia,:id_actividad_dependencia,:id_subactividad,:anio_periodo,:monto,:id_concepto_giro,:id_modalidad_pago,:proveedor,:ruc,
    :nro_orden_compra,:nro_orden_servicio,:id_comprobantes,:numero_comprobante,:nro_cp_interno,:nota_pago,:fecha_giro,:fecha_pago,:observacion_egreso,
    :informe,:fecha_informe,:resolucion_directoral,:fecha_resolucion,:total_egresos,:total_acumulado,:id_estado_egreso,:visible,:id_usuario,:fyh_creacion)');

    $sentencia->bindParam('proveido_conta', $proveido_conta);
    $sentencia->bindParam('fecha_conta', $fecha_proveido_conta);
    $sentencia->bindParam('asunto_conta', $asunto);
    $sentencia->bindParam('siaf', $siaf);
    $sentencia->bindParam('id_tipo_gasto', $id_tipo_gasto);
    $sentencia->bindParam('nt_diga', $nt);
    $sentencia->bindParam('id_anio_nt_diga', $id_anio_nt);
    $sentencia->bindParam('proveido_diga', $proveido_diga);
    $sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
    $sentencia->bindParam('oficio_dependencia', $oficio);
    $sentencia->bindParam('fecha_dependencia', $fecha_oficio);
    $sentencia->bindParam('id_cargo_dependencia', $id_cargo);
    $sentencia->bindParam('id_actividad_dependencia', $id_actividad_principal);
    $sentencia->bindParam('id_subactividad', $id_subactividad);
    $sentencia->bindParam('anio_periodo', $anio_periodo);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('id_concepto_giro', $id_concepto_giro);
    $sentencia->bindParam('id_modalidad_pago', $id_modalidad_pago);
    $sentencia->bindParam('proveedor', $proveedor);
    $sentencia->bindParam('ruc', $ruc);
    $sentencia->bindParam('nro_orden_compra', $nro_orden_compra);
    $sentencia->bindParam('nro_orden_servicio', $nro_orden_servicio);
    $sentencia->bindParam('id_comprobantes', $id_tipo_comprobante);
    $sentencia->bindParam('numero_comprobante', $nro_comprobante);
    $sentencia->bindParam('nro_cp_interno', $nro_comprobante_interno);
    $sentencia->bindParam('nota_pago', $nota_pago);
    $sentencia->bindParam('fecha_giro', $fecha_giro);
    $sentencia->bindParam('fecha_pago', $fecha_pago);
    $sentencia->bindParam('observacion_egreso', $observacion);
    $sentencia->bindParam('informe', $informe);
    $sentencia->bindParam('fecha_informe', $fecha_informe);
    $sentencia->bindParam('resolucion_directoral', $resolucion_directoral);
    $sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
    $sentencia->bindParam('total_egresos', $total_egresos);
    $sentencia->bindParam('total_acumulado', $total_acumulado);
    $sentencia->bindParam('id_estado_egreso', $estado_egreso);
    $sentencia->bindParam('visible', $visible);
    $sentencia->bindParam('id_usuario', $id_usuario);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->execute();

    
 
    session_start();
    $_SESSION['mensaje'] = "Se registro el egreso de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/egresos/');

}