<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/anio_nt/listado_de_anios.php');


if (empty($_POST['ntX'])) {
    $_POST['ntX'] = "";
}

if (empty($_POST['aniontX'])) {
    $_POST['aniontX'] = "";
}

if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


if (empty($_POST['proveido_contabilidadX'])) {
    $_POST['proveido_contabilidadX'] = "";
}

if (empty($_POST['fecha_proveido_contabilidadX'])) {
    $_POST['fecha_proveido_contabilidadX'] = "";
}

if (empty($_POST['proveido_digaX'])) {
    $_POST['proveido_digaX'] = "";
}

if (empty($_POST['fecha_proveido_digaX'])) {
    $_POST['fecha_proveido_digaX'] = "";
}

if (empty($_POST['siafX'])) {
    $_POST['siafX'] = "";
}

if (empty($_POST['fecha_giroX'])) {
    $_POST['fecha_giroX'] = "";
}

if (empty($_POST['resolucionX'])) {
    $_POST['resolucionX'] = "";
}



$sql_detalle_egreso = "SELECT *,
t_detalle.fyh_creacion as fyh_creacion_egreso,
anios.anio_nt as anio_nt,
usuario.nombres as nombre_usuario,
usuario.apaterno as apaterno_usuario,
usuario.amaterno as amaterno_usuario 
FROM tb_detalle_egresos as t_detalle 
INNER JOIN tb_usuarios as usuario ON usuario.id_usuario= t_detalle.id_usuario 
LEFT JOIN tb_anio_nt as anios ON  anios.id_anio_nt= t_detalle.anio_nt 
WHERE t_detalle.visible!=1 ";

