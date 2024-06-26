<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../layout/mensajes.php');

include ('../app/controllers/egreso/show_egreso.php');

include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/tipo_gasto/listado_tipo_gasto.php');
include ('../app/controllers/cargo/listado_cargo.php');
include ('../app/controllers/actividad_principal/listado_actividad_principal.php');
include ('../app/controllers/subactividad/listado_subactividad.php');
include ('../app/controllers/concepto_giro/listado_concepto_giro.php');
include ('../app/controllers/modalidad_pago/listado_modalidad_pago.php');
include ('../app/controllers/comprobante/listado_comprobante.php');
include ('../app/controllers/estado_egreso/listado_de_estado_egreso.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Actualizar Datos de Egreso</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/egresos"><i
                                    class="bi bi-calculator"></i> Egresos</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-pencil"></i> Actualizar Datos de Egresos</a>
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
                            <h3 class="card-title">Digite los datos del egreso a actualizar</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">



                            <form action="../app/controllers/egreso/update.php" method="post">
                                <input class="form-control " type="text" name="id_egreso"
                                    value="<?php echo $id_egresos; ?>" hidden>
                                <input class="form-control " type="text" name="id_usuario"
                                    value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">

                                    <div class="form-group col-md-12" id="campo_nt">
                                        <h3><b><u>DIGA</u></b></h3>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_nt">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="nt"
                                            onkeypress='return validaNumericos(event)' id="numero_tramite"
                                            placeholder="Número NT" value="<?php echo $nt_diga; ?>" required>
                                    </div>


                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_nt" id="comboaniont"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_nt; ?>" <?php if ($anio_nt_tabla == $nt_anio) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido</label>
                                        <input type="text" class="form-control " name="proveido_diga" id="proveido_diga"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $proveido_diga; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_diga"
                                            id="fecha_proveido_diga" value="<?php echo $fecha_diga; ?>">
                                    </div>

                                    <hr style="width:100%; ">

                                    <div class="form-group col-md-12" id="campo_nt">
                                        <h3><b><u>CONTABILIDAD</u></b></h3>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido</label>
                                        <input type="text" class="form-control " name="proveido_conta"
                                            id="proveido_conta" placeholder="Número de Proveido"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $proveido_conta; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_conta"
                                            id="fecha_proveido_conta" value="<?php echo $fecha_conta; ?>">
                                    </div>

                                    <div class="form-group col-md-8" id="">

                                    </div>

                                    <div class="form-group col-md-8">

                                        <div class="form-group">
                                            <label>Asunto</label>
                                            <textarea class="form-control" name="asunto" rows="3"
                                                placeholder="Asunto"><?php echo $asunto_conta; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_siaf">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siaf" id=""
                                            onkeypress='return validaNumericos(event)' placeholder="Número SIAF"
                                            value="<?php echo $siaf; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Tipo de gasto</label>
                                        <select class="form-control " name="id_tipo_gasto" id="combotipogasto"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_gasto_datos as $tipo_gasto_dato) {
                                                $nombre_tipo_gasto_tabla = $tipo_gasto_dato['nombre_tipo_gasto'];
                                                $id_tipo_gasto = $tipo_gasto_dato['id_tipo_gasto']; ?>
                                                <option value="<?php echo $id_tipo_gasto; ?>" <?php if ($nombre_tipo_gasto_tabla == $nombre_tipo_gasto) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_tipo_gasto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>





                                    <hr style="width:100%; ">



                                    <div class="form-group col-md-12" id="campo_nt">
                                        <h3><b><u>DEPENDENCIA - FACULTAD</u> (GASTOS VINCULADOS)</b> </h3>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_oficio">
                                        <label for="">Oficio</label>
                                        <input type="text" class="form-control " name="oficio"
                                            placeholder="Número de Oficio y Dependencias"
                                            value="<?php echo $oficio_dependencia; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_oficio">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_oficio"
                                            value="<?php echo $fecha_dependencia; ?>">
                                    </div>

                                    <div class="form-group col-md-8">

                                    </div>

                                    <?php

                                    $sql_actividad_principal = "SELECT * FROM tb_actividad_principal where id_actividad_principal!=1 AND id_cargo='$id_cargo' ORDER BY nombre_actividad ASC";
                                    $query_actividad_principal = $pdo->prepare($sql_actividad_principal);
                                    $query_actividad_principal->execute();
                                    $actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);


                                    $sql_subactividad = "SELECT * FROM tb_subactividad where id_subactividad!=1 AND id_actividad_principal='$id_actividad' ORDER BY nombre_subactividad ASC";
                                    $query_subactividad = $pdo->prepare($sql_subactividad);
                                    $query_subactividad->execute();
                                    $subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="form-group col-md-3" id="campo_anio_nt">
                                        <label for="">Cargo</label>
                                        <select class="form-control " name="id_cargo" id="combo_cargo"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                <option value="<?php echo $id_cargo; ?>" <?php if ($nombre_cargo_tabla == $nombre_cargo) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_cargo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-3" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        <select class="form-control " name="id_actividad_principal" id="combo_actividad"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                <option value="<?php echo $id_actividad_principal; ?>" <?php if ($nombre_actividad_tabla == $nombre_actividad) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_actividad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Sub Actividad</label>
                                        <select class="form-control " name="id_subactividad" id="combo_subactividad"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($subactividad_datos as $subactividad_dato) {
                                                $nombre_subactividad_tabla = $subactividad_dato['nombre_subactividad'];
                                                $id_subactividad = $subactividad_dato['id_subactividad']; ?>
                                                <option value="<?php echo $id_subactividad; ?>" <?php if ($nombre_subactividad_tabla == $nombre_subactividad) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_subactividad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_periodo" id="combo_periodo"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_periodo_tabla = $anios_dato['anio_nt'];
                                                $id_anio_periodo = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_periodo; ?>" <?php if ($anio_periodo_tabla == $anio_periodo) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_periodo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>




                                    <script>

                                        $(document).ready(function () {

                                            $('#combo_cargo').change(function () {

                                                $('#combo_subactividad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_cargo option:selected").each(function () {
                                                    var id_cargo = $('#combo_cargo').val();
                                                    $.post("../app/controllers/cargo/consulta_actividad.php",
                                                        { id_cargo: id_cargo }, function (data) {
                                                            $("#combo_actividad").html(data);
                                                        });
                                                });

                                            });
                                        });

                                        $(document).ready(function () {

                                            $('#combo_actividad').change(function () {

                                                $("#combo_actividad option:selected").each(function () {
                                                    var id_actividad_principal = $('#combo_actividad').val();
                                                    $.post("../app/controllers/cargo/consulta_subactividad.php",
                                                        { id_actividad_principal: id_actividad_principal }, function (data) {
                                                            $("#combo_subactividad").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>






                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_monto">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto"
                                            placeholder="Ingrese el monto" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $monto; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Concepto de Giro</label>
                                        <select class="form-control " name="id_concepto_giro" id="combo_conceptogiro"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($concepto_giro_datos as $concepto_giro_dato) {
                                                $nombre_concepto_giro_tabla = $concepto_giro_dato['nombre_concepto_giro'];
                                                $id_concepto_giro = $concepto_giro_dato['id_concepto_giro']; ?>
                                                <option value="<?php echo $id_concepto_giro; ?>" <?php if ($nombre_concepto_giro_tabla == $nombre_concepto_giro) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_concepto_giro_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Modalidad de Pago</label>
                                        <select class="form-control " name="id_modalidad_pago" id="combo_modalidadpago"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($modalidad_pago_datos as $modalidad_pago_dato) {
                                                $nombre_modalidad_pago_tabla = $modalidad_pago_dato['nombre_modalidad_pago'];
                                                $id_modalidad_pago = $modalidad_pago_dato['id_modalidad_pago']; ?>
                                                <option value="<?php echo $id_modalidad_pago; ?>" <?php if ($nombre_modalidad_pago_tabla == $nombre_modalidad_pago) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_modalidad_pago_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_proveedor">
                                        <label for="">Proveedor</label>
                                        <input type="text" class="form-control " name="proveedor"
                                            placeholder="Proveedor" value="<?php echo $proveedor; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_ruc">
                                        <label for="">RUC</label>
                                        <input type="text" class="form-control " name="ruc" placeholder="RUC"
                                            value="<?php echo $ruc; ?>" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_ruc">
                                        <label for="">N° Orden Compra</label>
                                        <input type="text" class="form-control " name="nro_orden_compra"
                                            placeholder="Orden de Compra" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_orden_compra; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_ruc">
                                        <label for="">N° Orden Servicio</label>
                                        <input type="text" class="form-control " name="nro_orden_servicio"
                                            placeholder="Orden de Servicio" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_orden_servicio; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Tipo de Comprobante</label>
                                        <select class="form-control " name="id_tipo_comprobante" id="combo_comprobante"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($comprobante_datos as $comprobante_dato) {
                                                $nombre_comprobantes_tabla = $comprobante_dato['nombre_comprobantes'];
                                                $id_comprobantes = $comprobante_dato['id_comprobantes']; ?>
                                                <option value="<?php echo $id_comprobantes; ?>" <?php if ($nombre_comprobantes_tabla == $nombre_comprobantes) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_comprobantes_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_comprobante">
                                        <label for="">N° Comprobante</label>
                                        <input type="text" class="form-control " name="nro_comprobante"
                                            placeholder="Nro. Comprobante" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $numero_comprobante; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_comprobante_interno">
                                        <label for="">N° Comprobante Interno</label>
                                        <input type="text" class="form-control " name="nro_comprobante_interno"
                                            placeholder="Nro. Comprobante Interno"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_cp_interno; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_nota_pago">
                                        <label for="">Nota de Pago</label>
                                        <input type="text" class="form-control " name="nota_pago"
                                            placeholder="Nota de Pago" value="<?php echo $nota_pago; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_giro">
                                        <label for="">Fecha de Giro</label>
                                        <input type="date" class="form-control " name="fecha_giro"
                                            value="<?php echo $fecha_giro; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_pago">
                                        <label for="">Fecha de Pago</label>
                                        <input type="date" class="form-control " name="fecha_pago"
                                            value="<?php echo $fecha_pago; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_informe">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informe"
                                            value="<?php echo $informe; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_informe">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_informe"
                                            value="<?php echo $fecha_informe; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="campo_total_egresos">
                                        <label for="">N° Resolucion Rectoral</label>
                                        <input type="text" class="form-control " name="resolucion_directoral"
                                            value="<?php echo $resolucion_directoral; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_informe">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_resolucion"
                                            value="<?php echo $fecha_resolucion; ?>">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_total_egresos">
                                        <label for="">Total Egresos</label>
                                        <input type="text" class="form-control " name="total_egresos"
                                            value="<?php echo $total_egresos; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_total_acumulador">
                                        <label for="">Total Acumulado</label>
                                        <input type="text" class="form-control " name="total_acumulado"
                                            value="<?php echo $total_acumulado; ?>" readonly>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado_egreso" id="combo_estado"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_egreso_datos as $estado_egreso_dato) {
                                                $nombre_estado_egreso_tabla = $estado_egreso_dato['nombre_estado_egreso'];
                                                $id_estado_egreso = $estado_egreso_dato['id_estado_egreso']; ?>
                                                <option value="<?php echo $id_estado_egreso; ?>" <?php if ($nombre_estado_egreso_tabla == $estado_egreso) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_egreso_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                            
                                    <div class="form-group col-md-4" id="campo_observacion" hidden>
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion"
                                            value="<?php echo $observacion; ?>">
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

                                        $('#combotipogasto').select2({
                                            theme: 'bootstrap4',
                                        });


                                        $('#comboaniont').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cargo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_actividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_subactividad').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_conceptogiro').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_modalidadpago').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_comprobante').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_periodo').select2({
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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>