<?php
include ('../../config.php');
//call the autoload
require '../../../vendor/autoload.php';

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Number;



$fileName = "REPORTE DE EGRESOS " . date('d-m-Y H:i:s') . ".xlsx";

//styling arrays
//table head style
$tableHead = [
    'font' => [
        'color' => [
            'rgb' => 'FFFFFF'
        ],
        'bold' => true,
        'size' => 11
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => '000000'
        ]
    ],
];
//even row
$evenRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFF8D2'
        ]
    ]
];
//odd row
$oddRow = [
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'rgb' => 'FFFBE5'
        ]
    ]
];

//styling arrays end

//make a new spreadsheet object
$spreadsheet = new Spreadsheet();
//get current active sheet (first sheet)
$sheet = $spreadsheet->getActiveSheet();

//set default font
$spreadsheet->getDefaultStyle()
    ->getFont()
    ->setName('Arial')
    ->setSize(10);

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('logo');
$drawing->setDescription('logo');
$drawing->setPath('../../../public/images/logo2_unfv.jpg'); // put your path and image here
$drawing->setCoordinates('A1');
$drawing->getShadow()->setVisible(true);
$drawing->setWidth(147);
$drawing->setWorksheet($spreadsheet->getActiveSheet());

//heading
$spreadsheet->getActiveSheet()
    ->setCellValue('B1', "REPORTE DE EGRESOS - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:AN1");

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setSize(30);

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setName('Cambria');

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE));

// set font style
$spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);

// set cell alignment
$spreadsheet->getActiveSheet()->getStyle('B1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

//setting column width
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(21);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('V')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('W')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('X')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Y')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AA')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AB')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AC')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AD')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AE')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AF')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AG')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AH')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AI')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AJ')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AK')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AL')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AM')->setWidth(40);
$spreadsheet->getActiveSheet()->getColumnDimension('AN')->setWidth(40);


//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "NT")
    ->setCellValue('C2', "AÑO")
    ->setCellValue('D2', "PROVEIDO (DIGA)")
    ->setCellValue('E2', "FECHA")
    ->setCellValue('F2', "PROVEIDO (CONTABILIDAD)")
    ->setCellValue('G2', "FECHA")
    ->setCellValue('H2', "ASUNTO")
    ->setCellValue('I2', "SIAF")
    ->setCellValue('J2', "TIPO DE GASTO")
    ->setCellValue('K2', "OFICIO")
    ->setCellValue('L2', "FECHA")
    ->setCellValue('M2', "CARGO")
    ->setCellValue('N2', "ACTIVIDAD PRINCIPAL")
    ->setCellValue('O2', "SUBACTIVIDAD")
    ->setCellValue('P2', "AÑO")
    ->setCellValue('Q2', "MONTO")
    ->setCellValue('R2', "CONCEPTO GIRO")
    ->setCellValue('S2', "MODALIDAD PAGO")
    ->setCellValue('T2', "PROVEEDOR")
    ->setCellValue('U2', "RUC")
    ->setCellValue('V2', "N° ORDEN COMPRA")
    ->setCellValue('W2', "N° ORDEN SERVICIO")
    ->setCellValue('X2', "TIPO COMPROBANTE")
    ->setCellValue('Y2', "N° COMPROBANTE")
    ->setCellValue('Z2', "N° COMPROBANTE INTERNO")
    ->setCellValue('AA2', "NOTA DE PAGO")
    ->setCellValue('AB2', "FECHA DE GIRO")
    ->setCellValue('AC2', "FECHA DE PAGO")
    ->setCellValue('AD2', "INFORME")
    ->setCellValue('AE2', "FECHA INFORME")
    ->setCellValue('AF2', "N° RESOLUCION RECTORAL")
    ->setCellValue('AG2', "FECHA RESOLUCION R.")
    ->setCellValue('AH2', "TOTAL EGRESOS")
    ->setCellValue('AI2', "TOTAL ACUMULADO")
    ->setCellValue('AJ2', "ESTADO")
    ->setCellValue('AK2', "OBSERVACION")
    ->setCellValue('AL2', "FECHA REGISTRO")
    ->setCellValue('AM2', "FECHA ACTUALIZACION")
    ->setCellValue('AN2', "USUARIO");

//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:AN2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:AN2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:AN2')->applyFromArray($styleArray);


#BASE DE DATOS
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
    $siaf = $_SESSION['busqueda_siaf'];
} else {
    $siaf = "";
}

