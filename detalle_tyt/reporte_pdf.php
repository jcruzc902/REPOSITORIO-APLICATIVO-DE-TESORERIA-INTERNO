<?php
include ('../app/config.php');

require ('../app/librerias/FPDF/fpdf.php');

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

if (isset($_SESSION['busqueda_resolucion'])) {
    $resolucion = $_SESSION['busqueda_resolucion'];
} else {
    $resolucion = "";
}

if (isset($_SESSION['busqueda_estado'])) {
    $estado = $_SESSION['busqueda_estado'];
} else {
    $estado = "";
}

$sql_tasas_tarifas = "SELECT detalle_tyt.id_detalle_tyt as id_detalle_tyt,
 detalle_tyt.codigo_pago as codigo_pago,
 detalle_tyt.modalidad as modalidad,
 detalle_tyt.concepto as concepto,
 detalle_tyt.referencia as referencia,
 detalle_tyt.dependencia as dependencia,
 detalle_tyt.resolucion as resolucion,
 detalle_tyt.monto as monto,
 tasas_tarifas.situacion as situacion,
 tasas_tarifas.categoria_transaccion as tipo,
 tasas_tarifas.cta as cta,
 estado_resolucion.nombre_estado_resolucion as nombre_estado_resolucion
 FROM tb_detalle_tyt as detalle_tyt 
 LEFT JOIN tb_estado_resolucion as estado_resolucion ON estado_resolucion.id_estado_resolucion = detalle_tyt.id_estado_resolucion 
 LEFT JOIN tb_tasas_tarifas as tasas_tarifas ON (tasas_tarifas.codigo_pago= detalle_tyt.codigo_pago AND tasas_tarifas.modalidad= detalle_tyt.modalidad AND tasas_tarifas.concepto= detalle_tyt.concepto AND tasas_tarifas.referencia= detalle_tyt.referencia AND tasas_tarifas.dependencia= detalle_tyt.dependencia) 
 WHERE detalle_tyt.visible!=1 AND tasas_tarifas.visible!=1 AND estado_resolucion.nombre_estado_resolucion='APROBADO' AND tasas_tarifas.situacion IN ('INCORPORACION','ACTUALIZACION') ";

if (isset($_SESSION['busqueda_boton_tasas_tarifas'])) {
    if (
        !isset($codigo_pago) && !isset($modalidad) && !isset($concepto) && !isset($referencia) && !isset($dependencia) 
        && !isset($resolucion) && !isset($estado)
    ) {
        $sql_tasas_tarifas .= " ";
    } else {

        if (!empty($codigo_pago)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.codigo_pago like '%" . $codigo_pago . "%'";
        }

        if (!empty($modalidad)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.modalidad='" . $modalidad . "'";
        }

        if (!empty($concepto)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.concepto='" . $concepto . "'";
        }

        if (!empty($referencia)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.referencia='" . $referencia . "'";
        }

        if (!empty($dependencia)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.dependencia='" . $dependencia . "'";
        }

        if (!empty($resolucion)) {
            $sql_tasas_tarifas .= " AND detalle_tyt.resolucion='" . $resolucion . "'";
        }

        if (!empty($estado)) {
            $sql_tasas_tarifas .= " AND estado_resolucion.nombre_estado_resolucion='" . $estado . "'";
        }
    }

    $sql_tasas_tarifas .= " GROUP BY detalle_tyt.codigo_pago,detalle_tyt.modalidad,detalle_tyt.concepto,detalle_tyt.referencia,detalle_tyt.dependencia ORDER BY detalle_tyt.concepto ASC"; //ordena el codigo en forma ascendente


    $query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
    $query_tasas_tarifas->execute();
    $tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);
}

