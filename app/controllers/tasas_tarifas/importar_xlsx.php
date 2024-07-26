<?php
/**
 
 * Date: 29/1/2023
 * Time: 22:50
 */


include ('../../config.php');
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



$contador = 0;
$visible = 0;
$usuario = $_POST["id_usuario"];


// Comprobar si se ha cargado un archivo
if (isset($_FILES['dataTasas_Tarifas'])) {
    extract($_POST);

    // Definir la carpeta de destino
    $carpeta_destino = "data/";

    // Obtener el nombre y la extensión del archivo
    $nombre_archivo = basename($_FILES["dataTasas_Tarifas"]["name"]);
    $extension = strtolower(pathinfo($nombre_archivo, PATHINFO_EXTENSION));

    // Validar la extensión del archivo
    if ($extension == "xls" || $extension == "xlsx") {


        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($_FILES["dataTasas_Tarifas"]["tmp_name"], $carpeta_destino . $nombre_archivo)) {


            $inputFileNamePath = $carpeta_destino . $nombre_archivo;
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $count = "0";

            foreach ($data as $columna) {

                if ($count > 0) {
                    $codigo_pago = $columna['0'];
                    $modalidad = $columna['1'];
                    $concepto = $columna['2'];
                    $monto = $columna['3'];
                    $monto = floatval($monto);
                    $monto = number_format($monto, 2, '.', '');
                    $referencia = $columna['4'];
                    $clasificador = $columna['5'];
                    $codigo_facultad = $columna['6'];
                    $dependencia = $columna['7'];
                    $codigo_ser_banco = $columna['8'];
                    $cuenta = $columna['9'];
                    $resolucion = $columna['10'];
                    $archivo_resolucion = mb_strtoupper($resolucion); //CONVIERTE A MAYUSCULA
                    $archivo_resolucion = "$archivo_resolucion.pdf";
                    $vigencia = $columna['11'];
                    $situacion = $columna['12'];
                    $categoria_transaccion = $columna['13'];

                    if ($codigo_pago == null) {
                        $codigo_pago = 0;
                    }

                    if ($modalidad == null) {
                        $modalidad = "SELECCIONAR";
                    }

                    if ($concepto == null) {
                        $concepto = "SELECCIONAR";
                    }

                    if ($monto == null) {
                        $monto = 0;
                    }

                    if ($referencia == null) {
                        $referencia = "SELECCIONAR";
                    }

                    if ($clasificador == null) {
                        $clasificador = 0;
                    }

                    if ($codigo_facultad == null) {
                        $codigo_facultad = 0;
                    }

                    if ($dependencia == null) {
                        $dependencia = "SELECCIONAR";
                    }

                    if ($codigo_ser_banco == null) {
                        $codigo_ser_banco = 0;
                    }

                    if ($cuenta == null) {
                        $cuenta = "SELECCIONAR";
                    }

                    if ($resolucion == null) {
                        $resolucion = "SELECCIONAR";
                    }

                    if ($vigencia == null) {
                        $vigencia = "0000-00-00";
                    }

                    if ($situacion == null) {
                        $situacion = "SELECCIONAR";
                    }

                    if ($categoria_transaccion == null) {
                        $categoria_transaccion = "SELECCIONAR";
                    }

                    $con = @mysqli_connect('localhost', 'root', '', 'sistemadedevoluciondedinero');
                    if (!$con) {
                        die("imposible conectarse: " . mysqli_error($con));
                    }
                    if (@mysqli_connect_errno()) {
                        die("Conexión falló: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
                    }

                    $resultado = mysqli_query($con, "select * from tb_tasas_tarifas where codigo_pago='$codigo_pago' and modalidad='$modalidad' and concepto='$concepto' and monto='$monto' 
                    and referencia='$referencia' and clasificador='$clasificador' and codigo_facultad='$codigo_facultad' and dependencia='$dependencia' and codigo_ser_banco='$codigo_ser_banco' 
                    and cta='$cuenta' and resolucion='$resolucion' and vigencia='$vigencia' and situacion='$situacion' and categoria_transaccion='$categoria_transaccion'");

                    $lineas = mysqli_num_rows($resultado);

                    #Verifica si tiene duplicados en la base de datos el tipo de archivo a importar
                    if ($lineas == 0 && $modalidad != "SELECCIONAR") {
                        $contador++;

                        // Insertar la información del archivo en la base de datos

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
                        $msg = true;
                    } else {

                    }





                } else {
                    $count = "1";
                }

            }




            if (isset($msg)) {
                session_start();
                $_SESSION['mensaje'] = "Se cargaron $contador filas de tasas y tarifas de la manera correcta";
                $_SESSION['icono'] = "success";
                #header('Location: ' . $URL . '/categorias/');
                ?>
                <script>
                    location.href = "<?php echo $URL; ?>/tasas_tarifas";
                </script>
                <?php
            } else {
                #echo "Error las contraseñas no son iguales";
                session_start();
                $_SESSION['mensaje'] = "No se registro ningun dato en la base de datos";
                $_SESSION['icono'] = "error";
                #header('Location: ' . $URL . '/categorias');
                ?>
                <script>
                    location.href = "<?php echo $URL; ?>/tasas_tarifas";
                </script>
                <?php
            }

        }





    } else {
        session_start();
        $_SESSION['mensaje'] = "Error al subir el archivo, solo se permitern archivos en formato Excel (XLSX, XLS)";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/tasas_tarifas');
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error al subir el archivo";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/tasas_tarifas');
}








