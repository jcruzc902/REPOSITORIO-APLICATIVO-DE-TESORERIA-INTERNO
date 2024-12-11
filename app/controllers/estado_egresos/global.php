<?php
include ('../../config.php');
session_start();

$facultad= $_GET['facultad'];
$actividad= $_GET['actividad'];
$subactividad= $_GET['subactividad'];
$periodo= $_GET['periodo'];



$_SESSION['facultad'] = $facultad;
$_SESSION['actividad']= $actividad;
$_SESSION['subactividad'] = $subactividad;
$_SESSION['periodo']= $periodo;






