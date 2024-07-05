<?php
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE TASAS Y TARIFAS " . date('d-m-Y H:i:s') . ".xlsx";

$excelData[] = array(
    'ID',
    'CODIGO DE PAGO',
    'MODALIDAD',
    'CONCEPTO',
    'MONTO',
    'REFERENCIA',
    'CLASIFICADOR',
    'CODIGO DE FACULTAD',
    'DEPENDENCIA',
    'CODIGO DE SERVICIO BANCO',
    'CUENTA',
    'RESOLUCION RECTORAL',
    'ARCHIVO',
    'VIGENCIA',
    'SITUACION',
    'TIPO',
    'OBSERVACION',
    'FECHA DE REGISTRO',
    'FECHA DE ACTUALIZACION',
    'USUARIO'
);

$contador = 0;
session_start();

if (isset($_SESSION['busqueda_codigo_pago'])) {
    $codigo_pago = $_SESSION['busqueda_codigo_pago'];
} else {
    $codigo_pago = "";
}

if (isset($_SESSION['busqueda_modalidad'])) {
    $modalidad = $_SESSION['busqueda_modalidad'];
} else {
    $modalidad = "";
}

if (isset($_SESSION['busqueda_concepto'])) {
    $concepto = $_SESSION['busqueda_concepto'];
} else {
    $concepto = "";
}

if (isset($_SESSION['busqueda_referencia'])) {
    $referencia = $_SESSION['busqueda_referencia'];
} else {
    $referencia = "";
}

if (isset($_SESSION['busqueda_dependencia'])) {
    $dependencia = $_SESSION['busqueda_dependencia'];
} else {
    $dependencia = "";
}

if (isset($_SESSION['busqueda_cuenta'])) {
    $cuenta = $_SESSION['busqueda_cuenta'];
} else {
    $cuenta = "";
}

if (isset($_SESSION['busqueda_resolucion'])) {
    $resolucion = $_SESSION['busqueda_resolucion'];
} else {
    $resolucion = "";
}

if (isset($_SESSION['busqueda_situacion'])) {
    $situacion = $_SESSION['busqueda_situacion'];
} else {
    $situacion = "";
}