class PDF extends FPDF
{
    public function header()
    {
        $this->Image('../public/images/logo2_unfv.jpg', 15, 8, 70);

        $this->SetY(10);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha:')); //texto

        $this->SetY(10);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(260); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('d/m/Y'))); //texto

        $this->SetY(15);
        $this->SetFont('Arial', 'B', 8);  //fuente
        $this->Cell(250); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Hora:')); //texto

        $this->SetY(15);
        $this->SetFont('Arial', '', 8);  //fuente
        $this->Cell(260); //mover a la derecha
        $this->Cell(40, 10, utf8_decode(date('H:i:s a'))); //texto

        $this->SetY(30);
        $this->SetFont('Arial', 'B', 12); //fuente
        $this->Cell(w: 110); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('REPORTE DE TASAS Y TARIFAS')); //texto

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

        $this->Line(10, 65, 285, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(8); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CODIGO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(23); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('MONTO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(38); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('DEPEND.')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(97); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CONCEPTO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(168); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('CUENTA')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(194); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('RESOLUCION RECTORAL')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(238); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('TIPO')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(257); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('SITUACION')); //texto


        $this->Line(10, 75, 285, 75); //LINEA

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
        $this->Cell(267); //mover a la derecha
        $this->Cell(40, 10, utf8_decode($this->PageNo() . '/tpagina')); //texto
    }
}

$pdf = new PDF();
$pdf->AddPage('LANDSCAPE', 'A4'); //orientacion y tamaño de la hoja
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(TRUE, 15);

