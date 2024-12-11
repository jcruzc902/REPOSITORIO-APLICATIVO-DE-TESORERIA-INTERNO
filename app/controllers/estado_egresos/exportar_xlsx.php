<?php
include('../../config.php');
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




$fileName = "REPORTE DE ESTADO DE CUENTA " . date('d-m-Y H:i:s') . ".xlsx";

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
    ->setCellValue('B1', "REPORTE DE ESTADO DE EGRESOS - OFICINA DE TESORERIA");

//merge heading
$spreadsheet->getActiveSheet()->mergeCells("B1:AH1");

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


//header text
$spreadsheet->getActiveSheet()
    ->setCellValue('A2', "ID")
    ->setCellValue('B2', "FACULTAD")
    ->setCellValue('C2', "ACTIVIDAD PRINCIPAL")
    ->setCellValue('D2', "SUBACTIVIDAD")
    ->setCellValue('E2', "PERIODO")
    ->setCellValue('F2', "ESTADO")
    ->setCellValue('G2', "OBSERVACION EGRESO")
    ->setCellValue('H2', "NT")
    ->setCellValue('I2', "ANIO NT")
    ->setCellValue('J2', "PROVEIDO CONT")
    ->setCellValue('K2', "FECHA CONT")
    ->setCellValue('L2', "PROVEIDO DIGA")
    ->setCellValue('M2', "FECHA DIGA")
    ->setCellValue('N2', "OFICIO")
    ->setCellValue('O2', "FECHA OFICIO")
    ->setCellValue('P2', "DETALLE")
    ->setCellValue('Q2', "NRO ORDEN COMPRA")
    ->setCellValue('R2', "NRO ORDEN SERVICIO")
    ->setCellValue('S2', "SIAF")
    ->setCellValue('T2', "MONTO")
    ->setCellValue('U2', "COMPROBANTE DE PAGO")
    ->setCellValue('V2', "FECHA DE PAGO")
    ->setCellValue('W2', "FECHA DE GIRO")
    ->setCellValue('X2', "ASUNTO")
    ->setCellValue('Y2', "INFORME")
    ->setCellValue('Z2', "FECHA DE INFORME")
    ->setCellValue('AA2', "RESOLUCION")
    ->setCellValue('AB2', "FECHA DE RESOLUCION")
    ->setCellValue('AC2', "EGRESOS")
    ->setCellValue('AD2', "INGRESOS")
    ->setCellValue('AE2', "OBSERVACION NT")
    ->setCellValue('AF2', "FECHA REGISTRO")
    ->setCellValue('AG2', "FECHA ACTUALIZACION")
    ->setCellValue('AH2', "USUARIO");




//set font style and background color
$spreadsheet->getActiveSheet()->getStyle('A2:AH2')->applyFromArray($tableHead); //estilo de fondo en la cabecera
$spreadsheet->getActiveSheet()->getStyle('A2:AH2')->getAlignment()->setHorizontal('center'); //alineacion cental
$spreadsheet->getActiveSheet()->freezePane('A3'); //Congela la pantalla


