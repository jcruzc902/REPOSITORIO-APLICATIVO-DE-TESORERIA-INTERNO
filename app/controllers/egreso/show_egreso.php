<?php

#puede ser anio periodo falla
$id_egreso = $_GET['id'];

$sql_egresos = "SELECT egresos.id_egresos as id_egresos,
    egresos.nt_diga as nt_diga,
    anio_nt.anio_nt as nt_anio,
    egresos.proveido_diga as proveido_diga,
    egresos.fecha_diga as fecha_diga,
    egresos.proveido_conta as proveido_conta,
    egresos.fecha_conta as fecha_conta,
    egresos.asunto_conta as asunto_conta,
    egresos.siaf as siaf,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    egresos.oficio_dependencia as oficio_dependencia,
    egresos.fecha_dependencia as fecha_dependencia,
    cargo.nombre_cargo as nombre_cargo,
    actividad_principal.nombre_actividad as nombre_actividad,
    actividad_principal.id_cargo as id_cargo,
    subactividad.nombre_subactividad as nombre_subactividad,
    subactividad.id_actividad_principal as id_actividad_principal,
    egresos.anio_periodo as anio_periodo,
    egresos.monto as monto,
    concepto_giro.nombre_concepto_giro as nombre_concepto_giro,
    modalidad_pago.nombre_modalidad_pago as nombre_modalidad_pago,
    egresos.proveedor as proveedor,
    egresos.ruc as ruc,
    egresos.nro_orden_compra as nro_orden_compra,
    egresos.nro_orden_servicio as nro_orden_servicio,
    comprobantes.nombre_comprobantes as nombre_comprobantes,
    egresos.numero_comprobante as numero_comprobante,
    egresos.nro_cp_interno as nro_cp_interno,
    egresos.nota_pago as nota_pago,
    egresos.fecha_giro as fecha_giro,
    egresos.fecha_pago as fecha_pago,
    egresos.informe as informe,
    egresos.fecha_informe as fecha_informe,
    egresos.resolucion_directoral as resolucion_directoral,
    egresos.fecha_resolucion as fecha_resolucion,
    egresos.total_egresos as total_egresos,
    egresos.total_acumulado as total_acumulado,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    egresos.observacion_egreso as observacion_egreso,
    egresos.fyh_creacion as fyh_creacion_egreso,
    usuarios.nombres as nombres_usuario,
    usuarios.apaterno as apaterno_usuario,
    usuarios.amaterno as amaterno_usuario
    FROM tb_egresos as egresos 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = egresos.id_anio_nt_diga 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = egresos.id_tipo_gasto 
    INNER JOIN tb_cargo as cargo ON cargo.id_cargo = egresos.id_cargo_dependencia  
    INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal = egresos.id_actividad_dependencia 
    INNER JOIN tb_subactividad as subactividad ON subactividad.id_subactividad = egresos.id_subactividad 
    INNER JOIN tb_concepto_giro as concepto_giro ON concepto_giro.id_concepto_giro = egresos.id_concepto_giro
    INNER JOIN tb_modalidad_pago as modalidad_pago ON modalidad_pago.id_modalidad_pago = egresos.id_modalidad_pago
    INNER JOIN tb_comprobantes as comprobantes ON comprobantes.id_comprobantes = egresos.id_comprobantes
    INNER JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado_egreso
    INNER JOIN tb_usuarios as usuarios ON usuarios.id_usuario = egresos.id_usuario
    WHERE egresos.id_egresos='$id_egreso'";
$query_egresos = $pdo->prepare($sql_egresos);
$query_egresos->execute();
$egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);


foreach ($egresos_datos as $egresos_dato) {
    $id_egresos = $egresos_dato["id_egresos"];
    $nt_diga = $egresos_dato["nt_diga"];
    $nt_anio = $egresos_dato["nt_anio"];
    $proveido_diga = $egresos_dato["proveido_diga"];
    $fecha_diga = $egresos_dato["fecha_diga"];
    $proveido_conta = $egresos_dato["proveido_conta"];
    $fecha_conta = $egresos_dato["fecha_conta"];
    $asunto_conta = $egresos_dato["asunto_conta"];
    $siaf = $egresos_dato["siaf"];
    $nombre_tipo_gasto = $egresos_dato["nombre_tipo_gasto"];
    $oficio_dependencia = $egresos_dato["oficio_dependencia"];
    $fecha_dependencia = $egresos_dato["fecha_dependencia"];
    $nombre_cargo = $egresos_dato["nombre_cargo"];
    
    $nombre_actividad = $egresos_dato["nombre_actividad"];
    $id_cargo = $egresos_dato["id_cargo"];

    
    $nombre_subactividad = $egresos_dato["nombre_subactividad"];
    $id_actividad = $egresos_dato["id_actividad_principal"];

    $anio_periodo= $egresos_dato["anio_periodo"];
    $monto = $egresos_dato["monto"];
    $nombre_concepto_giro = $egresos_dato["nombre_concepto_giro"];
    $nombre_modalidad_pago = $egresos_dato["nombre_modalidad_pago"];
    $proveedor = $egresos_dato["proveedor"];
    $ruc = $egresos_dato["ruc"];
    $nro_orden_compra = $egresos_dato["nro_orden_compra"];
    $nro_orden_servicio = $egresos_dato["nro_orden_servicio"];
    $nombre_comprobantes = $egresos_dato["nombre_comprobantes"];
    $numero_comprobante = $egresos_dato["numero_comprobante"];
    $nro_cp_interno = $egresos_dato["nro_cp_interno"];
    $nota_pago = $egresos_dato["nota_pago"];
    $fecha_giro = $egresos_dato["fecha_giro"];
    $fecha_pago = $egresos_dato["fecha_pago"];
    $informe = $egresos_dato["informe"];
    $fecha_informe = $egresos_dato["fecha_informe"];
    $resolucion_directoral = $egresos_dato["resolucion_directoral"];
    $fecha_resolucion = $egresos_dato["fecha_resolucion"];
    $total_egresos = $egresos_dato["total_egresos"];
    $total_acumulado = $egresos_dato["total_acumulado"];
    $estado_egreso = $egresos_dato["estado_egreso"];
    $observacion = $egresos_dato["observacion_egreso"];
    $fyh_creacion_egreso = $egresos_dato["fyh_creacion_egreso"];
    $usuario = $egresos_dato["nombres_usuario"].' '.$egresos_dato["apaterno_usuario"].' '.$egresos_dato["amaterno_usuario"];  

}
