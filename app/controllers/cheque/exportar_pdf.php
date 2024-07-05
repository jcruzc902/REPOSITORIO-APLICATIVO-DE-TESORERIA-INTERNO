<?php
include ('../../config.php');

require ('../../librerias/FPDF/fpdf.php');

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
        $this->Cell(70); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE CHEQUES')); //texto

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
        $this->Cell(12); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('NT')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(32); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Proveido')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(52); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(68); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Tipo de Gasto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(93); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N° Cheque')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(113); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha Emision')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(145); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Monto')); //texto
        

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(165); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('F. Registro')); //texto

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
$importe_total=0;

if (!isset($cheques_datos)) {
    $cheques_datos = '';
} else {
    foreach ($cheques_datos as $cheques_dato) {

        $pdf->SetFont('Arial', '', 8); //fuente

        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(9, 5, utf8_decode($i));

        $pdf->Cell(22, 5, utf8_decode($cheques_dato["numero_tramite"] . '-' . $cheques_dato["nt_anio"]));
        $pdf->Cell(18, 5, utf8_decode($cheques_dato["proveido_diga"]));

        $theDate = new DateTime($cheques_dato['fecha_diga']);
        $cheques_dato['fecha_diga'] = $theDate->format('d/m/Y');
        $pdf->Cell(20, 5, utf8_decode($cheques_dato["fecha_diga"]));

        $pdf->Cell(23, 5, utf8_decode($cheques_dato["nombre_tipo_gasto"]));

        $pdf->Cell(22, 5, utf8_decode($cheques_dato["nro_cheque"]));

        $theDate = new DateTime($cheques_dato['fecha_emision_cheque']);
        $cheques_dato['fecha_emision_cheque'] = $theDate->format('d/m/Y');

        $pdf->Cell(30, 5, utf8_decode($cheques_dato["fecha_emision_cheque"]));

        $pdf->Cell(20, 5, utf8_decode($cheques_dato["monto"]));

        $importe_total= $importe_total+$cheques_dato["monto"]; //suma monto de cheques para el total

        $theDate = new DateTime($cheques_dato['fyh_creacion_detalle']);
        $cheques_dato['fyh_creacion_detalle'] = $theDate->format('d/m/Y');

        $pdf->Cell(25, 5, utf8_decode($cheques_dato["fyh_creacion_detalle"]));

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

    $importe_total=  number_format($importe_total,2,'.',''); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(141); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. '.$importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto

}

$pdf->Output('Reporte de Cheques.pdf', 'I');