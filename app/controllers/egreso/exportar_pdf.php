<?php
include ('../../config.php');

require ('../../librerias/FPDF/fpdf.php');

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
    egresos.id_estado_egreso as id_estado_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
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
        $this->Cell(40, 10, utf8_decode('REPORTE DE EGRESOS')); //texto

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
        $this->Cell(15); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('NT')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(28); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Proveido(DIGA)')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(55); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Fecha')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(75); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Tipo')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(95); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Monto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(115); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Concepto')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(135); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('Modalidad')); //texto

        $this->SetY(65);
        $this->SetFont('Arial', 'B', 8); //fuente
        $this->Cell(155); //mover a la derecha
        $this->Cell(40, 10, utf8_decode('N° CP')); //texto

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

if (!isset($egresos_datos)) {
    $egresos_datos = '';
} else {
    foreach ($egresos_datos as $egresos_dato) {


        if ($egresos_dato['fecha_diga'] == "0000-00-00") {
            $egresos_dato['fecha_diga'] = "";
        } else {

            $theDate = new DateTime($egresos_dato['fecha_diga']);
            $egresos_dato['fecha_diga'] = $theDate->format('d/m/Y');
        }

        if ($egresos_dato['fecha_conta'] == "0000-00-00") {
            $egresos_dato['fecha_conta'] = "";
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


        $pdf->SetFont('Arial', '', 8); //fuente
        $pdf->Cell(1); //mover a la derecha
        $pdf->Cell(9, 5, utf8_decode($i));

        $pdf->Cell(25, 5, utf8_decode($egresos_dato["nt_diga"] . '-' . $egresos_dato["nt_anio"]));
        $pdf->Cell(20, 5, utf8_decode($egresos_dato["proveido_diga"]));


        $pdf->Cell(20, 5, utf8_decode($egresos_dato["fecha_diga"]));
        $pdf->Cell(20, 5, utf8_decode($egresos_dato["nombre_tipo_gasto"]));

        $egresos_dato["monto"] = number_format($egresos_dato["monto"], 2, '.', ''); //convertir int a decimal
        $importe_total = $importe_total + $egresos_dato["monto"];


        $pdf->Cell(20, 5, utf8_decode($egresos_dato["monto"]));

        if ($egresos_dato["nombre_concepto_giro"] == "PLANILLA DE INVITADO") {
            $egresos_dato["nombre_concepto_giro"] = "P.INVITADO";
        } else if ($egresos_dato["nombre_concepto_giro"] == "PLANILLA DE PLANTA") {
            $egresos_dato["nombre_concepto_giro"] = "P.PLANTA";
        }

        $pdf->Cell(20, 5, utf8_decode($egresos_dato["nombre_concepto_giro"]));
        $pdf->Cell(20, 5, utf8_decode($egresos_dato["nombre_modalidad_pago"]));
        $pdf->Cell(18, 5, utf8_decode($egresos_dato["numero_comprobante"]));

        $theDate = new DateTime($egresos_dato["fyh_creacion_egreso"]);
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
    $pdf->Cell(91); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('S/. ' . $importe_total)); //texto

    $pdf->Ln(2); //salto de linea
    $pdf->SetFont('Arial', 'U', 8);  //fuente
    $pdf->Cell(1); //mover a la derecha
    $pdf->Cell(40, 10, utf8_decode('                                                                                                                                                                                                                                             ')); //texto

}

$pdf->Output('Reporte de Egresos.pdf', 'I');