if (isset($_POST["consultar"])) {

    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $proveido_contabilidad = $_POST['proveido_contabilidadX'];
    $fecha_proveido_contabilidad = $_POST['fecha_proveido_contabilidadX'];
    $proveido_diga = $_POST['proveido_digaX'];
    $fecha_proveido_diga = $_POST['fecha_proveido_digaX'];
    $siaf = $_POST['siafX'];
    $fecha_giro = $_POST['fecha_giroX'];
    $resolucion = $_POST['resolucionX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];


    if (
        !isset($nt) && !isset($anio_nt) && !isset($proveido_contabilidad) && !isset($fecha_proveido_contabilidad)
        && !isset($proveido_diga) && !isset($fecha_proveido_diga) && !isset($siaf) && !isset($fecha_giro)
        && !isset($resolucion) && !isset($desde) && !isset($hasta)
    ) {
        $sql_detalle_egreso .= "";
    } else {

        if (!empty($nt)) {
            $sql_detalle_egreso .= " AND t_detalle.nt like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_detalle_egreso .= " AND anios.anio_nt='" . $anio_nt . "'";
        }

        if (!empty($proveido_contabilidad)) {
            $sql_detalle_egreso .= " AND t_detalle.proveido_contabilidad like '%" . $proveido_contabilidad . "%'";
        }

        if (!empty($fecha_proveido_contabilidad)) {
            $sql_detalle_egreso .= " AND t_detalle.fecha_proveido_contabilidad='" . $fecha_proveido_contabilidad . "'";
        }

        if (!empty($proveido_diga)) {
            $sql_detalle_egreso .= " AND t_detalle.proveido_diga like '%" . $proveido_diga . "%'";
        }

        if (!empty($fecha_proveido_diga)) {
            $sql_detalle_egreso .= " AND t_detalle.fecha_diga='" . $fecha_proveido_diga . "'";
        }

        if (!empty($siaf)) {
            $sql_detalle_egreso .= " AND t_detalle.siaf like '%" . $siaf . "%'";
        }

        if (!empty($fecha_giro)) {
            $sql_detalle_egreso .= " AND t_detalle.fecha_giro='" . $fecha_giro . "'";
        }

        if (!empty($resolucion)) {
            $sql_detalle_egreso .= " AND t_detalle.resolucion like '%" . $resolucion . "%'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_detalle_egreso .= " AND t_detalle.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_detalle_egreso = $pdo->prepare($sql_detalle_egreso);
    $query_detalle_egreso->execute();
    $detalle_egreso_datos = $query_detalle_egreso->fetchAll(PDO::FETCH_ASSOC);


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
                    <h1 class="m-0"><b>Consulta de Egresos de Pagos Realizado</b>

                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Pagos Realizado</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title">EGRESOS REGISTRADO</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body table-responsive" style="display: inline;">
                            <form action="index" method="post">

                                <div class="form-row">


                                    <div class="form-group col-md-2">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="ntX" id="nt" class="form-control"
                                            value="<?php echo $_POST['ntX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <label for="">Año</label>
                                        <select class="form-control " name="aniontX" id="anio_nt" style="width:100%"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $anio_nt_tabla; ?>" <?php if ($anio_nt_tabla == $_POST["aniontX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Proveido Contabilidad</label>
                                        <input type="text" class="form-control " name="proveido_contabilidadX"
                                            id="proveido_contabilidad" class="form-control"
                                            value="<?php echo $_POST['proveido_contabilidadX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha Prov. Cont.</label>
                                        <input type="date" class="form-control " name="fecha_proveido_contabilidadX"
                                            class="form-control"
                                            value="<?php echo $_POST["fecha_proveido_contabilidadX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Proveido DIGA</label>
                                        <input type="text" class="form-control " name="proveido_digaX"
                                            id="proveido_diga" class="form-control"
                                            value="<?php echo $_POST['proveido_digaX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha Prov. DIGA</label>
                                        <input type="date" class="form-control " name="fecha_proveido_digaX"
                                            class="form-control" value="<?php echo $_POST["fecha_proveido_digaX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siafX" id="siaf"
                                            class="form-control" value="<?php echo $_POST['siafX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Fecha Giro</label>
                                        <input type="date" class="form-control " name="fecha_giroX" class="form-control"
                                            value="<?php echo $_POST["fecha_giroX"] ?>">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Resolucion</label>
                                        <input type="text" class="form-control " name="resolucionX" id="resolucion"
                                            class="form-control" value="<?php echo $_POST['resolucionX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
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

                                        <button type="submit" name="consultar" id="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
                                    </div>



                                </div>

                                <script>
                                    document.getElementById('nt').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('proveido_contabilidad').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('proveido_diga').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('siaf').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });

                                    document.getElementById('resolucion').addEventListener('keydown', function (e) {

                                        //si presiona el teclado Enter
                                        if (e.keyCode === 13) {
                                            // entonces haces lo que quieras para poder reaccionar a la pulsación del enter.

                                            // se establecera como clic en el boton Iniciar Consulta
                                            $("#consultar").click();
                                        }
                                    });


                                </script>

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
                                        $('#anio_nt').select2({
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
                                <center>NT</center>
                            </th>
                            <th>
                                <center>Año</center>
                            </th>
                            <th>
                                <center>Proveido Contabilidad</center>
                            </th>
                            <th>
                                <center>Fecha Prov. Cont.</center>
                            </th>
                            <th>
                                <center>Proveido DIGA</center>
                            </th>
                            <th>
                                <center>Fecha Prov. DIGA</center>
                            </th>
                            <th>
                                <center>SIAF</center>
                            </th>
                            <th>
                                <center>Fecha Giro</center>
                            </th>
                            <th>
                                <center>Resolucion Rectoral</center>
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
                        if (!isset($detalle_egreso_datos)) {
                            $detalle_egreso_datos = "";
                        } else {

                            $contador = 0;
                            foreach ($detalle_egreso_datos as $detalle_egreso_dato) {
                                $id_detalle_egreso = $detalle_egreso_dato['id_detalle_egreso']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['nt']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['anio_nt']; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['proveido_contabilidad']; ?>
                                    </td>
                                    <td>
                                        <?php

                                        if ($detalle_egreso_dato['fecha_proveido_contabilidad'] == "0000-00-00") {
                                            $fecha_contabilidad = "";
                                        } else {
                                            $theDate = new DateTime($detalle_egreso_dato['fecha_proveido_contabilidad']);
                                            $fecha_contabilidad = $theDate->format('d/m/Y');
                                        }




                                        echo $fecha_contabilidad;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['proveido_diga']; ?>
                                    </td>
                                    <td>
                                        <?php

                                        if ($detalle_egreso_dato['fecha_diga'] == "0000-00-00") {
                                            $fecha_diga = "";
                                        } else {
                                            $theDate = new DateTime($detalle_egreso_dato['fecha_diga']);
                                            $fecha_diga = $theDate->format('d/m/Y');
                                        }

                                        echo $fecha_diga;

                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['siaf']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($detalle_egreso_dato['fecha_giro'] == "0000-00-00") {
                                            $fecha_giro = "";
                                        } else {
                                            $theDate = new DateTime($detalle_egreso_dato['fecha_giro']);
                                            $fecha_giro = $theDate->format('d/m/Y');
                                        }

                                        echo $fecha_giro; ?>
                                    </td>
                                    <td>
                                        <?php echo $detalle_egreso_dato['resolucion']; ?>
                                    </td>
                                    <td>
                                        <?php $theDate = new DateTime($detalle_egreso_dato['fyh_creacion_egreso']);
                                        echo $detalle_egreso_dato['fyh_creacion_egreso'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>


                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                    class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>
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


<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>


<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 10,
            "language": {
                "emptyTable": "No hay información",
                "info": "Registros encontrados: _TOTAL_",
                "infoEmpty": "Registros encontrados: 0",
                "infoFiltered": "(Filtrado de _MAX_ total Egresos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Egresos",
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