<?php

include('../../config.php');

$facultad = $_POST['facultad'];
$actividad = $_POST['actividad'];
$subactividad = $_POST['subactividad'];
$periodo = $_POST['periodo'];
$nt = $_POST['nt'];
$anio_nt = $_POST['anio_nt'];
$proveido_contabilidad = $_POST['proveido_contabilidad'];
$fecha_proveido_contabilidad = $_POST['fecha_proveido_contabilidad'];
$proveido_diga = $_POST['proveido_diga'];
$fecha_proveido_diga = $_POST['fecha_proveido_diga'];
$oficio_oclsa_orh = mb_strtoupper($_POST['oficio_oclsa_orh']);
$fecha_oclsa_orh = $_POST['fecha_oclsa_orh'];
$detalle = mb_strtoupper($_POST['detalle']);
$orden_compra = $_POST['orden_compra'];
$orden_servicio = $_POST['orden_servicio'];
$siaf = $_POST['siaf'];
$monto = floatval($_POST['monto']);
$monto = number_format($monto, 2, '.', ''); //convertir int a decimal
$egresos = floatval($_POST['egreso']);
$egresos = number_format($egresos, 2, '.', ''); //convertir int a decimal
$ingresos = floatval($_POST['ingreso']);
$ingresos = number_format($ingresos, 2, '.', ''); //convertir int a decimal
$comprobante = $_POST['comprobante'];
$fecha_pago = $_POST['fecha_pago'];
$fecha_giro = $_POST['fecha_giro'];
$asunto = mb_strtoupper($_POST['asunto']);
//REEMPLAZAR EL GUION LARGO DEL ASUNTO
$asunto = str_replace('−', '-', $asunto);
$informe = $_POST['informe'];
$fecha_informe = $_POST['fecha_informe'];
$resolucion = $_POST['resolucion'];
$fecha_resolucion = $_POST['fecha_resolucion'];
$usuario = $_POST['id_usuario'];
$visible = 0;



$contador = 0;
$sql_detalle_egresos = "SELECT * FROM tb_detalle_egresos where facultad='$facultad' AND actividad_principal='$actividad' 
AND subactividad='$subactividad' AND periodo='$periodo' AND nt='$nt' AND visible!=1";
$query_detalle_egresos = $pdo->prepare($sql_detalle_egresos);
$query_detalle_egresos->execute();
$detalle_egresos_datos = $query_detalle_egresos->fetchAll(PDO::FETCH_ASSOC);

foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
    if ($detalle_egresos_dato["siaf"] == $siaf) {
        $contador = 1;
    }

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
    $sentencia = $pdo->prepare("INSERT INTO tb_detalle_egresos (nt,anio_nt,proveido_contabilidad,fecha_proveido_contabilidad,
    proveido_diga,fecha_diga,oficio,fecha_oficio,detalle,nro_orden_compra,nro_orden_servicio,siaf,monto,comprobante_pago,fecha_pago,fecha_giro,
    asunto,informe,fecha_informe,resolucion,fecha_resolucion,egresos,ingresos,facultad,actividad_principal,subactividad,periodo,id_usuario,visible,fyh_creacion) 
    VALUES (:nt,:anio_nt,:proveido_contabilidad,:fecha_proveido_contabilidad,:proveido_diga,:fecha_diga,:oficio,:fecha_oficio,:detalle,
    :nro_orden_compra,:nro_orden_servicio,:siaf,:monto,:comprobante_pago,:fecha_pago,:fecha_giro,:asunto,:informe,:fecha_informe,:resolucion,:fecha_resolucion,
    :egresos,:ingresos,:facultad,:actividad_principal,:subactividad,:periodo,:id_usuario,:visible,:fyh_creacion)");



    $sentencia->bindParam('nt', $nt);
    $sentencia->bindParam('anio_nt', $anio_nt);
    $sentencia->bindParam('proveido_contabilidad', $proveido_contabilidad);
    $sentencia->bindParam('fecha_proveido_contabilidad', $fecha_proveido_contabilidad);
    $sentencia->bindParam('proveido_diga', $proveido_diga);
    $sentencia->bindParam('fecha_diga', $fecha_proveido_diga);
    $sentencia->bindParam('oficio', $oficio_oclsa_orh);
    $sentencia->bindParam('fecha_oficio', $fecha_oclsa_orh);
    $sentencia->bindParam('detalle', $detalle);
    $sentencia->bindParam('nro_orden_compra', $orden_compra);
    $sentencia->bindParam('nro_orden_servicio', $orden_servicio);
    $sentencia->bindParam('siaf', $siaf);
    $sentencia->bindParam('monto', $monto);
    $sentencia->bindParam('comprobante_pago', $comprobante);
    $sentencia->bindParam('fecha_pago', $fecha_pago);
    $sentencia->bindParam('fecha_giro', $fecha_giro);
    $sentencia->bindParam('asunto', $asunto);
    $sentencia->bindParam('informe', $informe);
    $sentencia->bindParam('fecha_informe', $fecha_informe);
    $sentencia->bindParam('resolucion', $resolucion);
    $sentencia->bindParam('fecha_resolucion', $fecha_resolucion);
    $sentencia->bindParam('egresos', $egresos);
    $sentencia->bindParam('ingresos', $ingresos);
    $sentencia->bindParam('facultad', $facultad);
    $sentencia->bindParam('actividad_principal', $actividad);
    $sentencia->bindParam('subactividad', $subactividad);
    $sentencia->bindParam('periodo', $periodo);
    $sentencia->bindParam('id_usuario', $usuario);
    $sentencia->bindParam('visible', $visible);
    $sentencia->bindParam('fyh_creacion', $fechaHora);

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
