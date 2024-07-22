<?php

include ('../app/config.php');
include ('../layout/sesion.php');


include ('../app/controllers/egreso/show_egreso.php');


require ('../app/librerias/FPDF/fpdf.php');



class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../public/images/logo_unfv2.png', 35, 10, 50);



        $this->SetY(30);
        $this->SetFont('Times', 'B', 12); //fuente
        $this->Cell(70); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('OFICINA DE TESORERÍA')); //texto

        $this->SetY(38);
        $this->SetFont('Times', '', 10); //fuente
        $this->Cell(25); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('"Año del Bicentenario, de la consolidación de nuestra Independencia, y de la conmemoración de las')); //texto

        $this->SetY(42);
        $this->SetFont('Times', '', 10); //fuente
        $this->Cell(70); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('heroicas batallas de Junín y Ayacucho"')); //texto


        $this->SetY(43);
        $this->SetTextColor(255, 95, 3);  // Establece el color del texto (en este caso es blanco)
        $this->SetFont('Times', 'U', 10); //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('                                                                                                                                                                               ')); //texto





        $this->Ln(7); //salto de linea

    }

    public function footer()
    {
        $this->SetY(-35);
        $this->SetTextColor(0, 0, 0);  // Establece el color del texto (en este caso es blanco)
        $this->SetFont('Times', 'U', 10); //fuente
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('                                                                                                                                                                               ')); //texto


        $this->SetY(-24); //salto de linea
        $this->SetFont('Times', '', 10); //fuente
        $this->Cell(24); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Calle Carlos Gonzales n°285 - Maranga - San Miguel - Central Telefónica: 7480888, anexo 9174')); //texto


    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$theDate = new DateTime($fecha_informe);
$anio_fecha_informe = $theDate->format('Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'BIU', 12);  //fuente
$pdf->Cell(37); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('INFORME DE EGRESOS N.° ' . $informe . '-' . $anio_fecha_informe . '-E-OT-DIGA-UNFV')); //texto

$pdf->Ln(20); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('A')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(45); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(': LIC. PATHERSON CABANILLAS CIEZA')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Jefe de la Oficina de Tesorería')); //texto

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('ASUNTO             :')); //texto

$pdf->Ln(3); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->MultiCell(120, 5, utf8_decode($asunto_conta . '')); //texto

$pdf->Ln(-2); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nombre_cargo)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode($nombre_actividad)); //texto

if ($nombre_subactividad != "NO") {
    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'BI', 9);  //fuente
    $pdf->Cell(47); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode($nombre_subactividad)); //texto
}

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('REFERENCIA')); //texto

$theDate = new DateTime($fecha_diga);
$anio_fecha_diga = $theDate->format('Y');

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(45); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(': PROVEIDO N°' . $proveido_diga . '-' . $anio_fecha_diga . '-DIGA-UNFV')); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(47); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('OFICIO N°' . $oficio_dependencia)); //texto

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(20); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('FECHA')); //texto

$theDateX = new DateTime($fecha_informe);
$dia_fecha_informe = $theDateX->format('d');

$theDateY = new DateTime($fecha_informe);
$mes_fecha_informe = $theDateY->format('m');

$theDateZ = new DateTime($fecha_informe);
$anio_fecha_informe = $theDateZ->format('Y');

$dia = $dia_fecha_informe;
$mes = $mes_fecha_informe;
$anio = $anio_fecha_informe;

switch ($mes) {
    case '01':
        $mes = 'enero';
        break;
    case '02':
        $mes = 'febrero';
        break;
    case '03':
        $mes = 'marzo';
        break;
    case '04':
        $mes = 'abril';
        break;
    case '05':
        $mes = 'mayo';
        break;
    case '06':
        $mes = 'junio';
        break;
    case '07':
        $mes = 'julio';
        break;
    case '08':
        $mes = 'agosto';
        break;
    case '09':
        $mes = 'setiembre';
        break;
    case '10':
        $mes = 'octubre';
        break;
    case '11':
        $mes = 'noviembre';
        break;
    case '12':
        $mes = 'diciembre';
        break;
}

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(45); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode(': ' . $dia . " de " . $mes . " del " . $anio . '')); //texto

$pdf->Ln(0); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(125); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('NT: ' . $nt_diga)); //texto

$pdf->Ln(5);
$pdf->SetFont('Times', 'U', 10); //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                               ')); //texto

$theDate = new DateTime($fecha_resolucion);
$anio_fecha_resolucion = $theDate->format('Y');

$theDateX = new DateTime($fecha_resolucion);
$dia_resolucion = $theDateX->format('d');

$theDateY = new DateTime($fecha_resolucion);
$mes_resolucion = $theDateY->format('m');

$theDateZ = new DateTime($fecha_resolucion);
$anio_resolucion = $theDateZ->format('Y');

$pdf->Ln(10); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->MultiCell(158, 5, utf8_decode('Por medio del presente se informan los egresos referentes a ' . mb_convert_case($nombre_actividad, MB_CASE_TITLE, "UTF-8") . ', en mérito a la Resolución Rectoral Nº' . $resolucion_directoral . '-' . $anio_fecha_resolucion . '-CU-UNFV del ' . $dia_resolucion . '.' . $mes_resolucion . '.' . $anio_resolucion . ' el cual es el siguiente:')); //texto

$total_acumulado = number_format($total_acumulado, 2, '.', ','); //convertir int a decimal

$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', 'IB', 12);  //fuente
$pdf->Cell(85); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('TOTAL, EGRESOS ===> S/ ' . $total_acumulado . '')); //texto

$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', 'I', 10);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('')); //texto

$pdf->Ln(15); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(120); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Atentamente;')); //texto

$pdf->Ln(15); //salto de linea
$pdf->SetFont('Times', '', 11); //fuente
$pdf->Cell(115); //mover a la derecha
$pdf->Cell(40, 10, $pdf->Image('../public/images/firma_ysavel.png', null, null, 30)); //texto

$pdf->Ln(5); //salto de linea
$pdf->SetFont('Arial', 'I', 9);  //fuente
$pdf->Cell(107); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('C.P. MARIA Y. AQUINO ROMERO')); //texto

$pdf->Ln(12); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('PCC/MAR')); //texto

$pdf->Ln(3); //salto de linea
$pdf->SetFont('Arial', 'BI', 9);  //fuente
$pdf->Cell(15); //mover a la derecha
$pdf->Cell(40, 10, utf8_decode('Adjunto: (folios)')); //texto

$pdf->Output('INFORME DE EGRESOS NRO. ' . $informe . '-' . $anio_fecha_informe . '-E-OT-DIGA-UNFV.pdf', 'I');