<?php
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE DEVOLUCION DE DINERO " . date('d-m-Y H:i:s') . ".xlsx";



$excelData[] = array(
    'ID',
    'Periodo',
    'NT',
    'Año',
    'Proveido',
    'Fecha',
    'Oficio',
    'Fecha',
    'Informe',
    'Fecha',
    'Dependencia',
    'Observacion NT',
    'N° Recibo',
    'Nombre del Banco',
    'N° Cuenta de Banco',
    'Importe del Voucher',
    'Fecha del Voucher',
    'Concepto',
    'Año',
    'Ciclo',
    'Clasificador',
    'SIAF (DEVOLUCION)',
    'Año',
    'SIAF (ORIGEN)',
    'Año',
    'Tipo de Identificacion',
    'DNI',
    'Nombre del Solicitante',
    'Nombre del Apoderado',
    'Empresa',
    'N° RUC',
    'Telefono',
    'Correo',
    'Importe Devolucion (UNFV)',
    'N° Cuenta',
    'Estado de Giro',
    'Observacion (Estado de Giro)',
    'Saldo',
    'Documento de Pago',
    'N° Cheque',
    'Fecha Cheque',
    'N° Envio',
    'Año',
    'N° OPE',
    'Fecha OPE',
    'N° CCI',
    'Fecha CCI',
    'N° Carta Orden',
    'Fecha Carta Orden',
    'N° Comprob. Interno',
    'N° Comprob. Externo',
    'Fecha Entrega (Pagaduria)',
    'Condicion',
    'Fecha Pago (BN)',
    'Condicion',
    'Importe Devolucion (BN)',
    'Diferencia',
    'Observacion',
    'Fecha de Registro',
    'Fecha de Actualizacion',
    'Usuario'
);

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_periodo'])) {
    $periodo = $_SESSION['busqueda_periodo'];
} else {
    $periodo = "";
}

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

if (isset($_SESSION['busqueda_proveido'])) {
    $proveido = $_SESSION['busqueda_proveido'];
} else {
    $proveido = "";
}

if (isset($_SESSION['busqueda_fecha_proveido'])) {
    $fecha_proveido = $_SESSION['busqueda_fecha_proveido'];
} else {
    $fecha_proveido = "";
}

if (isset($_SESSION['busqueda_oficio'])) {
    $oficio = $_SESSION['busqueda_oficio'];
} else {
    $oficio = "";
}

if (isset($_SESSION['busqueda_fecha_oficio'])) {
    $fecha_oficio = $_SESSION['busqueda_fecha_oficio'];
} else {
    $fecha_oficio = "";
}

if (isset($_SESSION['busqueda_informe'])) {
    $informe = $_SESSION['busqueda_informe'];
} else {
    $informe = "";
}

if (isset($_SESSION['busqueda_fecha_informe'])) {
    $fecha_informe = $_SESSION['busqueda_fecha_informe'];
} else {
    $fecha_informe = "";
}

if (isset($_SESSION['busqueda_dependencia'])) {
    $dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $dependencia = "";
}

