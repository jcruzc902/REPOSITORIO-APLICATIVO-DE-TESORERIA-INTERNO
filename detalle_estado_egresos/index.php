<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/detalle_estado_egresos/listado_detalle_egreso.php');

if (
    isset($_SESSION['facultad']) && isset($_SESSION['actividad'])
    && isset($_SESSION['subactividad']) && isset($_SESSION['periodo'])
) {
    $facultad = $_SESSION['facultad'];
    $actividad = $_SESSION['actividad'];
    $subactividad = $_SESSION['subactividad'];
    $periodo = $_SESSION['periodo'];
} else {
    $facultad = "";
    $actividad = "";
    $subactividad = "";
    $periodo = "";
}

$total = null;

switch ($facultad) {
    case "CENTRO PREUNIVERSITARIO DE LA UNIVERSIDAD NACIONAL FEDERICO VILLARREAL":
        $facultad = "CEPREVI";
        break;
    case "CENTRO DE GESTIÓN CULTURAL FEDERICO VILLARREAL":
        $facultad = "CGCFV";
        break;
    case "CENTRO UNIVERSITARIO DE IDIOMAS":
        $facultad = "CUDI";
        break;
    case "CENTRO DE PRODUCCIÓN DE BIENES Y SERVICIOS":
        $facultad = "CUPBS";
        break;
    case "CENTRO UNIVERSITARIO DE RESPONSABILIDAD SOCIAL":
        $facultad = "CURES";
        break;
    case "EDITORIAL UNIVERSITARIA":
        $facultad = "EU";
        break;
    case "ESCUELA UNIVERSITARIA DE EDUCACION A DISTANCIA":
        $facultad = "EUDED";
        break;
    case "ESCUELA UNIVERSITARIA DE POSTGRADO":
        $facultad = "EUPG";
        break;
    case "FACULTAD DE ADMINISTRACIÓN":
        $facultad = "FA";
        break;
    case "FACULTAD DE PSICOLOGIA":
        $facultad = "FAPS";
        break;
    case "FACULTAD DE ARQUITECTURA Y URBANISMO":
        $facultad = "FAU";
        break;
    case "FACULTAD DE CIENCIAS SOCIALES":
        $facultad = "FCCSS";
        break;
    case "FACULTAD DE CIENCIAS ECONOMICAS":
        $facultad = "FCE";
        break;
    case "FACULTAD DE CIENCIAS FINANCIERAS Y CONTABLES":
        $facultad = "FCFC";
        break;
    case "FACULTAD DE CIENCIAS NATURALES Y MATEMATICA":
        $facultad = "FCNM";
        break;
    case "FACULTAD DE DERECHO Y CIENCIA POLITICA":
        $facultad = "FDCP";
        break;
    case "FACULTAD DE EDUCACION":
        $facultad = "FE";
        break;
    case "FACULTAD DE HUMANIDADES":
        $facultad = "FH";
        break;
    case "FACULTAD DE INGENIERIA CIVIL":
        $facultad = "FIC";
        break;
    case "FACULTAD DE INGENIERIA ELECTRONICA E INFORMATICA":
        $facultad = "FIEI";
        break;
    case "FACULTAD DE INGENIERIA GEOGRAFICA, AMBIENTAL Y ECOTURISMO":
        $facultad = "FIGAE";
        break;
    case "FACULTAD DE INGENIERIA INDUSTRIAL Y DE SISTEMAS":
        $facultad = "FIIS";
        break;
    case "FACULTAD DE MEDICINA DE HIPOLITO UNANUE":
        $facultad = "FMHU";
        break;
    case "FACULTAD DE ODONTOLOGIA":
        $facultad = "FO";
        break;
    case "FACULTAD DE OCEANOGRAFIA, PESQUERIA Y CC.AA.":
        $facultad = "FOPCA";
        break;
    case "FACULTAD DE TECNOLOGIA MEDICA":
        $facultad = "FTM";
        break;
    case "FACULTADES":
        $facultad = "FACULT.";
        break;
    case "INSTITUTO CENTRAL DE GESTION DE LA INVESTIGACION":
        $facultad = "ICGI";
        break;
    case "INSTITUTO DE RECREACION, EDUCACION FISICA Y DEPORTE":
        $facultad = "IRED";
        break;
    case "OFICINA CENTRAL DE ADMISION":
        $facultad = "OCA";
        break;
    case "OFICINA CENTRAL DE BIENESTAR UNIVERSITARIO":
        $facultad = "OCBU";
        break;
    case "OFICINA CENTRAL DE REGISTRO ACADEMICO":
        $facultad = "OCRAC";
        break;
    case "OFICINA CENTRAL DE LOGISTICA Y SERVICIOS AUXILIARES":
        $facultad = "OCLSA";
        break;
    case "OFICINA DE TESORERIA":
        $facultad = "OT";
        break;
    case "SECRETARIA GENERAL":
        $facultad = "SG";
        break;
    case "VICE-RECTORADO DE INVESTIGACION":
        $facultad = "VRIN";
        break;

}

