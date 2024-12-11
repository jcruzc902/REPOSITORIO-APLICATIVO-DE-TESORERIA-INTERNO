<?php
include('../../config.php');

require('../../librerias/FPDF/fpdf.php');

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
    detalle_egresos.fyh_creacion as fyh_creacion_detalle,
    detalle_egresos.ingresos as ingresos,
    egresos.fyh_creacion as fyh_creacion_egreso 
    FROM tb_egresos as egresos 
    LEFT JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado 
    LEFT JOIN tb_detalle_egresos as detalle_egresos ON (detalle_egresos.facultad=egresos.cargo_facultad 
    AND detalle_egresos.actividad_principal=egresos.actividad_principal AND detalle_egresos.subactividad=egresos.subactividad 
    AND detalle_egresos.periodo=egresos.anio) 
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

    $sql_egresos .= " ORDER BY detalle_egresos.fyh_creacion ASC"; //ordena el nombre del banco en forma ascendente

    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);
}

class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../../../public/images/logo2_unfv.jpg', 15, 8, 70);

        $this->SetY(10);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha:')); //texto

        $this->SetY(10);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(170); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('d/m/Y'))); //texto

        $this->SetY(15);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Hora:')); //texto

        $this->SetY(15);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(173); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(60); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE ESTADO DE EGRESOS')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Entidad:')); //texto

        $this->SetY(40);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('UNIVERSIDAD NACIONAL FEDERICO VILLAREAL')); //texto

        $this->SetY(45);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('RUC:')); //texto

        $this->SetY(45);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('20170934289')); //texto

        $this->SetY(50);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Dirección:')); //texto

        $this->SetY(50);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('JR. CARLOS GONZALES 285 URB. MARANGA - SAN MIGUEL')); //texto

        $this->SetY(55);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Organo:')); //texto

        $this->SetY(55);
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(20); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('DIRECCION GENERAL DE ADMINISTRACIÓN - OFICINA DE TESORERÍA')); //texto

        $this->Line(10, 65, 200, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(10); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Facultad')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(32); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('NT-Año')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(52); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Proveido(CONT)')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(77); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Proveido(DIGA)')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(103); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Resolución')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(125); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('SIAF')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(147); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Monto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(168); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Egresos')); //texto

        $this->Line(10, 75, 200, 75); //LINEA





        $this->Ln(12); //salto de linea

    }

    public function footer()
    {
        $this->SetY(-15); //salto de linea
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Oficina de Tesorería')); //texto

        $this->SetY(-15); //salto de linea
        $this->AliasNbPages('tpagina');
        $this->SetFont('Arial', '', 8); //fuente
        $this->Cell(180); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . '/tpagina')); //texto
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

