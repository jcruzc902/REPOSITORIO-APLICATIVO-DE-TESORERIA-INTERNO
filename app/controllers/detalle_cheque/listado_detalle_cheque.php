<?php

if ((isset($_SESSION['numero_tramite_cheque'])) && isset($_SESSION['anio_nt_cheque']) && isset($_SESSION['id_anio_nt_cheque'])) {
    $numero_tramite = $_SESSION['numero_tramite_cheque'];
    $anio_nt = $_SESSION['anio_nt_cheque'];
    $id_anio_nt = $_SESSION['id_anio_nt_cheque'];
} else {
    $numero_tramite = "";
    $anio_nt = "";
    $id_anio_nt = "";
}

$sql_detalle_cheque = "SELECT cheque.id_detalle_cheque as id_detalle_cheque,
cheque.id_nrocuenta as id_nrocuenta,
nrocuenta.nro_cuenta as nro_cuenta,
cheque.nro_ci as nro_ci,
cheque.fecha_ci as fecha_ci,
cheque.nro_ce as nro_ce,
cheque.fecha_ce as fecha_ce,
cheque.nro_cheque as nro_cheque,
cheque.fecha_emision_cheque as fecha_emision,
cheque.monto as monto,
cheque.nro_envio as nro_envio,
cheque.fecha_aprobado as fecha_aprobado,
cheque.fecha_entregado as fecha_entregado,
cheque.fecha_pagado as fecha_pagado,
cheque.observacion as observacion,
usuario.id_usuario as id_usuario,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario,
cheque.nt as nt,
cheque.id_anio_nt as id_anio_nt,
anio_nt.anio_nt as anio_nt 
FROM tb_detalle_cheque as cheque 
INNER JOIN tb_nrocuenta as nrocuenta ON nrocuenta.id_nrocuenta= cheque.id_nrocuenta 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= cheque.id_usuario 
INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt= cheque.id_anio_nt  
WHERE cheque.visible!=1 AND cheque.nt='$numero_tramite' AND cheque.id_anio_nt='$id_anio_nt'";
$query_detalle_cheque = $pdo->prepare($sql_detalle_cheque);
$query_detalle_cheque->execute();
$detalle_cheque_datos = $query_detalle_cheque->fetchAll(PDO::FETCH_ASSOC);