?>





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-9">
                    <h1 class="m-0"><b>Consulta de NT: <?php echo $facultad; ?> </b>
                        <a href="<?php echo $URL; ?>/detalle_estado_egresos/create.php" type="button"
                            class="btn btn-md bg-primary" id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Pago</a>

                    </h1>

                    <?php if ($rol_sesion == "SECRETARIA") { ?>
                        <script>
                            //ocultar las secciones
                            document.getElementById('boton_agregar').style.display = 'none';

                        </script>
                    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                            <script>
                                //ocultar las secciones
                                document.getElementById('boton_agregar').style.display = 'none';

                            </script>

                    <?php } else if ($rol_sesion == "ADMINISTRADOR") { ?>
                                <script>
                                    //ocultar las secciones
                                    document.getElementById('boton_agregar').style.display = 'inline';

                                </script>

                    <?php } ?>

                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-card-checklist"></i> Detalle Egresos</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">





            <div class="table-responsive">
                <table id="example1" class="table table-md table-hover text-center">
                    <thead>
                        <tr style="background-color: midnightblue; color: white">
                            <th>
                                <center>N°</center>
                            </th>
                            <th>
                                <center>Informe</center>
                            </th>
                            <th>
                                <center>Fecha Informe</center>
                            </th>
                            <th>
                                <center>NT</center>
                            </th>
                            <th>
                                <center>Detalle</center>
                            </th>
                            <th>
                                <center>Tipo de actividad</center>
                            </th>

                            <th>
                                <center>Resolucion</center>
                            </th>
                            <th>
                                <center>Fecha Resolucion</center>
                            </th>
                            <th>
                                <center>SIAF</center>
                            </th>
                            <th>
                                <center>Monto</center>
                            </th>
                            <th>
                                <center>Egresos</center>
                            </th>
                            <th>
                                <center>Ingresos</center>
                            </th>

                            <th>
                                <center>Acciones</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $contador = 0;
                        foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
                            $id_detalle_egreso = $detalle_egresos_dato['id_detalle_egreso']; ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $contador = $contador + 1; ?>
                                    </center>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['informe']; ?>
                                </td>
                                <td>
                                    <?php
                                    $theDate = new DateTime($detalle_egresos_dato['fecha_informe']);
                                    $fechaInforme = $theDate->format('d/m/Y');

                                    echo $fechaInforme; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['nt']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['detalle']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['actividad_principal']; ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['resolucion']; ?>
                                </td>
                                <td>
                                    <?php
                                    if ($detalle_egresos_dato['fecha_resolucion']=="0000-00-00") {
                                        $fechaResolucion= "-";
                                    }else{
                                        
                                        $theDate = new DateTime($detalle_egresos_dato['fecha_resolucion']);
                                        $fechaResolucion = $theDate->format('d/m/Y');
                                    }


                                    echo $fechaResolucion;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $detalle_egresos_dato['siaf']; ?>
                                </td>
                                <td>
                                    <?php

                                    $total = $total + $detalle_egresos_dato['monto'];

                                    $monto_detalle = floatval($detalle_egresos_dato['monto']);
                                    $monto_detalle = number_format($monto_detalle, 2, '.', ',');

                                    echo $monto_detalle; ?>
                                </td>
                                <td>
                                    <?php
                                    $monto_egresos = floatval($detalle_egresos_dato['egresos']);
                                    $monto_egresos = number_format($monto_egresos, 2, '.', ','); //convertir int a decimal
                                
                                    echo $monto_egresos; ?>
                                </td>
                                <td>
                                    <?php
                                    $monto_ingresos = floatval($detalle_egresos_dato['ingresos']);
                                    $monto_ingresos = number_format($monto_ingresos, 2, '.', ','); //convertir int a decimal
                                

                                    echo $monto_ingresos; ?>
                                </td>

                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <a href="show.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm btn-success"
                                                id="boton_consultar<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-search"></i></a>

                                            <a href="informe.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm" style="background-color: bisque;"
                                                id="boton_imprimir<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-printer"></i>
                                            </a>

                                            <a href="update.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm btn-primary"
                                                id="boton_actualizar<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-pencil-square"></i>
                                            </a>

                                            <a href="delete.php?id=<?php echo $id_detalle_egreso; ?>" type="button"
                                                class="btn btn-sm btn-danger"
                                                id="boton_eliminar<?php echo $id_detalle_egreso; ?>"><i
                                                    class="bi bi-x-lg"></i>
                                            </a>



                                        </div>
                                    </center>


                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                    </tbody>

                </table>

                <br>

                <div class="form-group col-md-2 float-left" id="">
                    <?php
                    $total = number_format($total, 2, '.', ','); //convertir int a decimal
                    ?>
                    <label for="">Monto Total (S/.)</label>
                    <input type="text" class="form-control" name="total" value="<?php echo $total; ?>" readonly>
                </div>

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
            "responsive": false, "lengthChange": true, "autoWidth": false, "searching": true,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>