if (!isset($egresos_datos)) {
    $egresos_datos = '';
} else {
    foreach ($egresos_datos as $egresos_dato) {


        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(14, 5, utf8_decode($i));

        switch($egresos_dato["cargo_facultad"]){
            case "CENTRO PREUNIVERSITARIO DE LA UNIVERSIDAD NACIONAL FEDERICO VILLARREAL": $egresos_dato["cargo_facultad"]="CEPREVI";break;
            case "CENTRO DE GESTIÓN CULTURAL FEDERICO VILLARREAL": $egresos_dato["cargo_facultad"]="CGCFV";break;
            case "CENTRO UNIVERSITARIO DE IDIOMAS": $egresos_dato["cargo_facultad"]="CUDI";break;
            case "CENTRO DE PRODUCCIÓN DE BIENES Y SERVICIOS": $egresos_dato["cargo_facultad"]="CUPBS";break;
            case "CENTRO UNIVERSITARIO DE RESPONSABILIDAD SOCIAL": $egresos_dato["cargo_facultad"]="CURES";break;
            case "EDITORIAL UNIVERSITARIA": $egresos_dato["cargo_facultad"]="EU";break;
            case "ESCUELA UNIVERSITARIA DE EDUCACION A DISTANCIA": $egresos_dato["cargo_facultad"]="EUDED";break;
            case "ESCUELA UNIVERSITARIA DE POSTGRADO": $egresos_dato["cargo_facultad"]="EUPG";break;
            case "FACULTAD DE ADMINISTRACIÓN": $egresos_dato["cargo_facultad"]="FA";break;
            case "FACULTAD DE PSICOLOGIA": $egresos_dato["cargo_facultad"]="FAPS";break;
            case "FACULTAD DE ARQUITECTURA Y URBANISMO": $egresos_dato["cargo_facultad"]="FAU";break;
            case "FACULTAD DE CIENCIAS SOCIALES": $egresos_dato["cargo_facultad"]="FCCSS";break;
            case "FACULTAD DE CIENCIAS ECONOMICAS": $egresos_dato["cargo_facultad"]="FCE";break;
            case "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES": $egresos_dato["cargo_facultad"]="FCFC";break;
            case "FACULTAD DE CIENCIAS NATURALES Y MATEMATICA": $egresos_dato["cargo_facultad"]="FCNM";break;
            case "FACULTAD DE DERECHO Y CIENCIA POLITICA": $egresos_dato["cargo_facultad"]="FDCP";break;
            case "FACULTAD DE EDUCACION": $egresos_dato["cargo_facultad"]="FE";break;
            case "FACULTAD DE HUMANIDADES": $egresos_dato["cargo_facultad"]="FH";break;
            case "FACULTAD DE INGENIERIA CIVIL": $egresos_dato["cargo_facultad"]="FIC";break;
            case "FACULTAD DE INGENIERIA ELECTRONICA E INFORMATICA": $egresos_dato["cargo_facultad"]="FIEI";break;
            case "FACULTAD DE INGENIERIA GEOGRAFICA, AMBIENTAL Y ECOTURISMO": $egresos_dato["cargo_facultad"]="FIGAE";break;
            case "FACULTAD DE INGENIERIA INDUSTRIAL Y DE SISTEMAS": $egresos_dato["cargo_facultad"]="FIIS";break;
            case "FACULTAD DE MEDICINA DE HIPOLITO UNANUE": $egresos_dato["cargo_facultad"]="FMHU";break;
            case "FACULTAD DE ODONTOLOGIA": $egresos_dato["cargo_facultad"]="FO";break;
            case "FACULTAD DE OCEANOGRAFIA, PESQUERIA Y CC.AA.": $egresos_dato["cargo_facultad"]="FOPCA";break;
            case "FACULTAD DE TECNOLOGIA MEDICA": $egresos_dato["cargo_facultad"]="FTM";break;
            case "FACULTADES": $egresos_dato["cargo_facultad"]="FACULT.";break;
            case "INSTITUTO CENTRAL DE GESTION DE LA INVESTIGACION": $egresos_dato["cargo_facultad"]="ICGI";break;
            case "INSTITUTO DE RECREACION, EDUCACION FISICA Y DEPORTE": $egresos_dato["cargo_facultad"]="IRED";break;
            case "OFICINA CENTRAL DE ADMISION": $egresos_dato["cargo_facultad"]="OCA";break;
            case "OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO": $egresos_dato["cargo_facultad"]="OCBU";break;
            case "OFICINA CENTRAL DE REGISTRO ACADEMICO": $egresos_dato["cargo_facultad"]="OCRAC";break;
            case "OFICINA CENTRAL DE LOGISTICA Y SERVICIOS AUXILIARES": $egresos_dato["cargo_facultad"]="OCLSA";break;
            case "OFICINA DE TESORERIA": $egresos_dato["cargo_facultad"]="OT";break;
            case "SECRETARIA GENERAL": $egresos_dato["cargo_facultad"]="SG";break;
            case "VICE-RECTORADO DE INVESTIGACION": $egresos_dato["cargo_facultad"]="VRIN";break;
    
        }

        $pdf->Cell(8, 5, utf8_decode($egresos_dato["cargo_facultad"]),null,null,'R');
        $pdf->Cell(22, 5, utf8_decode($egresos_dato["nt"] . '-' . $egresos_dato["anio_nt"]),null,null,'R');
        $pdf->Cell(30, 5, utf8_decode($egresos_dato["proveido_contabilidad"]),null,null,'R');
        $pdf->Cell(25, 5, utf8_decode($egresos_dato["proveido_diga"]),null,null,'R');
        $pdf->Cell(20, 5, utf8_decode($egresos_dato["resolucion"]),null,null,'R');
        $pdf->Cell(14, 5, utf8_decode($egresos_dato["siaf"]),null,null,'R');

        $egresos_monto_dato = number_format($egresos_dato["monto"], 2, '.', ','); //convertir int a decimal
        $importe_total = $importe_total + $egresos_dato["monto"];


        $pdf->Cell(23, 5, utf8_decode($egresos_monto_dato),null,null,'R');

        $egresos_dato["egresos"] = number_format($egresos_dato["egresos"], 2, '.', ','); //convertir int a decimal

        $pdf->Cell(25, 5, utf8_decode($egresos_dato["egresos"]),null,null,'R');


        $i++;
        $pdf->Ln();
    }



    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto


    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

    $importe_total = number_format($importe_total, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(140); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto

}

$pdf->Output('Reporte de Estado de Cuenta.pdf', 'I');