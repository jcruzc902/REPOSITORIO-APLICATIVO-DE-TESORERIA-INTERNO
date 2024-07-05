<?php
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE EGRESOS " . date('d-m-Y H:i:s') . ".xlsx";

$excelData[] = array(
    'ID',
    'NT',
    'Año',
    'Proveido (DIGA)',
    'Fecha',
    'Proveido (CONTABILIDAD)',
    'Fecha',
    'Asunto',
    'SIAF',
    'Tipo de Gasto',
    'Oficio',
    'Fecha',
    'Cargo',
    'Actividad Principal',
    'Subactividad',
    'Año',
    'Monto',
    'Concepto Giro',
    'Modalidad Pago',
    'Proveedor',
    'RUC',
    'N° Orden Compra',
    'N° Orden Servicio',
    'Tipo de Comprobante',
    'N° Comprobante',
    'N° Comprobante Interno',
    'Nota de Pago',
    'Fecha de Giro',
    'Fecha de Pago',
    'Informe',
    'Fecha de Informe',
    'N° Resolucion Rectoral',
    'Fecha R.R',
    'Total Egresos',
    'Total Acumulado',
    'Estado',
    'Observacion',
    'Fecha de Registro',
    'Fecha de Actualizacion',
    'Usuario'
);

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_nt'])) {
    $nt = $_SESSION['busqueda_nt'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_anio_nt'])) {
    $anio_nt = $_SESSION['busqueda_anio_nt'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_siaf'])) {
    $siaf= $_SESSION['busqueda_siaf'];
} else {
    $siaf= "";
}

if (isset($_SESSION['busqueda_tipo_gasto'])) {
    $tipo_gasto= $_SESSION['busqueda_tipo_gasto'];
} else {
    $tipo_gasto= "";
}

if (isset($_SESSION['busqueda_siaf'])) {
    $siaf= $_SESSION['busqueda_siaf'];
} else {
    $siaf= "";
}

if (isset($_SESSION['busqueda_concepto_giro'])) {
    $concepto_giro= $_SESSION['busqueda_concepto_giro'];
} else {
    $concepto_giro= "";
}

if (isset($_SESSION['busqueda_modalidad_pago'])) {
    $modalidad_pago= $_SESSION['busqueda_modalidad_pago'];
} else {
    $modalidad_pago= "";
}

if (isset($_SESSION['busqueda_cargo'])) {
    $cargo= $_SESSION['busqueda_cargo'];
} else {
    $cargo= "";
}

if (isset($_SESSION['busqueda_actividad_principal'])) {
    $actividad_principal= $_SESSION['busqueda_actividad_principal'];
} else {
    $actividad_principal= "";
}

if (isset($_SESSION['busqueda_subactividad'])) {
    $subactividad= $_SESSION['busqueda_subactividad'];
} else {
    $subactividad= "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado= $_SESSION['busqueda_estado'];
} else {
    $estado= "";
}

if (isset($_SESSION['busqueda_desde'])) {
    $desde = $_SESSION['busqueda_desde'];
} else {
    $desde = "";
}

if (isset($_SESSION['busqueda_hasta'])) {
    $hasta = $_SESSION['busqueda_hasta'];
} else {
    $hasta = "";
}

$sql_egresos = "SELECT egresos.id_egresos as id_egresos,
    egresos.proveido_conta as proveido_conta,
    egresos.fecha_conta as fecha_conta,
    egresos.asunto_conta as asunto_conta,
    egresos.siaf as siaf,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    egresos.nt_diga as nt_diga,
    anio_nt.anio_nt as nt_anio,
    egresos.proveido_diga as proveido_diga,
    egresos.fecha_diga as fecha_diga,
    egresos.oficio_dependencia as oficio_dependencia,
    egresos.fecha_dependencia as fecha_dependencia,
    cargo.nombre_cargo as nombre_cargo,
    actividad_principal.nombre_actividad as nombre_actividad,
    subactividad.nombre_subactividad as nombre_subactividad,
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
    egresos.id_estado_egreso as id_estado_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    egresos.observacion_egreso as observacion_egreso,
    egresos.fyh_creacion as fyh_creacion_egreso,
    egresos.fyh_actualizacion as fyh_actualizacion_egreso,
    usuarios.nombres as nombres_usuario,
    usuarios.apaterno as apaterno_usuario,
    usuarios.amaterno as amaterno_usuario
    FROM tb_egresos as egresos 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = egresos.id_tipo_gasto 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = egresos.id_anio_nt_diga 
    INNER JOIN tb_cargo as cargo ON cargo.id_cargo = egresos.id_cargo_dependencia  
    INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal = egresos.id_actividad_dependencia 
    INNER JOIN tb_subactividad as subactividad ON subactividad.id_subactividad = egresos.id_subactividad
    INNER JOIN tb_concepto_giro as concepto_giro ON concepto_giro.id_concepto_giro = egresos.id_concepto_giro
    INNER JOIN tb_modalidad_pago as modalidad_pago ON modalidad_pago.id_modalidad_pago = egresos.id_modalidad_pago
    INNER JOIN tb_comprobantes as comprobantes ON comprobantes.id_comprobantes = egresos.id_comprobantes
    INNER JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado_egreso
    INNER JOIN tb_usuarios as usuarios ON usuarios.id_usuario = egresos.id_usuario
    WHERE egresos.visible!=1 ";

if (isset($_SESSION['busqueda_boton_egresos'])) {
    if (
        !isset($nt) && !isset($anio_nt) && !isset($siaf) && !isset($tipo_gasto) && !isset($concepto_giro) && !isset($modalidad_pago)
        && !isset($cargo) && !isset($actividad_principal) && !isset($subactividad) && !isset($estado) && !isset($desde) && !isset($hasta)
    ) {
        $sql_egresos .= " ";
    } else {

        if (!empty($nt)) {
            $sql_egresos .= " AND egresos.nt_diga like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_egresos .= " AND egresos.id_anio_nt_diga='" . $anio_nt . "'";
        }

        if (!empty($siaf)) {
            $sql_egresos .= " AND egresos.siaf like '%" . $siaf . "%'";
        }

        if (!empty($tipo_gasto)) {
            $sql_egresos .= " AND egresos.id_tipo_gasto='" . $tipo_gasto . "'";
        }

        if (!empty($concepto_giro)) {
            $sql_egresos .= " AND egresos.id_concepto_giro='" . $concepto_giro . "'";
        }

        if (!empty($modalidad_pago)) {
            $sql_egresos .= " AND egresos.id_modalidad_pago='" . $modalidad_pago . "'";
        }

        if (!empty($cargo)) {
            $sql_egresos .= " AND egresos.id_cargo_dependencia='" . $cargo . "'";
        }

        if (!empty($actividad_principal)) {
            $sql_egresos .= " AND egresos.id_actividad_dependencia='" . $actividad_principal . "'";
        }

        if (!empty($subactividad)) {
            $sql_egresos .= " AND egresos.id_subactividad='" . $subactividad . "'";
        }

        if (!empty($estado)) {
            $sql_egresos .= " AND egresos.id_estado_egreso='" . $estado . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_egresos .= " AND egresos.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($egresos_datos)) {
    $egresos_datos = '';
} else {
    foreach ($egresos_datos as $egresos_dato) {

        if($egresos_dato['fecha_diga']=="0000-00-00"){
            $egresos_dato['fecha_diga']= "";
        }

        if($egresos_dato['fecha_conta']=="0000-00-00"){
            $egresos_dato['fecha_conta']= "";
        }

        if($egresos_dato['nombre_tipo_gasto']=="SELECCIONAR"){
            $egresos_dato['nombre_tipo_gasto']= "";
        }

        if($egresos_dato['fecha_dependencia']=="0000-00-00"){
            $egresos_dato['fecha_dependencia']= "";
        }

        if($egresos_dato['nombre_concepto_giro']=="SELECCIONAR"){
            $egresos_dato['nombre_concepto_giro']= "";
        }

        if($egresos_dato['nombre_modalidad_pago']=="SELECCIONAR"){
            $egresos_dato['nombre_modalidad_pago']= "";
        }

        if($egresos_dato['nombre_comprobantes']=="SELECCIONAR"){
            $egresos_dato['nombre_comprobantes']= "";
        }

        if($egresos_dato['fecha_giro']=="0000-00-00"){
            $egresos_dato['fecha_giro']= "";
        }

        if($egresos_dato['fecha_pago']=="0000-00-00"){
            $egresos_dato['fecha_pago']= "";
        }

        if($egresos_dato['fecha_informe']=="0000-00-00"){
            $egresos_dato['fecha_informe']= "";
        }

        if($egresos_dato['fecha_resolucion']=="0000-00-00"){
            $egresos_dato['fecha_resolucion']= "";
        }

        $excelData[] = array(
            $contador = $contador + 1,
            $egresos_dato['nt_diga'],
            $egresos_dato['nt_anio'],
            $egresos_dato['proveido_diga'],
            $egresos_dato['fecha_diga'],
            $egresos_dato['proveido_conta'],
            $egresos_dato['fecha_conta'],
            $egresos_dato['asunto_conta'],
            $egresos_dato['siaf'],
            $egresos_dato['nombre_tipo_gasto'],
            $egresos_dato['oficio_dependencia'],
            $egresos_dato['fecha_dependencia'],
            $egresos_dato['nombre_cargo'],
            $egresos_dato['nombre_actividad'],
            $egresos_dato['nombre_subactividad'],
            $egresos_dato['anio_periodo'],
            $egresos_dato['monto'],
            $egresos_dato['nombre_concepto_giro'],
            $egresos_dato['nombre_modalidad_pago'],
            $egresos_dato['proveedor'],
            $egresos_dato['ruc'],
            $egresos_dato['nro_orden_compra'],
            $egresos_dato['nro_orden_servicio'],
            $egresos_dato['nombre_comprobantes'],
            $egresos_dato['numero_comprobante'],
            $egresos_dato['nro_cp_interno'],
            $egresos_dato['nota_pago'],
            $egresos_dato['fecha_giro'],
            $egresos_dato['fecha_pago'],
            $egresos_dato['informe'],
            $egresos_dato['fecha_informe'],
            $egresos_dato['resolucion_directoral'],
            $egresos_dato['fecha_resolucion'],
            $egresos_dato['total_egresos'],
            $egresos_dato['total_acumulado'],
            $egresos_dato['estado_egreso'],
            $egresos_dato['observacion_egreso'],
            $egresos_dato['fyh_creacion_egreso'],
            $egresos_dato['fyh_actualizacion_egreso'],
            $egresos_dato['nombres_usuario'] . " " . $egresos_dato['apaterno_usuario'] . " " . $egresos_dato['amaterno_usuario']
        );


    }
}


//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);
exit();