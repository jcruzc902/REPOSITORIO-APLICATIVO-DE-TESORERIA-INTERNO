<?php
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE CHEQUE " . date('d-m-Y H:i:s') . ".xlsx";


$excelData[] = array(
    'ID',
    'NT',
    'Año',
    'Proveido(DIGA)',
    'Fecha',
    'Proveido(CONTABILIDAD)',
    'Fecha',
    'Asunto',
    'SIAF',
    'Tipo',
    'Oficio',
    'Fecha',
    'Observacion de Tramite',
    'Tipo de cheques',
    'N° C.I',
    'Fecha C.I',
    'N° C.E',
    'Fecha C.E',
    'N° Cheque',
    'Fecha de Emision',
    'Monto',
    'N° Envio',
    'Fecha Aprobado',
    'Fecha Entregado',
    'Fecha Pagado',
    'Observacion de Cheque',
    'Usuario',
    'Fecha Registro',
    'Fecha Actualizacion',
);

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_nt_cheque'])) {
    $nt = $_SESSION['busqueda_nt_cheque'];
} else {
    $nt = "";
}

if (isset($_SESSION['busqueda_anio_nt_cheque'])) {
    $anio_nt = $_SESSION['busqueda_anio_nt_cheque'];
} else {
    $anio_nt = "";
}

if (isset($_SESSION['busqueda_proveido_cheque'])) {
    $proveido = $_SESSION['busqueda_proveido_cheque'];
} else {
    $proveido = "";
}

if (isset($_SESSION['busqueda_fecha_proveido_cheque'])) {
    $fecha_proveido = $_SESSION['busqueda_fecha_proveido_cheque'];
} else {
    $fecha_proveido = "";
}

if (isset($_SESSION['busqueda_asunto_cheque'])) {
    $asunto = $_SESSION['busqueda_asunto_cheque'];
} else {
    $asunto = "";
}

if (isset($_SESSION['busqueda_tipo_gasto_cheque'])) {
    $tipo_gasto = $_SESSION['busqueda_tipo_gasto_cheque'];
} else {
    $tipo_gasto = "";
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

$sql_cheques = "SELECT cheque.id_cheque as id_cheque,
    cheque.nt as numero_tramite,
    cheque.id_anio_nt as id_anio_nt,
    anio_nt.anio_nt as nt_anio,
    cheque.proveido_diga as proveido_diga,
    cheque.fecha_diga as fecha_diga,
    cheque.proveido_conta as proveido_conta,
    cheque.fecha_conta as fecha_conta,
    cheque.id_asunto as id_asunto,
    asunto.nombre_asunto as nombre_asunto,
    cheque.siaf as siaf,
    cheque.id_tipo_gasto as id_tipo_gasto,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    cheque.oficio as oficio,
    cheque.fecha_oficio as fecha_oficio,
    cheque.observacion as observacion,
    nrocuenta.nro_cuenta as nro_cuenta,
    detalle.nro_ci as nro_ci,
    detalle.fecha_ci as fecha_ci,
    detalle.nro_ce as nro_ce,
    detalle.fecha_ce as fecha_ce,
    detalle.nro_cheque as nro_cheque,
    detalle.fecha_emision_cheque as fecha_emision_cheque,
    detalle.monto as monto,
    detalle.nro_envio as nro_envio,
    detalle.fecha_aprobado as fecha_aprobado,
    detalle.fecha_entregado as fecha_entregado,
    detalle.fecha_pagado as fecha_pagado,
    detalle.observacion as observacion_cheque,
    usuario.nombres as nombres,
    usuario.apaterno as apaterno,
    usuario.amaterno as amaterno,
    detalle.fyh_creacion as fyh_creacion_detalle,
    detalle.fyh_actualizacion as fyh_actualizacion_detalle
    FROM tb_cheque as cheque 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = cheque.id_anio_nt 
    INNER JOIN tb_asunto as asunto ON asunto.id_asunto = cheque.id_asunto 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = cheque.id_tipo_gasto
    LEFT JOIN tb_detalle_cheque AS detalle ON (detalle.nt = cheque.nt AND detalle.id_anio_nt = cheque.id_anio_nt) 
    LEFT JOIN tb_nrocuenta AS nrocuenta ON nrocuenta.id_nrocuenta = detalle.id_nrocuenta 
    LEFT JOIN tb_usuarios AS usuario ON usuario.id_usuario = detalle.id_usuario  
    WHERE cheque.visible>=0 ";

if (isset($_SESSION["busqueda_boton_cheque"])) {


    if (
        !isset($nt) && !isset($anio_nt) && !isset($proveido) && !isset($fecha_proveido) && !isset($asunto) && !isset($tipo_gasto)
        && !isset($desde) && !isset($hasta)
    ) {
        $sql_cheques .= " ";
    } else {

        if (!empty($nt)) {
            $sql_cheques .= " AND cheque.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_cheques .= " AND cheque.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($proveido)) {
            $sql_cheques .= " AND cheque.proveido_diga like '%" . $proveido . "%'";
        }

        if (!empty($fecha_proveido)) {
            $sql_cheques .= " AND cheque.fecha_diga='" . $fecha_proveido . "'";
        }

        if (!empty($asunto)) {
            $sql_cheques .= " AND cheque.id_asunto='" . $asunto . "'";
        }

        if (!empty($tipo_gasto)) {
            $sql_cheques .= " AND cheque.id_tipo_gasto='" . $tipo_gasto . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_cheques .= " AND cheque.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_cheques = $pdo->prepare($sql_cheques);
    $query_cheques->execute();
    $cheques_datos = $query_cheques->fetchAll(PDO::FETCH_ASSOC);

}

if (!isset($cheques_datos)) {
    $cheques_datos = '';
} else {
    foreach ($cheques_datos as $cheques_dato) {

        if ($cheques_dato['fyh_actualizacion_detalle'] == "0000-00-00") {
            $cheques_dato['fyh_actualizacion_detalle'] = "";
        }

        $excelData[] = array(
            $contador = $contador + 1,
            $cheques_dato['numero_tramite'],
            $cheques_dato['nt_anio'],
            $cheques_dato['proveido_diga'],
            $cheques_dato['fecha_diga'],
            $cheques_dato['proveido_conta'],
            $cheques_dato['fecha_conta'],
            $cheques_dato['nombre_asunto'],
            $cheques_dato['siaf'],
            $cheques_dato['nombre_tipo_gasto'],
            $cheques_dato['oficio'],
            $cheques_dato['fecha_oficio'],
            $cheques_dato['observacion'],
            $cheques_dato['nro_cuenta'],
            $cheques_dato['nro_ci'],
            $cheques_dato['fecha_ci'],
            $cheques_dato['nro_ce'],
            $cheques_dato['fecha_ce'],
            $cheques_dato['nro_cheque'],
            $cheques_dato['fecha_emision_cheque'],
            $cheques_dato['monto'],
            $cheques_dato['nro_envio'],
            $cheques_dato['fecha_aprobado'],
            $cheques_dato['fecha_entregado'],
            $cheques_dato['fecha_pagado'],
            $cheques_dato['observacion_cheque'],
            $cheques_dato['nombres'] . " " . $cheques_dato['apaterno'] . " " . $cheques_dato['amaterno'],
            $cheques_dato['fyh_creacion_detalle'],
            $cheques_dato['fyh_actualizacion_detalle']
            
        
        
        );


    }
}


//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);
exit();