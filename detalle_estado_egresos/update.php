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

include('../app/controllers/detalle_estado_egresos/show_detalle_egreso.php');
include('../app/controllers/anio_nt/listado_de_anios.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Actualizar Pago: NT
                            <?php echo $nt . " - " . $anio_nt; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_estado_egresos"><i
                                    class="bi bi-card-checklist"></i> Detalle Estado de Cuenta</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar pago</a>
                        </li>
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
                            <h3 class="card-title">Digite los datos del pago realizado a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/detalle_estado_egresos/update.php" method="post">
                                        <input type="text" name="id_detalle_egreso" value="<?php echo $id_detalle_egreso; ?>"
                                            hidden>
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>"
                                            hidden>
                                        <input type="text" name="facultad" value="<?php echo $facultad; ?>" hidden>
                                        <input type="text" name="actividad" value="<?php echo $actividad; ?>" hidden>
                                        <input type="text" name="subactividad" value="<?php echo $subactividad; ?>"
                                            hidden>
                                        <input type="text" name="periodo" value="<?php echo $periodo; ?>" hidden>

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="">
                                        <label for="">NT</label>
                                        <input type="text" class="form-control " name="nt" id="nt"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero Tramite" value="<?php echo $nt; ?>">
                                    </div>


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
                                        <input type="text" class="form-control " name="proveido_contabilidad" id="nt"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero-Año" value="<?php echo $proveido_contabilidad; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Proveido Contabilidad</label>
                                        <input type="date" class="form-control " name="fecha_proveido_contabilidad"
                                            id="fecha_proveido_contabilidad" value="<?php echo $fecha_proveido_contabilidad; ?>">
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Proveido DIGA</label>
                                        <input type="text" class="form-control " name="proveido_diga" id="proveido_diga"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero-Año" value="<?php echo $proveido_diga; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Proveido DIGA</label>
                                        <input type="date" class="form-control " name="fecha_proveido_diga"
                                            id="fecha_proveido_diga" value="<?php echo $fecha_diga; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Oficio OCLSA-ORH</label>
                                        <input type="text" class="form-control " name="oficio_oclsa_orh"
                                            id="oficio_oclsa_orh" placeholder="Numero-Año-Dependencia" value="<?php echo $oficio; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha OCLSA-ORH</label>
                                        <input type="date" class="form-control " name="fecha_oclsa_orh"
                                            id="fecha_oclsa_orh" value="<?php echo $fecha_oficio; ?>">
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Detalle</label>
                                        <input type="text" class="form-control " name="detalle" id="detalle"
                                            placeholder="Detalle" value="<?php echo $detalle; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Orden de Compra</label>
                                        <input type="text" class="form-control " name="orden_compra" id="orden_compra"
                                            onkeypress='return validaNumericos(event)' placeholder="N° Orden Compra" value="<?php echo $nro_orden_compra; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Orden de Servicio</label>
                                        <input type="text" class="form-control " name="orden_servicio"
                                            id="orden_servicio" onkeypress='return validaNumericos(event)'
                                            placeholder="N° Orden Servicio" value="<?php echo $nro_orden_servicio; ?>">
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siaf" id="siaf"
                                            onkeypress='return validaNumericos(event)' placeholder="N° SIAF" value="<?php echo $siaf; ?>" required>
                                    </div>


                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto (S/.)</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' placeholder="Monto" value="<?php echo $monto; ?>" >
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">Egreso (S/.)</label>
                                            <input type="text" class="form-control " name="egreso" id="egreso"
                                                onkeypress='return validaNumericos(event)' placeholder="Egreso" value="<?php echo $egresos; ?>" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                            <label for="">Ingreso (S/.)</label>
                                            <input type="text" class="form-control " name="ingreso" id="ingreso"
                                                onkeypress='return validaNumericos(event)' placeholder="Ingreso" value="<?php echo $ingresos; ?>" required>
                                    </div>

                                    <div class="form-group col-md-6" id="">
                                            
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nota de Pago</label>
                                        <input type="text" class="form-control " name="comprobante" id="comprobante"
                                            placeholder="N° Nota de Pago" value="<?php echo $comprobante_pago; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Pago</label>
                                        <input type="date" class="form-control " name="fecha_pago" id="fecha_pago" value="<?php echo $fecha_pago;?>">
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Giro</label>
                                        <input type="date" class="form-control " name="fecha_giro" id="fecha_giro" value="<?php echo $fecha_giro; ?>">
                                    </div>

                                    <div class="form-group col-md-6" id="">
                                            
                                    </div>


                                    <div class="form-group col-md-8" id="">
                                        <label for="">Asunto</label>
                                        <input type="text" class="form-control " name="asunto" id="asunto"
                                            placeholder="Describa el asunto para el informe" value="<?php echo $asunto; ?>" required>
                                    </div>


                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informe" id="informe"
                                            value="<?php echo $informe; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Informe</label>
                                        <input type="date" class="form-control " name="fecha_informe" id="fecha_informe"
                                            value="<?php echo $fecha_informe; ?>">
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Resolucion</label>
                                        <input type="text" class="form-control " name="resolucion" id="resolucion"
                                            onkeypress='return validaNumericos(event)' placeholder="Numero-Año" value="<?php echo $resolucion; ?>"
                                            required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Resolucion</label>
                                        <input type="date" class="form-control " name="fecha_resolucion"
                                            id="fecha_resolucion" value="<?php echo $fecha_resolucion; ?>">
                                    </div>





                                    

                                </div>


                                <div class="form-group col-md-12" align="right">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>
                                        Guardar</button>
                                    <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                            class="bi bi-x-circle-fill"></i> Cancelar</a>

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

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>