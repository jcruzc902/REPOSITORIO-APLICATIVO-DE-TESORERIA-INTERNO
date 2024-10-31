<?php
/**
 
 * Date: 18/1/2023
 * Time: 15:17
 */
include ('../../config.php');
require_once ('../../librerias/PHP_EXCEL/PhpXlsxGenerator.php');

$fileName = "REPORTE DE ROLES " . date('d-m-Y H:i:s') . ".xlsx";
$excelData[] = array('ID', 'Nombre de Rol', 'Fecha de Registro', 'Fecha de Actualizacion');

$sql_roles = "SELECT * FROM tb_roles where visible!=1";
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

foreach ($roles_datos as $roles_dato) {
        

    $lineData = array(
        $contador = $contador + 1,
        $roles_dato['rol'],
        $roles_dato['fyh_creacion'],
        $roles_dato['fyh_actualizacion']
    );

    $excelData[] = $lineData;
}

//Export data to excel and download as xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($fileName);

