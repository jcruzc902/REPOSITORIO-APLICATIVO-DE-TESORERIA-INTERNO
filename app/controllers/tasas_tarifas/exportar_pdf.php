<?php
include ('../../config.php');

require ('../../librerias/FPDF/fpdf.php');

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
        $this->Cell(65); //mover a la derecha
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

        $this->Line(10, 65, 200, 65); //LINEA

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(1); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N°')); //texto


        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(12); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Codigo de Pago')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(40); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Monto (S/)')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(65); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Dependencia')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(95); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Cuenta')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(120); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Resolucion')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Tipo')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(172); //mover a la derecha
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



        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(15, 5, utf8_decode($i));

        $pdf->Cell(25, 5, utf8_decode($tasas_tarifas_dato["codigo_pago"]));

        $tasas_tarifas_dato["monto"] = number_format($tasas_tarifas_dato["monto"], 2, '.', ''); //convertir int a decimal
        $importe_total = $importe_total + $tasas_tarifas_dato["monto"];

        $pdf->Cell(25, 5, utf8_decode($tasas_tarifas_dato["monto"]));
        $pdf->Cell(23, 5, utf8_decode($tasas_tarifas_dato["dependencia"]));
        $pdf->Cell(31, 5, utf8_decode($tasas_tarifas_dato["cta"]));


        $pdf->Cell(35, 5, utf8_decode($tasas_tarifas_dato["resolucion"]));
        
        $pdf->Cell(18, 5, utf8_decode($tasas_tarifas_dato["categoria_transaccion"]));
        $theDate = new DateTime($tasas_tarifas_dato["fyh_creacion_tyt"]);
        $fecha_registro = $theDate->format('d/m/Y');
        $pdf->Cell(10, 5, utf8_decode($fecha_registro));

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

    $importe_total = number_format($importe_total, 2, '.', ''); //convertir int a decimal

    $pdf->Ln(0); //salto de linea
    $pdf->SetFont('Arial', 'B', 8);  //fuente
    $pdf->Cell(37); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto

}

$pdf->Output('Reporte de Tasas y Tarifas.pdf', 'I');