if (isset($_SESSION['busqueda_documento_pago'])) {
    $documento_pago = $_SESSION['busqueda_documento_pago'];
} else {
    $documento_pago = "";
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

$sql_devoluciones = "SELECT *,
anio_periodo.anio_periodo AS periodo_anio,
dev.nt AS nt_devolucion,
anio_nt.anio_nt AS nt_anio,
dev.proveido AS proveido,
dev.fecha_proveido AS fecha_proveido,
dev.oficio AS oficio,
dev.fecha_oficio AS fecha_oficio,
dev.informe AS informe,
dev.fecha_informe AS fecha_informe,
dep.nombre AS dependencia,
dev.observacion_devolucion AS observacion_devolucion,
us.nombres AS nombres,
us.apaterno AS apellidopaterno,
us.amaterno AS apellidomaterno,
dev.fyh_creacion AS fyh_creacion_dev,
dev.fyh_actualizacion AS fyh_actualizacion_dev,
detalle.nro_liquidacion AS numero_recibo,
banco.nombre_banco AS nombre_banco,
detalle.nro_cuenta_banco AS nro_cuenta_banco,
detalle.importe_voucher AS importe_voucher,
detalle.fecha_voucher AS fecha_voucher,
concepto.nombre	AS nombre_concepto,
concepto_anio.anio_concepto AS anio_concepto,
ciclo.ciclo AS ciclo,
detalle.clasificador AS clasificador,
detalle.siaf_devolucion AS siaf_devolucion,
anio_siafdevolucion.anio_siaf AS anio_siafdev,
detalle.siaf_origen AS siaf_origen,
anio_siaforigen.anio_siaf AS anio_siaforigen,
tipo_documento.nombre_documento AS nombre_documento,
detalle.dni AS dni,
detalle.nombre_solicitante AS nombre_solicitante,
detalle.nombre_apoderado AS nombre_apoderado,
empresa.razon_social AS razon_social,
empresa.ruc AS ruc,
detalle.telefono AS telefono,
detalle.correo AS correo,
detalle.importe_devolucion_unfv AS importe_devolucion_unfv,
nro_cuenta.nro_cuenta AS nro_cuenta,
estado_giro.estado AS estado_giro,
detalle.observacion_giro AS observacion_giro,
detalle.saldo AS saldo,
doc_pago.nombre AS documento_pago,
detalle.numero_cheque AS numero_cheque,
detalle.fecha_cheque AS fecha_cheque,
detalle.numero_ope AS numero_ope,
detalle.fecha_ope AS fecha_ope,
detalle.numero_cci AS numero_cci,
detalle.fecha_cci AS fecha_cci,
detalle.numero_cartaorden AS numero_cartaorden,
detalle.fecha_cartaorden AS fecha_cartaorden,
detalle.nro_envio AS nro_envio,
anio_envio.anio_envio AS envio_anio,
detalle.nci AS numero_comprobante_interno,
detalle.nce AS numero_comprobante_externo,
detalle.fecha_entrega AS fecha_entrega,
cond1.condicion AS condicion_entrega,
detalle.fecha_pago AS fecha_pago,
cond2.condicion AS condicion_pago,
detalle.importe_devolucion_bn AS importe_devolucion_bn,
detalle.diferencia AS diferencia,
detalle.observacion AS observacion,
detalle.fyh_creacion AS fecha_registro_detalle,
detalle.fyh_actualizacion AS fyh_actualizacion_detalle 
FROM tb_devoluciones AS dev
INNER JOIN tb_anio_periodo AS anio_periodo ON anio_periodo.id_anio_periodo = dev.id_anio_periodo
INNER JOIN tb_anio_nt AS anio_nt ON anio_nt.id_anio_nt = dev.id_anio_nt
INNER JOIN tb_dependencias AS dep ON dep.id_dependencia = dev.id_dependencia 
INNER JOIN tb_usuarios AS us ON us.id_usuario = dev.id_usuario
LEFT JOIN tb_detalle_devolucion AS detalle ON (detalle.nt = dev.nt AND detalle.id_anio_nt = dev.id_anio_nt) 
LEFT JOIN tb_bancos AS banco ON banco.id_banco = detalle.id_banco 
LEFT JOIN tb_conceptos AS concepto ON concepto.id_concepto = detalle.id_concepto 
LEFT JOIN tb_anio_concepto AS concepto_anio ON concepto_anio.id_anio_concepto = detalle.id_anio_concepto
LEFT JOIN tb_ciclos AS ciclo ON ciclo.id_ciclo = detalle.id_ciclo_concepto 
LEFT JOIN tb_anio_siafdevolucion AS anio_siafdevolucion ON anio_siafdevolucion.id_anio_siafdevolucion = detalle.id_anio_siaf_devolucion 
LEFT JOIN tb_anio_siaforigen AS anio_siaforigen ON anio_siaforigen.id_anio_siaforigen = detalle.id_anio_siaf_origen 
LEFT JOIN tb_tipo_documento AS tipo_documento ON tipo_documento.id_tipo_documento = detalle.id_tipo_documento 
LEFT JOIN tb_empresas AS empresa ON empresa.id_empresa = detalle.id_empresa
LEFT JOIN tb_nrocuenta AS nro_cuenta ON nro_cuenta.id_nrocuenta = detalle.id_nrocuenta 
LEFT JOIN tb_estado_giro AS estado_giro ON estado_giro.id_estado_giro= detalle.id_estado_giro
LEFT JOIN tb_doc_pagos AS doc_pago ON doc_pago.id_doc_pagos = detalle.id_doc_pagos
LEFT JOIN tb_anio_envio AS anio_envio ON anio_envio.id_anio_envio = detalle.id_anio_envio
LEFT JOIN tb_condicion AS cond1 ON cond1.id_condicion = detalle.id_condicion
LEFT JOIN tb_condicion2 AS cond2 ON cond2.id_condicion2 = detalle.id_condicion2 
WHERE dev.visible >= 0 ";

if (isset($_SESSION['busqueda_boton_devolucion'])) {
    if (
        !isset($periodo) && !isset($nt) && !isset($anio_nt) && !isset($proveido) && !isset($fecha_proveido) && !isset($oficio) && !isset($fecha_oficio)
        && !isset($informe) && !isset($fecha_informe) && !isset($dependencia) && !isset($desde) && !isset($hasta)
    ) {
        $sql_devoluciones .= "";
    } else {
        if (!empty($periodo)) {
            $sql_devoluciones .= " AND dev.id_anio_periodo='" . $periodo . "'";
        }

        if (!empty($nt)) {
            $sql_devoluciones .= " AND dev.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_devoluciones .= " AND dev.id_anio_nt='" . $anio_nt . "'";
        }

        if (!empty($proveido)) {
            $sql_devoluciones .= " AND dev.proveido like '%" . $proveido . "%'";
        }

        if (!empty($fecha_proveido)) {
            $sql_devoluciones .= " AND dev.fecha_proveido='" . $fecha_proveido . "'";
        }

        if (!empty($oficio)) {
            $sql_devoluciones .= " AND dev.oficio like '%" . $oficio . "%'";
        }

        if (!empty($fecha_oficio)) {
            $sql_devoluciones .= " AND dev.fecha_oficio='" . $fecha_oficio . "'";
        }

        if (!empty($informe)) {
            $sql_devoluciones .= " AND dev.informe like '%" . $informe . "%'";
        }

        if (!empty($fecha_informe)) {
            $sql_devoluciones .= " AND dev.fecha_informe='" . $fecha_informe . "'";
        }

        if (!empty($dependencia)) {
            $sql_devoluciones .= " AND dev.id_dependencia='" . $dependencia . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_devoluciones .= " AND dev.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_devoluciones = $pdo->prepare($sql_devoluciones);
    $query_devoluciones->execute();
    $devolucion_datos = $query_devoluciones->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($devolucion_datos)) {
    $devolucion_datos = '';
} else {
    foreach ($devolucion_datos as $devolucion_dato) {

        if ($devolucion_dato['fecha_proveido'] == "0000-00-00") {
            $devolucion_dato['fecha_proveido'] = "";
        }

        if ($devolucion_dato['fecha_oficio'] == "0000-00-00") {
            $devolucion_dato['fecha_oficio'] = "";
        }

        if ($devolucion_dato['fecha_informe'] == "0000-00-00") {
            $devolucion_dato['fecha_informe'] = "";
        }

        if ($devolucion_dato['dependencia'] == "SELECCIONAR") {
            $devolucion_dato['dependencia'] = "";
        }

        if ($devolucion_dato['documento_pago'] == "SELECCIONAR") {
            $devolucion_dato['documento_pago'] = "";
        }

        if ($devolucion_dato['fecha_cheque'] == "0000-00-00") {
            $devolucion_dato['fecha_cheque'] = "";
        }

        if ($devolucion_dato['fecha_ope'] == "0000-00-00") {
            $devolucion_dato['fecha_ope'] = "";
        }

        if ($devolucion_dato['fecha_cci'] == "0000-00-00") {
            $devolucion_dato['fecha_cci'] = "";
        }

        if ($devolucion_dato['fecha_cartaorden'] == "0000-00-00") {
            $devolucion_dato['fecha_cartaorden'] = "";
        }

        if ($devolucion_dato['envio_anio'] == "SELECCIONAR") {
            $devolucion_dato['envio_anio'] = "";
        }

        if ($devolucion_dato['fecha_entrega'] == "0000-00-00") {
            $devolucion_dato['fecha_entrega'] = "";
        }

        if ($devolucion_dato['condicion_entrega'] == "SELECCIONAR") {
            $devolucion_dato['condicion_entrega'] = "";
        }

        if ($devolucion_dato['fecha_pago'] == "0000-00-00") {
            $devolucion_dato['fecha_pago'] = "";
        }

        if ($devolucion_dato['condicion_pago'] == "SELECCIONAR") {
            $devolucion_dato['condicion_pago'] = "";
        }

        if ($devolucion_dato['ciclo'] == "SELECCIONAR") {
            $devolucion_dato['ciclo'] = "";
        }

        if ($devolucion_dato['razon_social'] == "SELECCIONAR") {
            $devolucion_dato['razon_social'] = "";
        }

        if ($devolucion_dato['ruc'] == "SELECCIONAR") {
            $devolucion_dato['ruc'] = "";
        }

        $excelData[] = array(
            $contador = $contador + 1,
            $devolucion_dato['periodo_anio'],
            $devolucion_dato['nt_devolucion'],
            $devolucion_dato['nt_anio'],
            $devolucion_dato['proveido'],
            $devolucion_dato['fecha_proveido'],
            $devolucion_dato['oficio'],
            $devolucion_dato['fecha_oficio'],
            $devolucion_dato['informe'],
            $devolucion_dato['fecha_informe'],
            $devolucion_dato['dependencia'],
            $devolucion_dato['observacion_devolucion'],
            $devolucion_dato['numero_recibo'],
            $devolucion_dato['nombre_banco'],
            $devolucion_dato['nro_cuenta_banco'],
            $devolucion_dato['importe_voucher'],
            $devolucion_dato['fecha_voucher'],
            $devolucion_dato['nombre_concepto'],
            $devolucion_dato['anio_concepto'],
            $devolucion_dato['ciclo'],
            $devolucion_dato['clasificador'],
            $devolucion_dato['siaf_devolucion'],
            $devolucion_dato['anio_siafdev'],
            $devolucion_dato['siaf_origen'],
            $devolucion_dato['anio_siaforigen'],
            $devolucion_dato['nombre_documento'],
            $devolucion_dato['dni'],
            $devolucion_dato['nombre_solicitante'],
            $devolucion_dato['nombre_apoderado'],
            $devolucion_dato['razon_social'],
            $devolucion_dato['ruc'],
            $devolucion_dato['telefono'],
            $devolucion_dato['correo'],
            $devolucion_dato['importe_devolucion_unfv'],
            $devolucion_dato['nro_cuenta'],
            $devolucion_dato['estado_giro'],
            $devolucion_dato['observacion_giro'],
            $devolucion_dato['saldo'],
            $devolucion_dato['documento_pago'],
            $devolucion_dato['numero_cheque'],
            $devolucion_dato['fecha_cheque'],
            $devolucion_dato['nro_envio'],
            $devolucion_dato['envio_anio'],
            $devolucion_dato['numero_ope'],
            $devolucion_dato['fecha_ope'],
            $devolucion_dato['numero_cci'],
            $devolucion_dato['fecha_cci'],
            $devolucion_dato['numero_cartaorden'],
            $devolucion_dato['fecha_cartaorden'],
            $devolucion_dato['numero_comprobante_interno'],
            $devolucion_dato['numero_comprobante_externo'],
            $devolucion_dato['fecha_entrega'],
            $devolucion_dato['condicion_entrega'],
            $devolucion_dato['fecha_pago'],
            $devolucion_dato['condicion_pago'],
            $devolucion_dato['importe_devolucion_bn'],
            $devolucion_dato['diferencia'],
            $devolucion_dato['observacion'],
            $devolucion_dato['fyh_creacion_dev'],
            $devolucion_dato['fyh_actualizacion_detalle'],
            $devolucion_dato['nombres'] . " " . $devolucion_dato['apellidopaterno'] . " " . $devolucion_dato['apellidomaterno']
        );


    }
}


//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);
exit();