<?php

include('../../config.php');

$facultad = $_POST['facultad'];
$actividad = $_POST['actividad'];
$periodo = $_POST['periodo'];
$nt = $_POST['nt'];
$anio_nt = $_POST['anio_nt'];
$proveido_contabilidad = $_POST['proveido_contabilidad'];
$fecha_proveido_contabilidad = $_POST['fecha_proveido_contabilidad'];
$proveido_diga = $_POST['proveido_diga'];
$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$oficio_oclsa_orh = mb_strtoupper($_POST['oficio_oclsa_orh']);
$fecha_oclsa_orh = $_POST['fecha_oclsa_orh'];
$total_egresos = $_POST['total_egresos'];
$orden_compra = $_POST['orden_compra'];
$orden_servicio = $_POST['orden_servicio'];
$siaf = $_POST['siaf'];
$detalle = mb_strtoupper($_POST['detalle']);
$especialidad = mb_strtoupper($_POST['especialidad']);
$periodo_meses = mb_strtoupper($_POST['periodo_meses']);
$monto = $_POST['monto'];
$saldo_inicial = $_POST['saldo_inicial'];
$comprobante = $_POST['comprobante'];
$fecha_pago = $_POST['fecha_pago'];
$fecha_giro = $_POST['fecha_giro'];
$estado_giro = $_POST['estado_giro'];
$asunto = mb_strtoupper($_POST['asunto']);
$descripcion = $_POST['descripcion'];
$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$resolucion = $_POST['resolucion'];
$fecha_resolucion = $_POST['fecha_resolucion'];
$numero_estado_cuenta = $_POST['numero_estado_cuenta'];
$fecha_estado_cuenta = $_POST['fecha_estado_cuenta'];
$informe_ingreso = $_POST['informe_ingreso'];
$fecha_informe_ingreso = $_POST['fecha_informe_ingreso'];
$descripcion_ec = $_POST['descripcion_ec'];
$usuario = $_POST['id_usuario'];
$visible = 0;
$saldo = 0.00;

$contador = 0;
$sql_detalle_egresos = "SELECT * FROM tb_detalle_egresos where visible!=1";
$query_detalle_egresos = $pdo->prepare($sql_detalle_egresos);
$query_detalle_egresos->execute();
$detalle_egresos_datos = $query_detalle_egresos->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
    if ($detalle_egresos_dato["nt"] == $nt && $detalle_egresos_dato["siaf"] == $siaf) {
        $contador = 1;
    }

}



function conexion()
{

    try {
        $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', '');
    } catch (PDOException $e) {
        echo "Error " . $e;
    }

    return $conn;
}
//-------------------------------------------------------------------------------------------------------


$con = conexion();
$total_egresos_acumulado = current($con->query("SELECT MAX(egresos) as maximo_egresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND estado_giro='APROBADO' AND visible!=1")->fetch());

if ($total_egresos_acumulado == null) {
    $total_egresos_acumulado = 0;
}


/*
$con = conexion();
$total_ingresos_acumulado = current($con->query("SELECT MIN(ingresos) as minimo_ingresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND estado_giro='APROBADO' AND visible!=1 AND ingresos!=0.00")->fetch());


if ($total_ingresos_acumulado == null) {
    $total_ingresos_acumulado = $_POST['saldo_inicial'];
}
*/


//-------------------------------------------------------------------------------------------------------

if ($estado_giro == "APROBADO" && $saldo == 0.00) {
    $egresos = $total_egresos_acumulado + $_POST['monto']; //aumenta egresos
    $ingresos = $saldo_inicial - $egresos; //disminuye ingresos
    $saldo = $saldo_inicial - $egresos;

    $total_egresos = $egresos;
}


if ($estado_giro == "PENDIENTE") {
    $egresos = 0;
    $ingresos = 0;
    $saldo = 0;

} else if ($estado_giro == "ANULADO") {
    $egresos = 0;
    $ingresos = 0;
    $saldo = 0;

    $total_egresos = 0;
}



