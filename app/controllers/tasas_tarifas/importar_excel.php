<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');

$tipo = $_FILES['dataTasas_Tarifas']['type'];
$tamanio = $_FILES['dataTasas_Tarifas']['size'];
$archivotmp = $_FILES['dataTasas_Tarifas']['tmp_name'];
$lineas = file($archivotmp);

$i = 0;
$usuario = $_POST["id_usuario"];



// Obtener el nombre y la extensión del archivo
$nombre_archivo = basename($_FILES["dataTasas_Tarifas"]["name"]);
$extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

// Validar la extensión del archivo solo en formato CSV
if ($extension == "csv" || $extension == "CSV") {


    foreach ($lineas as $linea) {
        $cantidad_registros = count($lineas);
        $cantidad_regist_agregados = ($cantidad_registros - 1);

        if ($i != 0) {


            $datos = explode(";", $linea);

            $codigo_pago = !empty($datos[0]) ? ($datos[0]) : '';
            $modalidad = !empty($datos[1]) ? ($datos[1]) : '';
            $concepto = !empty($datos[2]) ? ($datos[2]) : '';
            $monto = !empty($datos[3]) ? ($datos[3]) : '';
            $monto = floatval($monto);
            $monto = number_format($monto, 2, '.', '');
            $referencia = !empty($datos[4]) ? ($datos[4]) : '';
            $clasificador = !empty($datos[5]) ? ($datos[5]) : '';
            $codigo_facultad = !empty($datos[6]) ? ($datos[6]) : '';
            $dependencia = !empty($datos[7]) ? ($datos[7]) : '';
            $codigo_ser_banco = !empty($datos[8]) ? ($datos[8]) : '';
            $cuenta = !empty($datos[9]) ? ($datos[9]) : '';
            $resolucion = !empty($datos[10]) ? ($datos[10]) : '';
            $archivo_resolucion = mb_strtoupper($resolucion); //CONVIERTE A MAYUSCULA
            $archivo_resolucion = "$archivo_resolucion.pdf";
            $vigencia = !empty($datos[11]) ? ($datos[11]) : '';
            $situacion = !empty($datos[12]) ? ($datos[12]) : '';
            $categoria_transaccion = !empty($datos[13]) ? ($datos[13]) : '';
            $categoria_transaccion = trim($categoria_transaccion); //ELIMINA ESPACIOS EN BLANCO
            $visible = !empty($datos[14]) ? ($datos[14]) : '';


            $sentencia = $pdo->prepare('INSERT INTO tb_tasas_tarifas(codigo_pago,modalidad,concepto,monto,referencia,clasificador,
                codigo_facultad,dependencia,codigo_ser_banco,cta,resolucion,archivo_resolucion,vigencia,situacion,categoria_transaccion,visible,id_usuario,fyh_creacion) 
                VALUES (:codigo_pago,:modalidad,:concepto,:monto,:referencia,:clasificador,
                :codigo_facultad,:dependencia,:codigo_ser_banco,:cta,:resolucion,:archivo_resolucion,:vigencia,:situacion,:categoria_transaccion,:visible,:id_usuario,:fyh_creacion)');


            $sentencia->bindParam('codigo_pago', $codigo_pago);
            $sentencia->bindParam('modalidad', $modalidad);
            $sentencia->bindParam('concepto', $concepto);
            $sentencia->bindParam('monto', $monto);
            $sentencia->bindParam('referencia', $referencia);
            $sentencia->bindParam('clasificador', $clasificador);
            $sentencia->bindParam('codigo_facultad', $codigo_facultad);
            $sentencia->bindParam('dependencia', $dependencia);
            $sentencia->bindParam('codigo_ser_banco', $codigo_ser_banco);
            $sentencia->bindParam('cta', $cuenta);
            $sentencia->bindParam('resolucion', $resolucion);
            $sentencia->bindParam('archivo_resolucion', $archivo_resolucion);
            $sentencia->bindParam('vigencia', $vigencia);
            $sentencia->bindParam('situacion', $situacion);
            $sentencia->bindParam('categoria_transaccion', $categoria_transaccion);
            $sentencia->bindParam('visible', $visible);
            $sentencia->bindParam('id_usuario', $usuario);
            $sentencia->bindParam('fyh_creacion', $fechaHora);
            $sentencia->execute();





        }

        $i = $i + 1;
    }

    $total = $i - 1;

    session_start();
    $_SESSION['mensaje'] = "Se importaron los $total datos de tasas y tarifas de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/tasas_tarifas/');

} else {
    session_start();
    $_SESSION['mensaje'] = "Error solo se permiten archivos CSV para importar a la base de datos del sistema";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/tasas_tarifas/');
}




