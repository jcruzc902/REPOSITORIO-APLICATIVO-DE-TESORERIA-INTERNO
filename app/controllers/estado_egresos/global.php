<?php
include ('../../config.php');
session_start();

$facultad= $_GET['facultad'];
$actividad= $_GET['actividad'];
$saldo_inicial= $_GET['saldo_inicial'];
$periodo= $_GET['periodo'];




$_SESSION['facultad'] = $facultad;
$_SESSION['actividad']= $actividad;
$_SESSION['saldo_inicial']= $saldo_inicial;
$_SESSION['periodo']= $periodo;







