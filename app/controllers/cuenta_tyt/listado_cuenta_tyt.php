<?php

$sql_cuenta_tyt = "SELECT * FROM tb_cuenta_tyt where id_cuenta_tyt!=1 AND visible!=1 ORDER BY nombre_cuenta_tyt ASC";
$query_cuenta_tyt = $pdo->prepare($sql_cuenta_tyt);
$query_cuenta_tyt->execute();
$cuenta_tyt_datos = $query_cuenta_tyt->fetchAll(PDO::FETCH_ASSOC);