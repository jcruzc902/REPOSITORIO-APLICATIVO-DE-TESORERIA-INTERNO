<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

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

include('../app/controllers/anio_nt/listado_de_anios.php');




?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Pago</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_estado_egresos/index.php"><i
                                    class="bi bi-card-checklist"></i> Detalle Estado de Egreso</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            pago</a></li>
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
                            <h3 class="card-title">Digite los datos a detallar sobre el nuevo egreso</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/detalle_estado_egresos/create.php" method="post">

                                <div id="show_item">
                                    <div class="form-row">
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>"
                                            hidden>
                                        <input type="text" name="facultad" value="<?php echo $facultad; ?>" hidden>
                                        <input type="text" name="actividad" value="<?php echo $actividad; ?>" hidden>
                                        <input type="text" name="subactividad" value="<?php echo $subactividad; ?>"
                                            hidden>
                                        <input type="text" name="periodo" value="<?php echo $periodo; ?>" hidden>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">NT</label>
                                            <input type="text" class="form-control " name="nt" id="nt"
                                                onkeypress='return validaNumericos(event)' placeholder="Numero Tramite"
                                                required>
                                        </div>

                                        <?php
                                        date_default_timezone_set("America/Lima");
                                        $anio_nt = date('Y'); //año actual
                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Año NT</label>
                                            <select class="form-control " name="anio_nt" id="anio_nt" style="width:100%"
                                                required>
                                                <option value="">SELECCIONAR</option>
                                                <?php
                                                foreach ($anios_datos as $anios_dato) {
                                                    $anio_nt_tabla = $anios_dato['anio_nt'];
                                                    $id_anio_nt = $anios_dato['id_anio_nt'];
                                                    ?>
                                                    <option value="<?php echo $anios_dato['id_anio_nt']; ?>" <?php if ($anio_nt_tabla == $anio_nt) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $anios_dato['anio_nt']; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Proveido Contabilidad</label>
                                            <input type="text" class="form-control " name="proveido_contabilidad"
                                                id="nt" onkeypress='return validaNumericos(event)'
                                                placeholder="Numero-Año">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Proveido Contabilidad</label>
                                            <input type="date" class="form-control " name="fecha_proveido_contabilidad"
                                                id="fecha_proveido_contabilidad">
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Proveido DIGA</label>
                                            <input type="text" class="form-control " name="proveido_diga"
                                                id="proveido_diga" onkeypress='return validaNumericos(event)'
                                                placeholder="Numero-Año">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Proveido DIGA</label>
                                            <input type="date" class="form-control " name="fecha_proveido_diga"
                                                id="fecha_proveido_diga">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Oficio OCLSA-ORH</label>
                                            <input type="text" class="form-control " name="oficio_oclsa_orh"
                                                id="oficio_oclsa_orh" placeholder="Numero-Año-Dependencias">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha OCLSA-ORH</label>
                                            <input type="date" class="form-control " name="fecha_oclsa_orh"
                                                id="fecha_oclsa_orh">
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Detalle</label>
                                            <input type="text" class="form-control " name="detalle" id="detalle"
                                                placeholder="Detalle">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Orden de Compra</label>
                                            <input type="text" class="form-control " name="orden_compra"
                                                id="orden_compra" onkeypress='return validaNumericos(event)'
                                                placeholder="N° Orden Compra">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Orden de Servicio</label>
                                            <input type="text" class="form-control " name="orden_servicio"
                                                id="orden_servicio" onkeypress='return validaNumericos(event)'
                                                placeholder="N° Orden Servicio">
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF</label>
                                            <input type="text" class="form-control " name="siaf" id="siaf"
                                                onkeypress='return validaNumericos(event)' placeholder="N° SIAF"
                                                required>
                                        </div>


                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Monto (S/.)</label>
                                            <input type="text" class="form-control " name="monto" id="monto"
                                                onkeypress='return validaNumericos(event)' placeholder="Monto" required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Egreso (S/.)</label>
                                            <input type="text" class="form-control " name="egreso" id="egreso"
                                                onkeypress='return validaNumericos(event)' placeholder="Egreso" required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Ingreso (S/.)</label>
                                            <input type="text" class="form-control " name="ingreso" id="ingreso"
                                                onkeypress='return validaNumericos(event)' placeholder="Ingreso" required>
                                        </div>

                                        <div class="form-group col-md-6" id="">
                                            
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nota de Pago</label>
                                            <input type="text" class="form-control " name="comprobante" id="comprobante"
                                                placeholder="N° Nota de Pago">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Pago</label>
                                            <input type="date" class="form-control " name="fecha_pago" id="fecha_pago">
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Giro</label>
                                            <input type="date" class="form-control " name="fecha_giro" id="fecha_giro">
                                        </div>

                                        <div class="form-group col-md-6" id="">
                                            
                                        </div>


                                        <div class="form-group col-md-8" id="">
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto" id="asunto"
                                                placeholder="Describa el asunto para el informe" required>
                                        </div>



                                        <?php

                                        $anio_actual = date("Y"); //anio

                                        $sql_detalle_egresos = "SELECT MAX(informe) as numero_informe FROM tb_detalle_egresos WHERE YEAR(fecha_informe)='$anio_actual' AND visible!=1";
                                        $query_detalle_egresos = $pdo->prepare($sql_detalle_egresos);
                                        $query_detalle_egresos->execute();
                                        $detalle_egresos_datos = $query_detalle_egresos->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($detalle_egresos_datos as $detalle_egresos_dato) {
                                            $numero_informe = $detalle_egresos_dato['numero_informe'];
                                        }

                                        if ($numero_informe != null) {
                                            $numero_informe = $detalle_egresos_dato['numero_informe'] + 1; //autoincrementa el numero de informe
                                        } else {
                                            $numero_informe = 1; //empieza con 1
                                        }

                                        
                                        ?>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Informe</label>
                                            <input type="text" class="form-control " name="informe" id="informe"
                                                value="<?php echo $numero_informe; ?>" readonly>
                                        </div>

                                        <?php
                                        $fecha_actual = date("Y-m-d");
                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Informe</label>
                                            <input type="date" class="form-control " name="fecha_informe"
                                                id="fecha_informe" value="<?php echo $fecha_actual; ?>">
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Resolucion</label>
                                            <input type="text" class="form-control " name="resolucion" id="resolucion"
                                                onkeypress='return validaNumericos(event)' placeholder="Numero-Año"
                                                required>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Resolucion</label>
                                            <input type="date" class="form-control " name="fecha_resolucion"
                                                id="fecha_resolucion" required>
                                        </div>









                                        <div class="form-group col-md-12" align="right">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="bi bi-floppy-fill"></i>
                                                Guardar</button>
                                            <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                    class="bi bi-x-circle-fill"></i> Cancelar</a>

                                        </div>
                                    </div>



                                </div>
                            </form>
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
                                $('#anio_nt').select2({
                                    theme: 'bootstrap4',
                                });



                            });
                        </script>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/parte2.php'); ?>