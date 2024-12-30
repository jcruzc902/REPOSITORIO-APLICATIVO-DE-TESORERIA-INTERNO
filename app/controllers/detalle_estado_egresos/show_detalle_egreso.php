<?php


$id_detalle_egreso = $_GET['id'];

$sql_detalle_egreso = "SELECT *,
t_detalle.fyh_creacion as fyh_creacion_egreso,
anios.anio_nt as anio_nt,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_egresos as t_detalle 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
LEFT JOIN tb_anio_nt as anios ON  anios.id_anio_nt= t_detalle.anio_nt 
WHERE t_detalle.visible!=1 AND t_detalle.id_detalle_egreso='$id_detalle_egreso'";
$query_detalle_egreso = $pdo->prepare($sql_detalle_egreso);
$query_detalle_egreso->execute();
$detalle_egreso_datos = $query_detalle_egreso->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_egreso_datos as $detalle_egreso_dato) {
    $id_detalle_egreso = $detalle_egreso_dato['id_detalle_egreso'];
    $nt = $detalle_egreso_dato['nt'];
    $anio_nt = $detalle_egreso_dato['anio_nt'];
    $proveido_contabilidad = $detalle_egreso_dato['proveido_contabilidad'];
    $fecha_proveido_contabilidad = $detalle_egreso_dato['fecha_proveido_contabilidad'];
    $proveido_diga = $detalle_egreso_dato['proveido_diga'];
    $fecha_diga = $detalle_egreso_dato['fecha_diga'];
    $oficio = $detalle_egreso_dato['oficio'];
    $fecha_oficio = $detalle_egreso_dato['fecha_oficio'];
    $detalle = $detalle_egreso_dato['detalle'];
    $nro_orden_compra = $detalle_egreso_dato['nro_orden_compra'];
    $nro_orden_servicio = $detalle_egreso_dato['nro_orden_servicio'];
    $siaf = $detalle_egreso_dato['siaf'];
    $monto = $detalle_egreso_dato['monto'];
    $comprobante_pago = $detalle_egreso_dato['comprobante_pago'];
    $fecha_pago = $detalle_egreso_dato['fecha_pago'];
    $fecha_giro = $detalle_egreso_dato['fecha_giro'];
    $asunto = $detalle_egreso_dato['asunto'];
    $informe = $detalle_egreso_dato['informe'];
    $fecha_informe = $detalle_egreso_dato['fecha_informe'];
    $resolucion = $detalle_egreso_dato['resolucion'];
    $fecha_resolucion = $detalle_egreso_dato['fecha_resolucion'];
    $egresos = $detalle_egreso_dato['egresos'];
    $ingresos = $detalle_egreso_dato['ingresos'];
    $saldo = $detalle_egreso_dato['saldo'];
    $facultad = $detalle_egreso_dato['facultad'];
    $actividad_principal = $detalle_egreso_dato['actividad_principal'];
    $subactividad = $detalle_egreso_dato['subactividad'];
    $periodo = $detalle_egreso_dato['periodo'];
    $usuario = $detalle_egreso_dato['nombre_usuario'] . " " . $detalle_egreso_dato['apaterno_usuario'] . " " . $detalle_egreso_dato['amaterno_usuario'];
    $fecha_registro = $detalle_egreso_dato['fyh_creacion_egreso'];

}