if (isset($_SESSION['busqueda_tipo'])) {
    $tipo = $_SESSION['busqueda_tipo'];
} else {
    $tipo = "";
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

$sql_tasas_tarifas = "SELECT tyt.id_tasas_tarifas as id_tasas_tarifas, 
    tyt.codigo_pago as codigo_pago, 
    tyt.modalidad as modalidad, 
    tyt.concepto as concepto, 
    tyt.monto as monto, 
    tyt.referencia as referencia, 
    tyt.clasificador as clasificador, 
    tyt.codigo_facultad as codigo_facultad, 
    tyt.dependencia as dependencia, 
    tyt.codigo_ser_banco as codigo_ser_banco, 
    tyt.cta as cta, 
    tyt.resolucion as resolucion,
    tyt.archivo_resolucion as archivo_resolucion, 
    tyt.vigencia as vigencia, 
    tyt.situacion as situacion,
    tyt.categoria_transaccion as categoria_transaccion,
    tyt.observacion as observacion, 
    usuario.id_usuario as id_usuario,
    usuario.nombres as nombres,
    usuario.apaterno as apaterno, 
    usuario.amaterno as amaterno, 
    tyt.fyh_creacion as fyh_creacion_tyt,
    tyt.fyh_actualizacion as fyh_actualizacion_tyt 
    FROM tb_tasas_tarifas as tyt 
    INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= tyt.id_usuario
    WHERE tyt.visible!=1 ";

if (isset($_SESSION['busqueda_boton_tasas_tarifas'])) {
    if (
        !isset($codigo_pago) && !isset($modalidad) && !isset($concepto) && !isset($referencia) && !isset($dependencia)
        && !isset($cuenta) && !isset($resolucion) && !isset($situacion) && !isset($tipo) && !isset($desde) && !isset($hasta)
    ) {
        $sql_tasas_tarifas .= " ";
    } else {

        if (!empty($codigo_pago)) {
            $sql_tasas_tarifas .= " AND codigo_pago like '%" . $codigo_pago . "%'";
        }

        if (!empty($modalidad)) {
            $sql_tasas_tarifas .= " AND modalidad='" . $modalidad . "'";
        }

        if (!empty($concepto)) {
            $sql_tasas_tarifas .= " AND concepto='" . $concepto . "'";
        }

        if (!empty($referencia)) {
            $sql_tasas_tarifas .= " AND referencia='" . $referencia . "'";
        }

        if (!empty($dependencia)) {
            $sql_tasas_tarifas .= " AND dependencia='" . $dependencia . "'";
        }

        if (!empty($cuenta)) {
            $sql_tasas_tarifas .= " AND cta='" . $cuenta . "'";
        }

        if (!empty($resolucion)) {
            $sql_tasas_tarifas .= " AND resolucion='" . $resolucion . "'";
        }

        if (!empty($situacion)) {
            $sql_tasas_tarifas .= " AND situacion='" . $situacion . "'";
        }

        if (!empty($tipo)) {
            $sql_tasas_tarifas .= " AND categoria_transaccion='" . $tipo . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_tasas_tarifas .= " AND fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
    $query_tasas_tarifas->execute();
    $tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($tasas_tarifas_datos)) {
    $tasas_tarifas_datos = '';
} else {
    foreach ($tasas_tarifas_datos as $tasas_tarifas_dato) {

        if ($tasas_tarifas_dato['modalidad'] == "SELECCIONAR") {
            $tasas_tarifas_dato['modalidad'] = "";
        }

        if ($tasas_tarifas_dato['concepto'] == "SELECCIONAR") {
            $tasas_tarifas_dato['concepto'] = "";
        }

        if ($tasas_tarifas_dato['referencia'] == "SELECCIONAR") {
            $tasas_tarifas_dato['referencia'] = "";
        }

        if ($tasas_tarifas_dato['dependencia'] == "SELECCIONAR") {
            $tasas_tarifas_dato['dependencia'] = "";
        }

        if ($tasas_tarifas_dato['cta'] == "SELECCIONAR") {
            $tasas_tarifas_dato['cta'] = "";
        }

        if ($tasas_tarifas_dato['resolucion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['resolucion'] = "";
        }

        if ($tasas_tarifas_dato['archivo_resolucion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['archivo_resolucion'] = "";
        }

        if ($tasas_tarifas_dato['situacion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['situacion'] = "";
        }

        if ($tasas_tarifas_dato['categoria_transaccion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['categoria_transaccion'] = "";
        }

        if ($tasas_tarifas_dato['vigencia'] == "0000-00-00") {
            $tasas_tarifas_dato['vigencia'] = "";
        }

        


        $excelData[] = array(
            $contador = $contador + 1,
            $tasas_tarifas_dato['codigo_pago'],
            $tasas_tarifas_dato['modalidad'],
            $tasas_tarifas_dato['concepto'],
            $tasas_tarifas_dato['monto'],
            $tasas_tarifas_dato['referencia'],
            $tasas_tarifas_dato['clasificador'],
            $tasas_tarifas_dato['codigo_facultad'],
            $tasas_tarifas_dato['dependencia'],
            $tasas_tarifas_dato['codigo_ser_banco'],
            $tasas_tarifas_dato['cta'],
            $tasas_tarifas_dato['resolucion'],
            $tasas_tarifas_dato['archivo_resolucion'],
            $tasas_tarifas_dato['vigencia'],
            $tasas_tarifas_dato['situacion'],
            $tasas_tarifas_dato['categoria_transaccion'],
            $tasas_tarifas_dato['observacion'],
            $tasas_tarifas_dato['fyh_creacion_tyt'],
            $tasas_tarifas_dato['fyh_actualizacion_tyt'],
            $tasas_tarifas_dato['nombres'] . " " . $tasas_tarifas_dato['apaterno'] . " " . $tasas_tarifas_dato['amaterno']
        );


    }
}


//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);
exit();