if ($contador == 1) {
    session_start();
    $_SESSION['mensaje'] = "El detalle de este estado de egreso ya ha sido registrado anteriormente";
    $_SESSION['icono'] = "error";
    #header('Location: ' . $URL . '/categorias/');
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/detalle_estado_egresos/create.php";
    </script>
    <?php
} else {

    if ($_POST['informe_ingreso'] == null) {
        $sentencia = $pdo->prepare("INSERT INTO tb_detalle_egresos (nt,anio_nt,proveido_contabilidad,fecha_proveido_contabilidad,
    proveido_diga,fecha_diga,oficio,fecha_oficio,total_egresos,nro_orden_compra,nro_orden_servicio,siaf,monto,comprobante_pago,fecha_pago,fecha_giro,estado_giro,
    asunto,descripcion,informe,fecha_informe,informe_ingresos,fecha_informe_ingresos,numero_ec,fecha_ec,descripcion_ec,detalle,especialidad,periodo_meses,resolucion,fecha_resolucion,
    facultad,actividad_principal,saldo_inicial,periodo,id_usuario,visible,fyh_creacion) 
    VALUES (:nt,:anio_nt,:proveido_contabilidad,:fecha_proveido_contabilidad,:proveido_diga,:fecha_diga,:oficio,:fecha_oficio,:total_egresos,
    :nro_orden_compra,:nro_orden_servicio,:siaf,:monto,:comprobante_pago,:fecha_pago,:fecha_giro,:estado_giro,:asunto,:descripcion,:informe,:fecha_informe,
    :informe_ingresos,:fecha_informe_ingresos,:numero_ec,:fecha_ec,:descripcion_ec,:detalle,:especialidad,:periodo_meses,:resolucion,:fecha_resolucion,:facultad,:actividad_principal,:saldo_inicial,
    :periodo,:id_usuario,:visible,:fyh_creacion)");

        $descripcion_ec = "";

        $anio_actual = date("Y"); //anio
        $sql_detalle_ec = "SELECT MAX(numero_ec) as numero_estado_cta FROM tb_detalle_egresos WHERE YEAR(fecha_ec)='$anio_actual' AND visible!=1";
        $query_detalle_ec = $pdo->prepare($sql_detalle_ec);
        $query_detalle_ec->execute();
        $detalle_ec_datos = $query_detalle_ec->fetchAll(PDO::FETCH_ASSOC);

        foreach ($detalle_ec_datos as $detalle_ec_dato) {
            $numero_estado_cuenta = $detalle_ec_dato['numero_estado_cta'];
        }

        //REEMPLAZAR EL GUION LARGO DEL ASUNTO
        $asunto = str_replace('–', '-', $asunto);
        $descripcion = str_replace('–', '-', $descripcion);

        $sentencia->bindParam('nt', $nt);
        $sentencia->bindParam('anio_nt', $anio_nt);
        $sentencia->bindParam('proveido_contabilidad', $proveido_contabilidad);
        $sentencia->bindParam('fecha_proveido_contabilidad', $fecha_proveido_contabilidad);
        $sentencia->bindParam('proveido_diga', $proveido_diga);
        $sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
        $sentencia->bindParam('oficio', $oficio_oclsa_orh);
        $sentencia->bindParam('fecha_oficio', $fecha_oclsa_orh);
        $sentencia->bindParam('total_egresos', $total_egresos);
        $sentencia->bindParam('nro_orden_compra', $orden_compra);
        $sentencia->bindParam('nro_orden_servicio', $orden_servicio);
        $sentencia->bindParam('siaf', $siaf);
        $sentencia->bindParam('monto', $monto);
        $sentencia->bindParam('comprobante_pago', $comprobante);
        $sentencia->bindParam('fecha_pago', $fecha_pago);
        $sentencia->bindParam('fecha_giro', $fecha_giro);
        $sentencia->bindParam('estado_giro', $estado_giro);
        $sentencia->bindParam('asunto', $asunto);
        $sentencia->bindParam('descripcion', $descripcion);
        $sentencia->bindParam('informe', $informe);
        $sentencia->bindParam('fecha_informe', $fecha_informe);
        $sentencia->bindParam('informe_ingresos', $informe_ingreso);
        $sentencia->bindParam('fecha_informe_ingresos', $fecha_informe_ingreso);
        $sentencia->bindParam('numero_ec', $numero_estado_cuenta);
        $sentencia->bindParam('fecha_ec', $fecha_estado_cuenta);
        $sentencia->bindParam('descripcion_ec', $descripcion_ec);
        $sentencia->bindParam('detalle', $detalle);
        $sentencia->bindParam('especialidad', $especialidad);
        $sentencia->bindParam('periodo_meses', $periodo_meses);
        $sentencia->bindParam('resolucion', $resolucion);
        $sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
        $sentencia->bindParam('facultad', $facultad);
        $sentencia->bindParam('actividad_principal', $actividad);
        $sentencia->bindParam('saldo_inicial', $saldo_inicial);
        $sentencia->bindParam('periodo', $periodo);
        $sentencia->bindParam('id_usuario', $usuario);
        $sentencia->bindParam('visible', $visible);
        $sentencia->bindParam('fyh_creacion', $fechaHora);


    } else {
        $sentencia = $pdo->prepare("INSERT INTO tb_detalle_egresos (nt,anio_nt,proveido_contabilidad,fecha_proveido_contabilidad,
    proveido_diga,fecha_diga,oficio,fecha_oficio,total_egresos,nro_orden_compra,nro_orden_servicio,siaf,monto,comprobante_pago,fecha_pago,fecha_giro,estado_giro,
    asunto,descripcion,informe,fecha_informe,informe_ingresos,fecha_informe_ingresos,numero_ec,fecha_ec,descripcion_ec,detalle,especialidad,periodo_meses,resolucion,fecha_resolucion,egresos,ingresos,saldo,facultad,
    actividad_principal,saldo_inicial,periodo,id_usuario,visible,fyh_creacion) VALUES (:nt,:anio_nt,:proveido_contabilidad,:fecha_proveido_contabilidad,:proveido_diga,:fecha_diga,:oficio,:fecha_oficio,:total_egresos,
    :nro_orden_compra,:nro_orden_servicio,:siaf,:monto,:comprobante_pago,:fecha_pago,:fecha_giro,:estado_giro,:asunto,:descripcion,:informe,:fecha_informe,
    :informe_ingresos,:fecha_informe_ingresos,:numero_ec,:fecha_ec,:descripcion_ec,:detalle,:especialidad,:periodo_meses,:resolucion,:fecha_resolucion,:egresos,:ingresos,:saldo,:facultad,:actividad_principal,:saldo_inicial,
    :periodo,:id_usuario,:visible,:fyh_creacion)");

        //REEMPLAZAR EL GUION LARGO DEL ASUNTO
        $asunto = str_replace('–', '-', $asunto);
        $descripcion = str_replace('–', '-', $descripcion);

        $sentencia->bindParam('nt', $nt);
        $sentencia->bindParam('anio_nt', $anio_nt);
        $sentencia->bindParam('proveido_contabilidad', $proveido_contabilidad);
        $sentencia->bindParam('fecha_proveido_contabilidad', $fecha_proveido_contabilidad);
        $sentencia->bindParam('proveido_diga', $proveido_diga);
        $sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
        $sentencia->bindParam('oficio', $oficio_oclsa_orh);
        $sentencia->bindParam('fecha_oficio', $fecha_oclsa_orh);
        $sentencia->bindParam('total_egresos', $total_egresos);
        $sentencia->bindParam('nro_orden_compra', $orden_compra);
        $sentencia->bindParam('nro_orden_servicio', $orden_servicio);
        $sentencia->bindParam('siaf', $siaf);
        $sentencia->bindParam('monto', $monto);
        $sentencia->bindParam('comprobante_pago', $comprobante);
        $sentencia->bindParam('fecha_pago', $fecha_pago);
        $sentencia->bindParam('fecha_giro', $fecha_giro);
        $sentencia->bindParam('estado_giro', $estado_giro);
        $sentencia->bindParam('asunto', $asunto);
        $sentencia->bindParam('descripcion', $descripcion);
        $sentencia->bindParam('informe', $informe);
        $sentencia->bindParam('fecha_informe', $fecha_informe);
        $sentencia->bindParam('informe_ingresos', $informe_ingreso);
        $sentencia->bindParam('fecha_informe_ingresos', $fecha_informe_ingreso);
        $sentencia->bindParam('numero_ec', $numero_estado_cuenta);
        $sentencia->bindParam('fecha_ec', $fecha_estado_cuenta);
        $sentencia->bindParam('descripcion_ec', $descripcion_ec);
        $sentencia->bindParam('detalle', $detalle);
        $sentencia->bindParam('especialidad', $especialidad);
        $sentencia->bindParam('periodo_meses', $periodo_meses);
        $sentencia->bindParam('resolucion', $resolucion);
        $sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
        $sentencia->bindParam('egresos', $egresos);
        $sentencia->bindParam('ingresos', $ingresos);
        $sentencia->bindParam('saldo', $saldo);
        $sentencia->bindParam('facultad', $facultad);
        $sentencia->bindParam('actividad_principal', $actividad);
        $sentencia->bindParam('saldo_inicial', $saldo_inicial);
        $sentencia->bindParam('periodo', $periodo);
        $sentencia->bindParam('id_usuario', $usuario);
        $sentencia->bindParam('visible', $visible);
        $sentencia->bindParam('fyh_creacion', $fechaHora);


    }

    if ($sentencia->execute()) {
        session_start();
        $_SESSION['mensaje'] = "Se registro el detalle del estado de egreso de la manera correcta";
        $_SESSION['icono'] = "success";
        #header('Location: ' . $URL . '/categorias/');
        ?>
        <script>
            location.href = "<?php echo $URL; ?>/detalle_estado_egresos";
        </script>
        <?php
    } else {
        #echo "Error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
        $_SESSION['icono'] = "error";
        #header('Location: ' . $URL . '/categorias');

    }


}