$i = 1;
$importe_total = 0;

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

        /*
        if ($tasas_tarifas_dato['resolucion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['resolucion'] = "";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_1716_2023_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "1716_2023_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_2167_2018_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "2167_2018_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_2199_2023_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "2199_2023_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_2204_2023_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "2204_2023_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_2205_2023_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "2205_2023_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_2206_2023_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "2206_2023_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_2215_2018_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "2215_2018_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_277_2022_UNFV_TUPA"){
            $tasas_tarifas_dato['resolucion'] = "277_2022_UNFV_TUPA";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_3998_2018_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "3998_2018_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_4224_2013_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "4224_2013_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_5731_2019_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "5731_2019_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_6262_2019_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "6262_2019_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_7220_2020_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "7220_2020_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_7221_2020_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "7221_2020_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_7367_2015_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "7367_2015_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "Resolucion_R_Nro_7418_2020_CU_UNFV"){
            $tasas_tarifas_dato['resolucion'] = "7418_2020_CU_UNFV";
        }else if($tasas_tarifas_dato['resolucion'] == "S/RESOLUCION"){
            $tasas_tarifas_dato['resolucion'] = "S/RESOLUCION";
        }
        */



        if ($tasas_tarifas_dato['situacion'] == "SELECCIONAR") {
            $tasas_tarifas_dato['situacion'] = "";
        }






        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(10, 5, utf8_decode($i));

        $pdf->Cell(10, 5, utf8_decode($tasas_tarifas_dato["codigo_pago"]),null,null,'R');

        $importe_total = $importe_total + $tasas_tarifas_dato["monto"];

        $importe_tarifa = number_format($tasas_tarifas_dato["monto"], 2, '.', ','); //convertir int a decimal
        
        $pdf->Cell(14, 5, utf8_decode($importe_tarifa),null,null,'R');

        $tasas_tarifas_dato["dependencia"]= trim($tasas_tarifas_dato["dependencia"]); //ELIMINA ESPACIOS EN BLANCO DE UNA CADENA

    switch($tasas_tarifas_dato["dependencia"]){
        case "CENTRO PREUNIVERSITARIO DE LA UNIVERSIDAD NACIONAL FEDERICO VILLARREAL": $tasas_tarifas_dato["dependencia"]="CEPREVI";break;
        case "CENTRO DE GESTIÓN CULTURAL FEDERICO VILLARREAL": $tasas_tarifas_dato["dependencia"]="CGCFV";break;
        case "CENTRO DE IDIOMAS": $tasas_tarifas_dato["dependencia"]="CI";break;
        case "CENTRO DE PRODUCCIÓN DE BIENES Y SERVICIOS": $tasas_tarifas_dato["dependencia"]="CUPBS";break;
        case "CENTRO UNIVERSITARIO DE RESPONSABILIDAD SOCIAL": $tasas_tarifas_dato["dependencia"]="CURES";break;
        case "EDITORIAL UNIVERSITARIA": $tasas_tarifas_dato["dependencia"]="EU";break;
        case "ESCUELA UNIVERSITARIA DE EDUCACION A DISTANCIA": $tasas_tarifas_dato["dependencia"]="EUDED";break;
        case "ESCUELA UNIVERSITARIA DE POSTGRADO": $tasas_tarifas_dato["dependencia"]="EUPG";break;
        case "FACULTAD DE ADMINISTRACIÓN": $tasas_tarifas_dato["dependencia"]="FA";break;
        case "FACULTAD DE PSICOLOGIA": $tasas_tarifas_dato["dependencia"]="FAPS";break;
        case "FACULTAD DE ARQUITECTURA Y URBANISMO": $tasas_tarifas_dato["dependencia"]="FAU";break;
        case "FACULTAD DE CIENCIAS SOCIALES": $tasas_tarifas_dato["dependencia"]="FCCSS";break;
        case "FACULTAD DE CIENCIAS ECONOMICAS": $tasas_tarifas_dato["dependencia"]="FCE";break;
        case "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES": $tasas_tarifas_dato["dependencia"]="FCFC";break;
        case "FACULTAD DE CIENCIAS NATURALES Y MATEMATICA": $tasas_tarifas_dato["dependencia"]="FCNM";break;
        case "FACULTAD DE DERECHO Y CIENCIA POLITICA": $tasas_tarifas_dato["dependencia"]="FDCP";break;
        case "FACULTAD DE EDUCACION": $tasas_tarifas_dato["dependencia"]="FE";break;
        case "FACULTAD DE HUMANIDADES": $tasas_tarifas_dato["dependencia"]="FH";break;
        case "FACULTAD DE INGENIERIA CIVIL": $tasas_tarifas_dato["dependencia"]="FIC";break;
        case "FACULTAD DE INGENIERIA ELECTRONICA E INFORMATICA": $tasas_tarifas_dato["dependencia"]="FIEI";break;
        case "FACULTAD DE INGENIERIA GEOGRAFICA, AMBIENTAL Y ECOTURISMO": $tasas_tarifas_dato["dependencia"]="FIGAE";break;
        case "FACULTAD DE INGENIERIA INDUSTRIAL Y DE SISTEMAS": $tasas_tarifas_dato["dependencia"]="FIIS";break;
        case "FACULTAD DE MEDICINA DE HIPOLITO UNANUE": $tasas_tarifas_dato["dependencia"]="FMHU";break;
        case "FACULTAD DE ODONTOLOGIA": $tasas_tarifas_dato["dependencia"]="FO";break;
        case "FACULTAD DE OCEANOGRAFIA, PESQUERIA Y CC.AA.": $tasas_tarifas_dato["dependencia"]="FOPCA";break;
        case "FACULTAD DE TECNOLOGIA MEDICA": $tasas_tarifas_dato["dependencia"]="FTM";break;
        case "FACULTADES": $tasas_tarifas_dato["dependencia"]="FACULT.";break;
        case "INSTITUTO CENTRAL DE GESTION DE LA INVESTIGACION": $tasas_tarifas_dato["dependencia"]="ICGI";break;
        case "INSTITUTO DE RECREACION, EDUCACION FISICA Y DEPORTE": $tasas_tarifas_dato["dependencia"]="IRED";break;
        case "OFICINA CENTRAL DE ADMISION": $tasas_tarifas_dato["dependencia"]="OCA";break;
        case "OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO": $tasas_tarifas_dato["dependencia"]="OCBU";break;
        case "OFICINA CENTRAL DE REGISTRO ACADEMICO": $tasas_tarifas_dato["dependencia"]="OCRAC";break;
        case "OFICINA CENTRAL DE LOGISTICA Y SERVICIOS AUXILIARES": $tasas_tarifas_dato["dependencia"]="OCLSA";break;
        case "OFICINA DE TESORERIA": $tasas_tarifas_dato["dependencia"]="OT";break;
        case "SECRETARIA GENERAL": $tasas_tarifas_dato["dependencia"]="SG";break;
        case "VICE-RECTORADO DE INVESTIGACION": $tasas_tarifas_dato["dependencia"]="VRIN";break;

    }

        $pdf->Cell(15, 5, utf8_decode($tasas_tarifas_dato["dependencia"]),null,null,'R');

        //REEMPLAZAR EL GUION LARGO DEL CONCEPTO
        $tasas_tarifas_dato["concepto"]= str_replace('–','-', $tasas_tarifas_dato["concepto"]);
        $tasas_tarifas_dato["concepto"]= str_replace('PROGRAMA DE FORMACIÓN CONTINUA- UIIE - FAU NIVEL DE PROGRAMA','PFC-UIIE-NIVEL DE PROG.', $tasas_tarifas_dato["concepto"]);
        $tasas_tarifas_dato["concepto"] = substr($tasas_tarifas_dato["concepto"], 0, 60); //cortar cadena

        

        $pdf->Cell(110, 5, utf8_decode($tasas_tarifas_dato["concepto"]),null,null,'C');

        #$pdf->Cell(25, 5, utf8_decode($tasas_tarifas_dato["banco"]),null,null,'R');
        $pdf->Cell(22, 5, utf8_decode($tasas_tarifas_dato["cta"]),null,null,'R');
        #$pdf->Cell(35, 5, utf8_decode($tasas_tarifas_dato["resolucion"]));

        $tasas_tarifas_dato["resolucion"]= mb_strtoupper($tasas_tarifas_dato["resolucion"]);
        
        $tasas_tarifas_dato["resolucion"] = substr($tasas_tarifas_dato["resolucion"], 0, 34); //cortar cadena

        $tasas_tarifas_dato["resolucion"]= str_replace("RESOLUCION","R",$tasas_tarifas_dato["resolucion"]);

        $pdf->Cell(50, 5, utf8_decode($tasas_tarifas_dato["resolucion"]),null,null,'R');
        

        $pdf->Cell(15, 5, utf8_decode($tasas_tarifas_dato["tipo"]),null,null,'R');
        
        $tasas_tarifas_dato["situacion"]= trim($tasas_tarifas_dato["situacion"]); //ELIMINA ESPACIOS EN BLANCO

        switch($tasas_tarifas_dato["situacion"]){
            case "ACTUALIZACION": $tasas_tarifas_dato["situacion"]="ACTUALIZACION";break;
            case "INCORPORACION": $tasas_tarifas_dato["situacion"]="INCORPORACION";break;
            case "NO VIGENTE": $tasas_tarifas_dato["situacion"]="NO VIGENTE";break;
            case "NO VIGENTE - ELIMINADO": $tasas_tarifas_dato["situacion"]="NO VIG. ELIM.";break;
        }

        $pdf->Cell( 28, 5, utf8_decode($tasas_tarifas_dato["situacion"]),null,null,'R');
        
        
        /*$theDate = new DateTime($tasas_tarifas_dato["fyh_creacion_tyt"]);
        $fecha_registro = $theDate->format('d/m/Y');
        $pdf->Cell(10, 5, utf8_decode($fecha_registro),null,null,'R');
*/
        $i++;
        $pdf->Ln();
    }



    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto


    $pdf->Ln(5); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(5); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('TOTAL')); //texto

    $importe_total = number_format($importe_total, 2, '.', ','); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(19); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                                                                                                                                           ')); //texto

}

$pdf->Output('Reporte de Tasas y Tarifas.pdf', 'I');