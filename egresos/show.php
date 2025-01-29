<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');

include('../app/controllers/anio_nt/listado_de_anios.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');
include('../app/controllers/resolucion_egresos/listado_resolucion_egresos.php');
include('../app/controllers/detalle_estado_egresos/show_detalle_egreso.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Datos del Pago Realizado : NT
                            <?php echo $nt . " - " . $anio_nt; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/egresos"><i
                                    class="bi bi-card-checklist"></i> Detalle Estado de Cuenta</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-search"></i> Informacion del Pago</a></li>
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
                            <h3 class="card-title">Informacion del pago realizado seleccionado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="#">

                            <div class="form-row">

                                <div class="form-group col-md-12" id="">
                                        <h4><b><u>INFORME DE EGRESOS</u></b></h4>
                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">NT</label>
                                    <input type="text" class="form-control " name="nt" id="nt"
                                        onkeypress='return validaNumericos(event)' placeholder="Numero Tramite"
                                        value="<?php echo $nt; ?>" disabled>
                                </div>


                                <div class="form-group col-md-2" id="">
                                    <label for="">Año NT</label>
                                    <select class="form-control " name="anio_nt" id="anio_nt" style="width:100%"
                                    disabled>
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
                                        onkeypress='return validaNumericos(event)' placeholder="Numero-Año"
                                        value="<?php echo $proveido_contabilidad; ?>" disabled>
                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Fecha Proveido Contabilidad</label>
                                    <input type="date" class="form-control " name="fecha_proveido_contabilidad"
                                        id="fecha_proveido_contabilidad"
                                        value="<?php echo $fecha_proveido_contabilidad; ?>" disabled>
                                </div>

                                <div class="form-group col-md-4" id="">

                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Proveido DIGA</label>
                                    <input type="text" class="form-control " name="proveido_diga" id="proveido_diga"
                                        onkeypress='return validaNumericos(event)' placeholder="Numero-Año"
                                        value="<?php echo $proveido_diga; ?>" disabled>
                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Fecha Proveido DIGA</label>
                                    <input type="date" class="form-control " name="fecha_proveido_diga"
                                        id="fecha_proveido_diga" value="<?php echo $fecha_diga; ?>" disabled>
                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Oficio OCLSA-ORH</label>
                                    <input type="text" class="form-control " name="oficio_oclsa_orh"
                                        id="oficio_oclsa_orh" placeholder="Numero-Año-Dependencia"
                                        value="<?php echo $oficio; ?>" disabled>
                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Fecha OCLSA-ORH</label>
                                    <input type="date" class="form-control " name="fecha_oclsa_orh"
                                        id="fecha_oclsa_orh" value="<?php echo $fecha_oficio; ?>" disabled>
                                </div>

                                <div class="form-group col-md-4" id="">

                                </div>

                                <div class="form-group col-md-2" id="">
                                        <label for="">Total de Egresos (S/.)</label>
                                        <input type="text" class="form-control " name="total_egresos" id="total_egresos" value="<?php echo $total_egresos; ?>" disabled>
                                </div>

                                <div class="form-group col-md-10" id="">

                                </div>

                                <div class="form-group col-md-8" id="">
                                    <label for="">Asunto</label>
                                    <input type="text" class="form-control " name="asunto" id="asunto"
                                        placeholder="Describa el asunto para el informe"
                                        value="<?php echo $asunto; ?>" disabled>
                                </div>

                                <div class="form-group col-md-8" id="">
                                    <label for="">Descripción del informe</label>
                                    <textarea type="text" class="form-control " name="descripcion" rows="4" id="descripcion"
                                        placeholder="Descripción del informe"
                                        disabled><?php echo $descripcion; ?></textarea>
                                </div>


                                <div class="form-group col-md-4" id="">

                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Informe</label>
                                    <input type="text" class="form-control " name="informe" id="informe"
                                        value="<?php echo $informe; ?>" disabled>
                                </div>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Fecha Informe</label>
                                    <input type="date" class="form-control " name="fecha_informe" id="fecha_informe"
                                        value="<?php echo $fecha_informe; ?>" disabled>
                                </div>


                                <div class="form-group col-md-2" id="">
                                    <label for="">Resolucion</label>
                                    
                                        <select class="form-control " name="resolucion" id="resolucion"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_egresos_datos as $resolucion_egresos_dato) {
                                                $resolucion_tabla = $resolucion_egresos_dato['resolucion'];
                                                $id_resoluciones_egresos = $resolucion_egresos_dato['id_resoluciones_egresos'];
                                                ?>
                                                    <option value="<?php echo $resolucion_egresos_dato['resolucion']; ?>"
                                                        <?php if ($resolucion_tabla == $resolucion) { ?> selected="selected"
                                                        <?php } ?>>
                                                        <?php echo $resolucion_egresos_dato['resolucion']; ?>
                                                    </option>
                                                    <?php
                                            }
                                            ?>
                                        </select>
                                        


                                </div>

                                <?php

                                $sql_resoluciones_egresos = "SELECT * FROM tb_resoluciones_egresos where visible!=1 and resolucion='" . $resolucion . "'";
                                $query_resoluciones_egresos = $pdo->prepare($sql_resoluciones_egresos);
                                $query_resoluciones_egresos->execute();
                                $resolucion_egresos_datos = $query_resoluciones_egresos->fetchAll(PDO::FETCH_ASSOC);

                                ?>

                                <div class="form-group col-md-2" id="">
                                    <label for="">Fecha Resolucion</label>
                                    <select class="form-control " name="fecha_resolucion" id="fecha_resolucion"
                                        style="width:100%" disabled>
                                        <?php
                                        foreach ($resolucion_egresos_datos as $resolucion_egresos_dato) {
                                            $fecha_resolucion_tabla = $resolucion_egresos_dato['fecha'];
                                            $id_resoluciones_egresos = $resolucion_egresos_dato['id_resoluciones_egresos'];

                                            $theDate = new DateTime($resolucion_egresos_dato["fecha"]);
                                            $resolucion_egresos_dato["fecha"] = $theDate->format('d/m/Y');

                                            ?>
                                                <option value="<?php echo $resolucion_egresos_dato['fecha']; ?>" <?php if ($fecha_resolucion_tabla == $fecha_resolucion) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $resolucion_egresos_dato['fecha']; ?>
                                                </option>
                                                <?php
                                        }
                                        ?>


                                    </select>
                                </div>

                                <script>
                                    $(document).ready(function () {

                                        $('#resolucion').change(function () {

                                            //$('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                            $("#resolucion option:selected").each(function () {
                                                var resolucion = $('#resolucion').val();
                                                $.post("../app/controllers/resolucion_egresos/consulta_resolucion.php",
                                                    { resolucion: resolucion }, function (data) {
                                                        $("#fecha_resolucion").html(data);
                                                    });
                                            });

                                        });
                                    });
                                </script>


                                    <hr style="width: 100%" id="hr">

                                    <div class="form-group col-md-12" id="">
                                        <h4><b><u>ESTADO DE CUENTA</u></b></h4>
                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Especialidad</label>
                                        <input type="text" class="form-control " name="especialidad" id="especialidad" placeholder="Especialidad" value="<?php echo $especialidad; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Detalle</label>
                                        <input type="text" class="form-control " name="detalle" id="detalle" placeholder="Detalle" value="<?php echo $detalle; ?>" disabled>
                                    </div>

                                    

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Periodo</label>
                                        <input type="text" class="form-control " name="periodo_meses" id="periodo_meses" placeholder="Periodo" value="<?php echo $periodo_meses; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-6" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Orden de Compra</label>
                                        <input type="text" class="form-control " name="orden_compra"
                                            id="orden_compra" onkeypress='return validaNumericos(event)'
                                            placeholder="N° Orden Compra" value="<?php echo $nro_orden_compra; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Orden de Servicio</label>
                                        <input type="text" class="form-control " name="orden_servicio"
                                            id="orden_servicio" onkeypress='return validaNumericos(event)'
                                            placeholder="N° Orden Servicio" value="<?php echo $nro_orden_servicio; ?>" disabled>
                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siaf" id="siaf"
                                            onkeypress='return validaNumericos(event)' placeholder="N° SIAF"
                                            value="<?php echo $siaf; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-6" id="">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto (S/.)</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' placeholder="Monto" value="<?php echo $monto; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Total de Egresos (S/.)</label>
                                        <input type="text" class="form-control " name="egreso" id="egreso"
                                            onkeypress='return validaNumericos(event)'
                                            placeholder="Total de Egresos" value="<?php echo $egresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Total de Ingresos (S/.)</label>
                                        <input type="text" class="form-control " name="ingreso" id="ingreso"
                                            onkeypress='return validaNumericos(event)' placeholder="Total de Ingresos"
                                            value="<?php echo $ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Saldo Final (S/.)</label>
                                        <input type="text" class="form-control " name="saldo" id="saldo"
                                            onkeypress='return validaNumericos(event)' placeholder="Total de Ingresos"
                                            value="<?php echo $saldo; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nota de Pago</label>
                                        <input type="text" class="form-control " name="comprobante" id="comprobante"
                                            placeholder="N° Nota de Pago" value="<?php echo $comprobante_pago; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Giro</label>
                                        <input type="date" class="form-control " name="fecha_giro" id="fecha_giro" value="<?php echo $fecha_giro; ?>" disabled>
                                    </div>

                                    


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado de Giro</label>
                                        <select class="form-control " name="estado_giro" id="estado_giro"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_giro_datos as $estado_giro_dato) {
                                                $estado_giro_tabla = $estado_giro_dato['estado'];
                                                $id_estado_giro = $estado_giro_dato['id_estado_giro'];
                                                ?>
                                                    <option value="<?php echo $estado_giro_dato['estado']; ?>" <?php if ($estado_giro_tabla == $estado_giro) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $estado_giro_dato['estado']; ?>
                                                    </option>
                                                    <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Pago</label>
                                        <input type="date" class="form-control " name="fecha_pago" id="fecha_pago" value="<?php echo $fecha_pago; ?>" disabled>
                                    </div>


                                    

                                    <div class="form-group col-md-4" id="">

                                    </div>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado de Cuenta</label>
                                        <input type="text" class="form-control " name="numero_estado_cuenta" id="numero_estado_cuenta"
                                            value="<?php echo $numero_ec; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Estado de Cuenta</label>
                                        <input type="date" class="form-control " name="fecha_estado_cuenta"
                                            id="fecha_estado_cuenta" value="<?php echo $fecha_ec; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Informe de Ingreso</label>
                                        <input type="text" class="form-control " name="informe_ingreso" id="informe_ingreso" placeholder="Numero-Año" onkeypress='return validaNumericos(event)' value="<?php echo $informe_ingresos; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Informe Ingreso</label>
                                        <input type="date" class="form-control " name="fecha_informe_ingreso" value="<?php echo $fecha_informe_ingresos; ?>" disabled>
                                    </div>

                                    

                                    <div class="form-group col-md-8" id="">
                                        <label for="">Descripción del estado de cuenta</label>
                                        <textarea type="text" class="form-control " name="descripcion_ec"
                                            id="descripcion_ec" rows="4" placeholder="Descripción del estado de cuenta"
                                            disabled><?php echo $descripcion_ec; ?></textarea>
                                    </div>




                            </div>







                                <div class="form-group col-md-12" align="right">
                                    <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                            class="bi bi-x-circle-fill"></i> Cancelar</a>

                                </div>

                            </form>
                        </div>




                    </div>


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

<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>