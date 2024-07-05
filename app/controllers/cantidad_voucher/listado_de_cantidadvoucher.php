<?php

$sql_cantidad_voucher = "SELECT * FROM tb_cantidad_voucher WHERE id_cantidad_voucher!=1 ";
$query_cantidad_voucher = $pdo->prepare($sql_cantidad_voucher);
$query_cantidad_voucher->execute();
$cantidad_voucher_datos = $query_cantidad_voucher->fetchAll(PDO::FETCH_ASSOC);