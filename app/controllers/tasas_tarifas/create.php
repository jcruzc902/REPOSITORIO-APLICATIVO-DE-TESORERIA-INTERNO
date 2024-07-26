<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');


$codigo_pago = $_POST["codigo_pago"];
$modalidad = $_POST["modalidad"];
$concepto = $_POST["concepto"];
$monto = floatval($_POST["monto"]);
$monto = number_format($monto, 2, '.', '');
$referencia = $_POST["referencia"];
$clasificador = mb_strtoupper($_POST["clasificador"]);
$codigo_facultad = mb_strtoupper($_POST["codigo_facultad"]);
$dependencia = $_POST["dependencia"];
$codigo_serv_banco = mb_strtoupper($_POST["codigo_serv_banco"]);
$banco = $_POST["banco"];
$cuenta = $_POST["cuenta"];
$resolucion = $_POST["resolucion"];
$archivo_resolucion = $_POST["archivo_resolucion"];
$vigencia = $_POST["vigencia"];
$situacion = $_POST["situacion"];
$tipo = $_POST["tipo"];
$visible = 0;
$usuario = $_POST["id_usuario"];


$sentencia = $pdo->prepare('INSERT INTO tb_tasas_tarifas(codigo_pago,modalidad,concepto,monto,referencia,clasificador,
codigo_facultad,dependencia,codigo_ser_banco,banco,cta,resolucion,archivo_resolucion,vigencia,situacion,categoria_transaccion,visible,id_usuario,fyh_creacion) 
    VALUES (:codigo_pago,:modalidad,:concepto,:monto,:referencia,:clasificador,:codigo_facultad,:dependencia,
    :codigo_ser_banco,:banco,:cta,:resolucion,:archivo_resolucion,:vigencia,:situacion,:categoria_transaccion,:visible,:id_usuario,:fyh_creacion)');

$sentencia->bindParam('codigo_pago', $codigo_pago);
$sentencia->bindParam('modalidad', $modalidad);
$sentencia->bindParam('concepto', $concepto);
$sentencia->bindParam('monto', $monto);
$sentencia->bindParam('referencia', $referencia);
$sentencia->bindParam('clasificador', $clasificador);
$sentencia->bindParam('codigo_facultad', $codigo_facultad);
$sentencia->bindParam('dependencia', $dependencia);
$sentencia->bindParam('codigo_ser_banco', $codigo_serv_banco);
$sentencia->bindParam('banco', $banco);
$sentencia->bindParam('cta', $cuenta);
$sentencia->bindParam('resolucion', $resolucion);
$sentencia->bindParam('archivo_resolucion', $archivo_resolucion);
$sentencia->bindParam('vigencia', $vigencia);
$sentencia->bindParam('situacion', $situacion);
$sentencia->bindParam('categoria_transaccion', $tipo);
$sentencia->bindParam('visible', $visible);
$sentencia->bindParam('id_usuario', $usuario);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->execute();



session_start();
$_SESSION['mensaje'] = "Se registro la tasa/tarifa de la manera correcta";
$_SESSION['icono'] = "success";
header('Location: ' . $URL . '/tasas_tarifas/');

