<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/modalidad_tyt/listado_modalidad_tyt.php');
include ('../app/controllers/concepto_tyt/listado_concepto_tyt.php');
include ('../app/controllers/referencia_tyt/listado_referencia_tyt.php');
include ('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');
include ('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include ('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include ('../app/controllers/situacion_tyt/listado_situacion_tyt.php');
include ('../app/controllers/tipo_tyt/listado_tipo_tyt.php');


if (empty($_POST['codigo_pagoX'])) {
    $_POST['codigo_pagoX'] = "";
}

if (empty($_POST['modalidadX'])) {
    $_POST['modalidadX'] = "";
}

if (empty($_POST['conceptoX'])) {
    $_POST['conceptoX'] = "";
}

if (empty($_POST['referenciaX'])) {
    $_POST['referenciaX'] = "";
}

if (empty($_POST['dependenciaX'])) {
    $_POST['dependenciaX'] = "";
}

if (empty($_POST['cuentaX'])) {
    $_POST['cuentaX'] = "";
}

if (empty($_POST['resolucionX'])) {
    $_POST['resolucionX'] = "";
}

if (empty($_POST['situacionX'])) {
    $_POST['situacionX'] = "";
}

if (empty($_POST['tipoX'])) {
    $_POST['tipoX'] = "";
}


if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


$sql_tasas_tarifas = "SELECT id_tasas_tarifas, codigo_pago, modalidad, concepto, referencia, 
dependencia, cta, resolucion, situacion, categoria_transaccion, fyh_creacion FROM tb_tasas_tarifas WHERE visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $codigo_pago = $_POST['codigo_pagoX'];
    $modalidad = $_POST['modalidadX'];
    $concepto = $_POST['conceptoX'];
    $referencia = $_POST['referenciaX'];
    $dependencia = $_POST['dependenciaX'];
    $cuenta = $_POST['cuentaX'];
    $resolucion = $_POST['resolucionX'];
    $situacion = $_POST['situacionX'];
    $tipo = $_POST['tipoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_tasas_tarifas'] = $consultar;
    $_SESSION['busqueda_codigo_pago'] = $codigo_pago;
    $_SESSION['busqueda_modalidad'] = $modalidad;
    $_SESSION['busqueda_concepto'] = $concepto;
    $_SESSION['busqueda_referencia'] = $referencia;
    $_SESSION['busqueda_dependencia'] = $dependencia;
    $_SESSION['busqueda_cuenta'] = $cuenta;
    $_SESSION['busqueda_resolucion'] = $resolucion;
    $_SESSION['busqueda_situacion'] = $situacion;
    $_SESSION['busqueda_tipo'] = $tipo;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;


    if (
        !isset($codigo_pago) && !isset($modalidad) && !isset($concepto) && !isset($referencia) && !isset($dependencia)
        && !isset($cuenta) && !isset($resolucion) && !isset($situacion) && !isset($tipo) && !isset($desde) && !isset($hasta)
    ) {
        $sql_tasas_tarifas .= " ";
    } else {

        if (!empty($codigo_pago)) {
            $sql_tasas_tarifas .= " AND codigo_pago like '%" . $codigo_pago . "%'";
        }

        if (!empty($modalidad)) {
            $sql_tasas_tarifas .= " AND modalidad='" . $modalidad . "'";
        }

        if (!empty($concepto)) {
            $sql_tasas_tarifas .= " AND concepto='" . $concepto . "'";
        }

        if (!empty($referencia)) {
            $sql_tasas_tarifas .= " AND referencia='" . $referencia . "'";
        }

        if (!empty($dependencia)) {
            $sql_tasas_tarifas .= " AND dependencia='" . $dependencia . "'";
        }

        if (!empty($cuenta)) {
            $sql_tasas_tarifas .= " AND cta='" . $cuenta . "'";
        }

        if (!empty($resolucion)) {
            $sql_tasas_tarifas .= " AND resolucion='" . $resolucion . "'";
        }

        if (!empty($situacion)) {
            $sql_tasas_tarifas .= " AND situacion='" . $situacion . "'";
        }

        if (!empty($tipo)) {
            $sql_tasas_tarifas .= " AND categoria_transaccion='" . $tipo . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_tasas_tarifas .= " AND fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
    $query_tasas_tarifas->execute();
    $tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);


}


if ($_POST['fecharegistro_desdeX'] > $_POST['fecharegistro_hastaX']) {
    ?>
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Desde la fecha no puede ser mayor hasta la fecha',
            showConfirmButton: false,
            timer: 5000
        })
    </script>
    <?php
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de Tasas y Tarifas</b>
                        <a href="<?php echo $URL; ?>/tasas_tarifas/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nueva TyT</a>
                        <a href="<?php echo $URL; ?>/tasas_tarifas/importar_excel.php" type="button"
                            class="btn btn-md bg-secondary" id="boton_importarExcel">
                            <i class="bi bi-arrow-bar-up"></i> Importar Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/tasas_tarifas/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/tasas_tarifas/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-bar-chart-fill"></i> Tasas y Tarifas</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <?php
    if ($rol_sesion == "ADMINISTRADOR") { ?>
        <script>
            document.getElementById('boton_agregar').style.display = 'inline';
            document.getElementById('boton_importarExcel').style.display = 'inline';
            document.getElementById('boton_exportarExcel').style.display = 'inline';
            document.getElementById('boton_exportarPDF').style.display = 'inline';
        </script>
    <?php } else if ($rol_sesion == "INGRESOS") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'inline';
                document.getElementById('boton_importarExcel').style.display = 'inline';
                document.getElementById('boton_exportarExcel').style.display = 'none';
                document.getElementById('boton_exportarPDF').style.display = 'none';
            </script>
    <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                <script>
                    document.getElementById('boton_agregar').style.display = 'none';
                    document.getElementById('boton_importarExcel').style.display = 'none';
                    document.getElementById('boton_exportarExcel').style.display = 'none';
                    document.getElementById('boton_exportarPDF').style.display = 'none';
                </script>
    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                    <script>
                        document.getElementById('boton_agregar').style.display = 'none';
                        document.getElementById('boton_importarExcel').style.display = 'none';
                        document.getElementById('boton_exportarExcel').style.display = 'none';
                        document.getElementById('boton_exportarPDF').style.display = 'none';
                    </script>
    <?php } else if ($rol_sesion == "DIGA") { ?>
                        <script>
                            document.getElementById('boton_agregar').style.display = 'inline';
                            document.getElementById('boton_importarExcel').style.display = 'inline';
                            document.getElementById('boton_exportarExcel').style.display = 'none';
                            document.getElementById('boton_exportarPDF').style.display = 'none';
                        </script>
    <?php } ?>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">



            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">TASAS Y TARIFAS REGISTRADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: inline;">
                            <form action="index" method="post">

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Pago</label>
                                        <input type="text" class="form-control " name="codigo_pagoX"
                                            onkeypress='return validaNumericos(event)' id="codigo_pago"
                                            placeholder="Codigo de Pago" value="<?php echo $_POST['codigo_pagoX']; ?>">
                                    </div>


                                    <div class="form-group col-md-3" id="">
                                        <label for="">Modalidad</label>
                                        <select class="form-control " name="modalidadX" id="combo_modalidad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($modalidad_tyt_datos as $modalidad_tyt_dato) {
                                                $nombre_modalidad_tabla = $modalidad_tyt_dato['nombre_modalidad']; ?>
                                                <option value="<?php echo $nombre_modalidad_tabla; ?>" <?php if ($nombre_modalidad_tabla == $_POST["modalidadX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_modalidad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="conceptoX" id="combo_concepto"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($concepto_tyt_datos as $concepto_tyt_dato) {
                                                $nombre_concepto_tyt_tabla = $concepto_tyt_dato['nombre_concepto_tyt']; ?>
                                                <option value="<?php echo $nombre_concepto_tyt_tabla; ?>" <?php if ($nombre_concepto_tyt_tabla == $_POST["conceptoX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_concepto_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Referencia</label>
                                        <select class="form-control " name="referenciaX" id="combo_referencia"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($referencia_tyt_datos as $referencia_tyt_dato) {
                                                $nombre_referencia_tabla = $referencia_tyt_dato['nombre_referencia']; ?>
                                                <option value="<?php echo $nombre_referencia_tabla; ?>" <?php if ($nombre_referencia_tabla == $_POST["referenciaX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_referencia_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependenciaX" id="combo_dependencia"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencia_tyt_datos as $dependencia_tyt_dato) {
                                                $nombre_dependencias_tyt_tabla = $dependencia_tyt_dato['nombre_dependencias_tyt']; ?>
                                                <option value="<?php echo $nombre_dependencias_tyt_tabla; ?>" <?php if ($nombre_dependencias_tyt_tabla == $_POST["dependenciaX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_dependencias_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " name="cuentaX" id="combo_cuenta"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($cuenta_tyt_datos as $cuenta_tyt_dato) {
                                                $nombre_cuenta_tyt_tabla = $cuenta_tyt_dato['nombre_cuenta_tyt']; ?>
                                                <option value="<?php echo $nombre_cuenta_tyt_tabla; ?>" <?php if ($nombre_cuenta_tyt_tabla == $_POST["cuentaX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_cuenta_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Resolucion Rectoral</label>
                                        <select class="form-control " name="resolucionX" id="combo_resolucion"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) {
                                                $nombre_resolucion_tyt_tabla = $resolucion_tyt_dato['nombre_resolucion_tyt']; ?>
                                                <option value="<?php echo $nombre_resolucion_tyt_tabla; ?>" <?php if ($nombre_resolucion_tyt_tabla == $_POST["resolucionX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_resolucion_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacionX" id="combo_situacion"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_tyt_datos as $situacion_tyt_dato) {
                                                $nombre_situacion_tyt_tabla = $situacion_tyt_dato['nombre_situacion_tyt']; ?>
                                                <option value="<?php echo $nombre_situacion_tyt_tabla; ?>" <?php if ($nombre_situacion_tyt_tabla == $_POST["situacionX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_situacion_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo</label>
                                        <select class="form-control " name="tipoX" id="combo_tipo" style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_tyt_datos as $tipo_tyt_dato) {
                                                $nombre_tipo_tyt_tabla = $tipo_tyt_dato['nombre_tipo_tyt']; ?>
                                                <option value="<?php echo $nombre_tipo_tyt_tabla; ?>" <?php if ($nombre_tipo_tyt_tabla == $_POST["tipoX"]) { ?>selected="selected" <?php } ?>>
                                                    <?php echo $nombre_tipo_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2">
                                        <label for="">Desde</label>
                                        <input type="date" class="form-control " name="fecharegistro_desdeX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_desdeX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Hasta</label>
                                        <input type="date" class="form-control " name="fecharegistro_hastaX"
                                            class="form-control" value="<?php echo $_POST["fecharegistro_hastaX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;">

                                        <button type="submit" name="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>



                                </div>

                                <script>
                                    function validaNumericos(event) {
                                        if ((event.charCode >= 48 && event.charCode <= 57)) {
                                            return true;
                                        }

                                        if ((event.charCode == 45)) {
                                            return true;
                                        }

                                        if ((event.charCode == 46)) {
                                            return true;
                                        }
                                        return false;
                                    }
                                </script>

                                <script>
                                    $(document).ready(function () {

                                        $('#combo_modalidad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_concepto').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_referencia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_dependencia').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cuenta').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_resolucion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_situacion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_tipo').select2({
                                            theme: 'bootstrap4',
                                        });




                                    });
                                </script>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="example1" class="table table-md table-hover text-center">
                    <thead>
                        <tr style="background-color: midnightblue; color: white">
                            <th>
                                <center>N°</center>
                            </th>

                            <th>
                                <center>Codigo Pago</center>
                            </th>

                            <th>
                                <center>Modalidad</center>
                            </th>

                            <th>
                                <center>Concepto</center>
                            </th>

                            <th>
                                <center>Referencia</center>
                            </th>

                            <th>
                                <center>Dependencia</center>
                            </th>

                            <th>
                                <center>Cuenta</center>
                            </th>

                            <th>
                                <center>Resolucion Rectoral</center>
                            </th>

                            <th>
                                <center>Situacion</center>
                            </th>

                            <th>
                                <center>Tipo</center>
                            </th>


                            <th>
                                <center>Fecha de Registro</center>
                            </th>

                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($tasas_tarifas_datos)) {
                            $tasas_tarifas_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($tasas_tarifas_datos as $tasas_tarifas_dato) {
                                $id_tasas_tarifas = $tasas_tarifas_dato['id_tasas_tarifas']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>


                                    <td>
                                        <?php echo $tasas_tarifas_dato['codigo_pago']; ?>
                                    </td>

                                    <td>
                                        <?php echo substr($tasas_tarifas_dato['modalidad'], 0, 35); ?>
                                    </td>


                                    <td>
                                        <?php echo substr($tasas_tarifas_dato['concepto'], 0, 35); ?>
                                    </td>

                                    <td>
                                        <?php echo substr($tasas_tarifas_dato['referencia'], 0, 35); ?>
                                    </td>

                                    <td>
                                        <?php echo $tasas_tarifas_dato['dependencia']; ?>
                                    </td>

                                    <td>
                                        <?php echo $tasas_tarifas_dato['cta']; ?>
                                    </td>

                                    <td>
                                        <?php echo $tasas_tarifas_dato['resolucion']; ?>
                                    </td>



                                    <td>
                                        <?php
                                        switch ($tasas_tarifas_dato['situacion']) {
                                            case 'SELECCIONAR': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $tasas_tarifas_dato['situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ACTUALIZACION': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $tasas_tarifas_dato['situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'INCORPORACION': ?>
                                                <span class="badge bg-dark">
                                                    <?php echo $tasas_tarifas_dato['situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'NO VIGENTE': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $tasas_tarifas_dato['situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'NO VIGENTE - ELIMINADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $tasas_tarifas_dato['situacion']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo $tasas_tarifas_dato['categoria_transaccion']; ?>
                                    </td>



                                    <td>
                                        <?php $theDate = new DateTime($tasas_tarifas_dato['fyh_creacion']);
                                        echo $tasas_tarifas_dato['fyh_creacion'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>




                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_tasas_tarifas; ?>" type="button"
                                                    class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>

                                                <a href="../app/controllers/tasas_tarifas/download.php?id=<?php echo $id_tasas_tarifas; ?>"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    target="_blank" id="boton_imprimir<?php echo $id_tasas_tarifas; ?>"><i
                                                        class="bi bi-printer"></i>
                                                </a>

                                                <a href="update.php?id=<?php echo $id_tasas_tarifas; ?>" type="button"
                                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_tasas_tarifas; ?>" type="button"
                                                    class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></a>

                                            </div>
                                        </center>

                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        ?>
                    </tbody>

                </table>
                <br>

            </div>




            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Tasas y Tarifas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Tasas y Tarifas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>