if (isset($_SESSION['busqueda_tipo_gasto'])) {
    $tipo_gasto = $_SESSION['busqueda_tipo_gasto'];
} else {
    $tipo_gasto = "";
}

if (isset($_SESSION['busqueda_siaf'])) {
    $siaf = $_SESSION['busqueda_siaf'];
} else {
    $siaf = "";
}

if (isset($_SESSION['busqueda_concepto_giro'])) {
    $concepto_giro = $_SESSION['busqueda_concepto_giro'];
} else {
    $concepto_giro = "";
}

if (isset($_SESSION['busqueda_modalidad_pago'])) {
    $modalidad_pago = $_SESSION['busqueda_modalidad_pago'];
} else {
    $modalidad_pago = "";
}

if (isset($_SESSION['busqueda_cargo'])) {
    $cargo = $_SESSION['busqueda_cargo'];
} else {
    $cargo = "";
}

if (isset($_SESSION['busqueda_actividad_principal'])) {
    $actividad_principal = $_SESSION['busqueda_actividad_principal'];
} else {
    $actividad_principal = "";
}

if (isset($_SESSION['busqueda_subactividad'])) {
    $subactividad = $_SESSION['busqueda_subactividad'];
} else {
    $subactividad = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
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
    $row = 3;
    foreach ($egresos_datos as $egresos_dato) {

        if ($egresos_dato['fecha_diga'] == "0000-00-00") {
            $egresos_dato['fecha_diga'] = "";
        }

        if ($egresos_dato['fecha_diga'] == "0000-00-00") {
            $fecha_diga_anio = "";
        } else {
            $theDate = new DateTime($egresos_dato['fecha_diga']);
            $fecha_diga_anio = $theDate->format('Y');
        }

        if ($egresos_dato['fecha_conta'] == "0000-00-00") {
            $egresos_dato['fecha_conta'] = "";
        }

        if ($egresos_dato['fecha_conta'] == "0000-00-00") {
            $fecha_conta_anio = "";
        } else {
            $theDate = new DateTime($egresos_dato['fecha_conta']);
            $fecha_conta_anio = $theDate->format('Y');
        }


        if ($egresos_dato['nombre_tipo_gasto'] == "SELECCIONAR") {
            $egresos_dato['nombre_tipo_gasto'] = "";
        }

        if ($egresos_dato['fecha_dependencia'] == "0000-00-00") {
            $egresos_dato['fecha_dependencia'] = "";
        }

        if ($egresos_dato['nombre_concepto_giro'] == "SELECCIONAR") {
            $egresos_dato['nombre_concepto_giro'] = "";
        }

        if ($egresos_dato['nombre_modalidad_pago'] == "SELECCIONAR") {
            $egresos_dato['nombre_modalidad_pago'] = "";
        }

        if ($egresos_dato['nombre_comprobantes'] == "SELECCIONAR") {
            $egresos_dato['nombre_comprobantes'] = "";
        }

        if ($egresos_dato['fecha_giro'] == "0000-00-00") {
            $egresos_dato['fecha_giro'] = "";
        }

        if ($egresos_dato['fecha_pago'] == "0000-00-00") {
            $egresos_dato['fecha_pago'] = "";
        }

        if ($egresos_dato['fecha_informe'] == "0000-00-00") {
            $egresos_dato['fecha_informe'] = "";
        }

        if ($egresos_dato['fecha_informe'] == "0000-00-00") {
            $fecha_informe_anio = "";
        } else {
            $theDate = new DateTime($egresos_dato['fecha_informe']);
            $fecha_informe_anio = $theDate->format('Y');
        }

        if ($egresos_dato['fecha_resolucion'] == "0000-00-00") {
            $egresos_dato['fecha_resolucion'] = "";
        }

        if ($egresos_dato['fecha_resolucion'] == "0000-00-00") {
            $fecha_resolucion_anio = "";
        } else {
            $theDate = new DateTime($egresos_dato['fecha_resolucion']);
            $fecha_resolucion_anio = $theDate->format('Y');
        }

        if ($egresos_dato['fyh_actualizacion_egreso'] == "0000-00-00 00:00:00") {
            $egresos_dato['fyh_actualizacion_egreso'] = "";
        } else {
            $theDate = new DateTime($egresos_dato['fyh_actualizacion_egreso']);
            $egresos_dato['fyh_actualizacion_egreso'] = $theDate->format('d/m/Y H:i:s');
        }

        $egresos_dato['resolucion_directoral'] = str_replace('-2023', '', $egresos_dato['resolucion_directoral']); //reemplaza -2023 por vacio

        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $egresos_dato['nt_diga'])
            ->setCellValue('C' . $row, $egresos_dato['nt_anio'])
            ->setCellValue('D' . $row, $egresos_dato['proveido_diga'] . "-" . $fecha_diga_anio . "-DIGA-UNFV")
            ->setCellValue('E' . $row, $egresos_dato['fecha_diga'])
            ->setCellValue('F' . $row, $egresos_dato['proveido_conta'] . "-" . $fecha_conta_anio . "-OC-UNFV")
            ->setCellValue('G' . $row, $egresos_dato['fecha_conta'])
            ->setCellValue('H' . $row, $egresos_dato['asunto_conta'])
            ->setCellValue('I' . $row, $egresos_dato['siaf'])
            ->setCellValue('J' . $row, $egresos_dato['nombre_tipo_gasto'])
            ->setCellValue('K' . $row, $egresos_dato['oficio_dependencia'])
            ->setCellValue('L' . $row, $egresos_dato['fecha_dependencia'])
            ->setCellValue('M' . $row, $egresos_dato['nombre_cargo'])
            ->setCellValue('N' . $row, $egresos_dato['nombre_actividad'])
            ->setCellValue('O' . $row, $egresos_dato['nombre_subactividad'])
            ->setCellValue('P' . $row, $egresos_dato['anio_periodo'])
            ->setCellValue('Q' . $row, $egresos_dato['monto'])
            ->setCellValue('R' . $row, $egresos_dato['nombre_concepto_giro'])
            ->setCellValue('S' . $row, $egresos_dato['nombre_modalidad_pago'])
            ->setCellValue('T' . $row, $egresos_dato['proveedor'])
            ->setCellValue('U' . $row, $egresos_dato['ruc'])
            ->setCellValue('V' . $row, $egresos_dato['nro_orden_compra'])
            ->setCellValue('W' . $row, $egresos_dato['nro_orden_servicio'])
            ->setCellValue('X' . $row, $egresos_dato['nombre_comprobantes'])
            ->setCellValue('Y' . $row, $egresos_dato['numero_comprobante'])
            ->setCellValue('Z' . $row, $egresos_dato['nro_cp_interno'])
            ->setCellValue('AA' . $row, $egresos_dato['nota_pago'])
            ->setCellValue('AB' . $row, $egresos_dato['fecha_giro'])
            ->setCellValue('AC' . $row, $egresos_dato['fecha_pago'])
            ->setCellValue('AD' . $row, $egresos_dato['informe'] . "-" . $fecha_informe_anio . "-E-OT-DIGA-UNFV")
            ->setCellValue('AE' . $row, $egresos_dato['fecha_informe'])
            ->setCellValue('AF' . $row, $egresos_dato['resolucion_directoral'] . "-" . $fecha_resolucion_anio . "-CU-UNFV")
            ->setCellValue('AG' . $row, $egresos_dato['fecha_resolucion'])
            ->setCellValue('AH' . $row, $egresos_dato['total_egresos'])
            ->setCellValue('AI' . $row, $egresos_dato['total_acumulado'])
            ->setCellValue('AJ' . $row, $egresos_dato['estado_egreso'])
            ->setCellValue('AK' . $row, $egresos_dato['observacion_egreso'])
            ->setCellValue('AL' . $row, $egresos_dato['fyh_creacion_egreso'])
            ->setCellValue('AM' . $row, $egresos_dato['fyh_actualizacion_egreso'])
            ->setCellValue('AN' . $row, $egresos_dato['nombres_usuario'] . " " . $egresos_dato['apaterno_usuario'] . " " . $egresos_dato['amaterno_usuario']);

        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $egresos_dato['monto'];
        $spreadsheet->getActiveSheet()->setCellValue('Q' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('Q' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['total_egresos'];
        $spreadsheet->getActiveSheet()->setCellValue('AH' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AH' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['total_acumulado'];
        $spreadsheet->getActiveSheet()->setCellValue('AI' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AI' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        //Convierte en formato fecha
        $value = $egresos_dato['fecha_diga'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('E' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_conta'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('G' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_dependencia'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('L' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('L' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_giro'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AB' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AB' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_pago'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AC' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AC' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_informe'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AE' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AE' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_resolucion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AG' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AG' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fyh_creacion_egreso'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AL' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AL' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $egresos_dato['fyh_actualizacion_egreso'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AM' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AM' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');




        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AN' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AN' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AN' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AN' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AN' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AN' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }


    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":AN" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