$styleArray = [

    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

$spreadsheet->getActiveSheet()->getStyle('A2:AH2')->applyFromArray($styleArray);


#BASE DE DATOS
$contador = 0;
session_start();

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

if (isset($_SESSION['busqueda_anio_egreso'])) {
    $anio_egreso = $_SESSION['busqueda_anio_egreso'];
} else {
    $anio_egreso = "";
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
    egresos.cargo_facultad as cargo_facultad,
    egresos.actividad_principal	 as actividad_principal,
    egresos.subactividad as subactividad,
    egresos.anio as anio_egreso,
    egresos.id_estado as id_estado_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    egresos.observacion_egreso as observacion_egreso,
    detalle_egresos.nt as nt,
    anios.anio_nt as anio_nt,
    detalle_egresos.proveido_contabilidad as proveido_contabilidad,
    detalle_egresos.fecha_proveido_contabilidad as fecha_proveido_contabilidad,
    detalle_egresos.proveido_diga as proveido_diga,
    detalle_egresos.fecha_diga as fecha_diga,
    detalle_egresos.oficio as oficio,
    detalle_egresos.fecha_oficio as fecha_oficio,
    detalle_egresos.detalle as detalle,
    detalle_egresos.nro_orden_compra as nro_orden_compra,
    detalle_egresos.nro_orden_servicio as nro_orden_servicio,
    detalle_egresos.siaf as siaf,
    detalle_egresos.monto as monto,
    detalle_egresos.comprobante_pago as comprobante_pago,
    detalle_egresos.fecha_pago as fecha_pago,
    detalle_egresos.fecha_giro as fecha_giro,
    detalle_egresos.asunto as asunto,
    detalle_egresos.informe as informe,
    detalle_egresos.fecha_informe as fecha_informe,
    detalle_egresos.resolucion as resolucion,
    detalle_egresos.fecha_resolucion as fecha_resolucion,
    detalle_egresos.egresos as egresos,
    detalle_egresos.ingresos as ingresos,
    detalle_egresos.observacion as observacion_detalle,
    detalle_egresos.fyh_creacion as fyh_creacion_detalle,
    detalle_egresos.fyh_actualizacion as fyh_actualizacion_detalle,
    usuario.nombres as nombre_usuario,
    usuario.apaterno as apaterno_usuario,
    usuario.amaterno as amaterno_usuario, 
    egresos.fyh_creacion as fyh_creacion_egreso 
    FROM tb_egresos as egresos 
    LEFT JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado 
    LEFT JOIN tb_detalle_egresos as detalle_egresos ON (detalle_egresos.facultad=egresos.cargo_facultad AND detalle_egresos.actividad_principal=egresos.actividad_principal AND detalle_egresos.subactividad=egresos.subactividad AND detalle_egresos.periodo=egresos.anio) 
    LEFT JOIN tb_usuarios as usuario ON usuario.id_usuario= detalle_egresos.id_usuario
    LEFT JOIN tb_anio_nt as anios ON anios.id_anio_nt= detalle_egresos.anio_nt 
    WHERE egresos.visible!=1 ";

if (isset($_SESSION['busqueda_boton_egresos'])) {
    if (
        !isset($anio_egreso) && !isset($cargo) && !isset($actividad_principal) && !isset($subactividad) && !isset($estado) && !isset($desde) && !isset($hasta)
    ) {
        $sql_egresos .= " ";
    } else {

        if (!empty($anio_egreso)) {
            $sql_egresos .= " AND egresos.anio='" . $anio_egreso . "'";
        }

        if (!empty($cargo)) {
            $sql_egresos .= " AND egresos.cargo_facultad='" . $cargo . "'";
        }

        if (!empty($actividad_principal)) {
            $sql_egresos .= " AND egresos.actividad_principal='" . $actividad_principal . "'";
        }

        if (!empty($subactividad)) {
            $sql_egresos .= " AND egresos.subactividad='" . $subactividad . "'";
        }

        if (!empty($estado)) {
            $sql_egresos .= " AND egresos.id_estado='" . $estado . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_egresos .= " AND egresos.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }

    $sql_egresos .= " ORDER BY egresos.fyh_creacion ASC"; //ordena el nombre del banco en forma ascendente

    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($egresos_datos)) {
    $egresos_datos = '';
} else {
    $row = 3;
    foreach ($egresos_datos as $egresos_dato) {



        if ($egresos_dato['fecha_informe'] != "0000-00-00") {
            $theDate = new DateTime($egresos_dato['fecha_informe']);
            $fecha_informe_anio = $theDate->format('Y');
        }



        $spreadsheet->getActiveSheet()
            ->setCellValue('A' . $row, $contador = $contador + 1, )
            ->setCellValue('B' . $row, $egresos_dato['cargo_facultad'])
            ->setCellValue('C' . $row, $egresos_dato['actividad_principal'])
            ->setCellValue('D' . $row, $egresos_dato['subactividad'])
            ->setCellValue('E' . $row, $egresos_dato['anio_egreso'])
            ->setCellValue('F' . $row, $egresos_dato['estado_egreso'])
            ->setCellValue('G' . $row, $egresos_dato['observacion_egreso'])
            ->setCellValue('H' . $row, $egresos_dato['nt'])
            ->setCellValue('I' . $row, $egresos_dato['anio_nt'])
            ->setCellValue('J' . $row, $egresos_dato['proveido_contabilidad'] . "-OC-UNFV")
            ->setCellValue('K' . $row, $egresos_dato['fecha_proveido_contabilidad'])
            ->setCellValue('L' . $row, $egresos_dato['proveido_diga'] . "-DIGA-UNFV")
            ->setCellValue('M' . $row, $egresos_dato['fecha_diga'])
            ->setCellValue('N' . $row, $egresos_dato['oficio'])
            ->setCellValue('O' . $row, $egresos_dato['fecha_oficio'])
            ->setCellValue('P' . $row, $egresos_dato['detalle'])
            ->setCellValue('Q' . $row, $egresos_dato['nro_orden_compra'])
            ->setCellValue('R' . $row, $egresos_dato['nro_orden_servicio'])
            ->setCellValue('S' . $row, $egresos_dato['siaf'])
            ->setCellValue('T' . $row, $egresos_dato['monto'])
            ->setCellValue('U' . $row, $egresos_dato['comprobante_pago'])
            ->setCellValue('V' . $row, $egresos_dato['fecha_pago'])
            ->setCellValue('W' . $row, $egresos_dato['fecha_giro'])
            ->setCellValue('X' . $row, $egresos_dato['asunto'])
            ->setCellValue('Y' . $row, $egresos_dato['informe'] . "-".$fecha_informe_anio."-E-OT-DIGA-UNFV")
            ->setCellValue('Z' . $row, $egresos_dato['fecha_informe'])
            ->setCellValue('AA' . $row, $egresos_dato['resolucion'] . "-CU-UNFV")
            ->setCellValue('AB' . $row, $egresos_dato['fecha_resolucion'])
            ->setCellValue('AC' . $row, $egresos_dato['egresos'])
            ->setCellValue('AD' . $row, $egresos_dato['ingresos'])
            ->setCellValue('AE' . $row, $egresos_dato['observacion_detalle'])
            ->setCellValue('AF' . $row, $egresos_dato['fyh_creacion_egreso'])
            ->setCellValue('AG' . $row, $egresos_dato['fyh_actualizacion_detalle'])
            ->setCellValue('AH' . $row, $egresos_dato['nombre_usuario'] . " " . $egresos_dato['apaterno_usuario'] . " " . $egresos_dato['amaterno_usuario']);

        //Convierte en formato decimal
        $currencyMask = new Currency(
            '',
            2,
            Number::WITH_THOUSANDS_SEPARATOR,
            Currency::TRAILING_SYMBOL,
            Currency::SYMBOL_WITH_SPACING
        );

        $value = $egresos_dato['monto'];
        $spreadsheet->getActiveSheet()->setCellValue('T' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('T' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['egresos'];
        $spreadsheet->getActiveSheet()->setCellValue('AC' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AC' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['ingresos'];
        $spreadsheet->getActiveSheet()->setCellValue('AD' . $row, $value);
        $spreadsheet->getActiveSheet()->getStyle('AD' . $row)
            ->getNumberFormat()
            ->setFormatCode($currencyMask);

        $value = $egresos_dato['fecha_proveido_contabilidad'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('K' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        //Convierte en formato fecha
        $value = $egresos_dato['fecha_diga'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('M' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('M' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');


        $value = $egresos_dato['fecha_pago'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('V' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('V' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_giro'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('W' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('W' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_oficio'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('O' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('O' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');


        $value = $egresos_dato['fecha_informe'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('Z' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('Z' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fecha_resolucion'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AB' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AB' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY');

        $value = $egresos_dato['fyh_creacion_egreso'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AF' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AF' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');

        $value = $egresos_dato['fyh_actualizacion_detalle'];
        $dateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value);
        $dateValue = str_replace('FALSO', '', $dateValue);
        $spreadsheet->getActiveSheet()->setCellValue('AG' . $row, $dateValue);
        $spreadsheet->getActiveSheet()->getStyle('AG' . $row)
            ->getNumberFormat()
            ->setFormatCode('dd/mm/YYYY HH:mm:ss');




        //set row style
        if ($row % 2 == 0) {
            //even row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($evenRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->getAlignment()->setHorizontal('left');
        } else {
            //odd row
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($oddRow);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':AH' . $row)->getAlignment()->setHorizontal('left');
        }
        //increment row
        $row++;


    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row - 1;
    //set the autofilter
    $spreadsheet->getActiveSheet()->setAutoFilter("A" . $firstRow . ":AH" . $lastRow); //Establecer filtros en las columnas
}

//set the header first, so the result will be treated as an xlsx file.
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//make it an attachment so we can define filename
header('Content-Disposition: attachment;filename=' . $fileName . '');

//create IOFactory object
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//save into php output
$writer->save('php://output');

