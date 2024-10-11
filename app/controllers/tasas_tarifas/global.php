<?php
include ('../../config.php');
session_start();

$codigo_pago= $_GET['codigo_pago'];
$modalidad= $_GET['modalidad'];
$concepto= $_GET['concepto'];
$referencia= $_GET['referencia'];
$dependencia= $_GET['dependencia'];

$_SESSION['codigo_pago'] = $codigo_pago;
$_SESSION['modalidad'] = $modalidad;
$_SESSION['concepto'] = $concepto;
$_SESSION['referencia'] = $referencia;
$_SESSION['dependencia'] = $dependencia;





