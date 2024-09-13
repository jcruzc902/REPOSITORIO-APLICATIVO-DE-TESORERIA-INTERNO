<?php
include('../app/config.php');
include('../layout/sesion.php');

include('../layout/parte1.php');
include('../layout/mensajes.php');

include('../app/controllers/modalidad_tyt/listado_modalidad_tyt.php');
include('../app/controllers/concepto_tyt/listado_concepto_tyt.php');
include('../app/controllers/referencia_tyt/listado_referencia_tyt.php');
include('../app/controllers/dependencia_tyt/listado_dependencia_tyt.php');
include('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include('../app/controllers/resolucion_rectoral/listado_resolucion_tyt.php');
include('../app/controllers/situacion_tyt/listado_situacion_tyt.php');
include('../app/controllers/tipo_tyt/listado_tipo_tyt.php');
include('../app/controllers/banco_tyt/listado_banco_tyt.php');
include('../app/controllers/cuenta_tyt/listado_cuenta_tyt.php');
include('../app/controllers/estado_tasas/listado_estado_tasas.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nueva Tasa y Tarifa</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/tasas_tarifas"><i
                                    class="bi bi-bar-chart-fill"></i> Tasas y Tarifas</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nueva Tasa y
                            Tarifa</a></li>
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
                            <h3 class="card-title">Digite los datos sobre la nueva tasa y tarifa</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/tasas_tarifas/create.php" method="post"
                                enctype="multipart/form-data">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <?php

                                    $sql_tasas_tarifas = "SELECT MAX(codigo_pago) as cod_pag FROM tb_tasas_tarifas WHERE visible!=1";
                                    $query_tasas_tarifas = $pdo->prepare($sql_tasas_tarifas);
                                    $query_tasas_tarifas->execute();
                                    $tasas_tarifas_datos = $query_tasas_tarifas->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($tasas_tarifas_datos as $tasas_tarifas_dato) {
                                        $codigo_pago = $tasas_tarifas_dato['cod_pag'];
                                    }

                                    //AUTOMATIZA EL CODIGO DE PAGO DE TASAS Y TARIFAS
                                    if ($codigo_pago != null) {
                                        if ($codigo_pago == 83504) {
                                            $codigo_pago = 83506;
                                        } else {
                                            $codigo_pago = $tasas_tarifas_dato['cod_pag'] + 1; //autoincrementa el numero de informe
                                        }

                                    } else {
                                        $codigo_pago = 1; //empieza con 1
                                    }


                                    ?>


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Pago</label>
                                        <input type="text" class="form-control " name="codigo_pago" id="codigo_pago"
                                            value="<?php echo $codigo_pago; ?>" readonly>
                                    </div>


                                    <div class="form-group col-md-3" id="">
                                        <label for="">Modalidad</label>
                                        <select class="form-control " name="modalidad" id="combo_modalidad"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($modalidad_tyt_datos as $modalidad_tyt_dato) { ?>
                                                <option value="<?php echo $modalidad_tyt_dato['nombre_modalidad']; ?>">
                                                    <?php echo $modalidad_tyt_dato['nombre_modalidad']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <?php
                                    $default_concepto = "OTROS";
                                    ?>


                                    <div class="form-group col-md-3" id="">
                                        <label for="">Concepto</label>
                                        <select class="form-control " name="concepto" id="combo_concepto"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($concepto_tyt_datos as $concepto_tyt_dato) {
                                                $nombre_concepto_tyt_tabla = $concepto_tyt_dato['nombre_concepto_tyt']; ?>
                                                <option value="<?php echo $nombre_concepto_tyt_tabla; ?>" <?php if ($nombre_concepto_tyt_tabla == $default_concepto) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_concepto_tyt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Nuevo Concepto</label>
                                        <input type="text" class="form-control " name="nuevo_concepto"
                                            placeholder="Digite el nuevo concepto">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nuevo Concepto</label>
                                        <input type="text" class="form-control " name="nuevo_concepto"
                                            id="nuevo_concepto" placeholder="Digite el nuevo concepto" required
                                            disabled>
                                    </div>

                                    <script>
                                        var concepto = $('#combo_concepto').val();

                                        if (concepto == "OTROS") {
                                            $('#nuevo_concepto').prop("disabled", false);
                                        }

                                    </script>

                                    <script>
                                        //habilita y deshabilita los campos
                                        $(document).ready(function () {
                                            $('#combo_concepto').change(function (e) {
                                                if ($(this).val() == "OTROS") {
                                                    document.getElementById("nuevo_concepto").value = "";
                                                    $('#nuevo_concepto').prop("disabled", false);


                                                } else {
                                                    document.getElementById("nuevo_concepto").value = "";
                                                    $('#nuevo_concepto').prop("disabled", true);
                                                }
                                            })
                                        });
                                    </script>



                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <!--
                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto"
                                            onkeypress='return validaNumericos(event)' id="monto" placeholder="Monto">
                                    </div>
                                    -->


                                    <div class="form-group col-md-3" id="">
                                        <label for="">Referencia</label>
                                        <select class="form-control " name="referencia" id="combo_referencia"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($referencia_tyt_datos as $referencia_tyt_dato) { ?>
                                                <option value="<?php echo $referencia_tyt_dato['nombre_referencia']; ?>">
                                                    <?php echo $referencia_tyt_dato['nombre_referencia']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Clasificador</label>
                                        <input type="text" class="form-control " name="clasificador" id="clasificador"
                                            placeholder="Clasificador" maxlength="20">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Facultad</label>
                                        <input type="text" class="form-control " name="codigo_facultad"
                                            id="codigo_facultad" placeholder="Codigo de Facultad" maxlength="10">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Dependencia</label>
                                        <select class="form-control " name="dependencia" id="combo_dependencia"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencia_tyt_datos as $dependencia_tyt_dato) { ?>
                                                <option
                                                    value="<?php echo $dependencia_tyt_dato['nombre_dependencias_tyt']; ?>">
                                                    <?php echo $dependencia_tyt_dato['nombre_dependencias_tyt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Codigo de Servicio Banco</label>
                                        <input type="text" class="form-control " name="codigo_serv_banco"
                                            id="codigo_serv_banco" placeholder="Codigo de Servicio Banco"
                                            onkeypress='return validaNumericos(event)' maxlength="3">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="banco" id="combo_banco" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($banco_tyt_datos as $banco_tyt_dato) { ?>
                                                <option value="<?php echo $banco_tyt_dato['nombre_banco']; ?>">
                                                    <?php echo $banco_tyt_dato['nombre_banco']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Cuenta</label>
                                        <select class="form-control " name="cuenta" id="combo_cuenta" style="width:100%"
                                            required>

                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_banco').change(function () {

                                                //$('#combo_cuenta').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_banco option:selected").each(function () {
                                                    var nombre_banco = $('#combo_banco').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#combo_cuenta").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>

                                    <!--

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Resolucion Rectoral</label>
                                        <select class="form-control " name="resolucion" id="combo_resolucion"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($resolucion_tyt_datos as $resolucion_tyt_dato) { ?>
                                                <option
                                                    value="<?php echo $resolucion_tyt_dato['nombre_resolucion_tyt']; ?>">
                                                    <?php echo mb_strtoupper($resolucion_tyt_dato['nombre_resolucion_tyt']); ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_resolucion').change(function () {

                                                $("#combo_resolucion option:selected").each(function () {
                                                    var nombre_resolucion = $('#combo_resolucion').val();
                                                    $.post("../app/controllers/resolucion_rectoral/consulta_archivo.php",
                                                        { nombre_resolucion: nombre_resolucion }, function (data) {
                                                            $("#combo_archivo").html(data);
                                                        });
                                                });

                                            });
                                        });
                                    </script>



                                    <div class="form-group col-md-2" id="" hidden>
                                        <label for="">Nuevo Nombre de Resolucion</label>
                                        <input type="text" class="form-control " name="nuevo_resolucion"
                                            placeholder="Digite el nuevo nombre de resolucion">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nuevo Nombre de Resolucion</label>
                                        <input type="text" class="form-control " name="nuevo_resolucion"
                                            id="nuevo_resolucion" placeholder="Digite el nuevo nombre de resolucion"
                                            required disabled>
                                    </div>

                                    <div class="form-group col-md-3" id="" hidden>
                                        <label for="">Subir Nuevo Archivo de R.R.</label>
                                        <input class="form-control-file" type="file" name="nuevo_archivo">
                                    </div>

                                    <div class="form-group col-md-3" id="">
                                        <label for="">Subir Nuevo Archivo de R.R.</label>
                                        <input class="form-control-file" type="file" name="nuevo_archivo"
                                            accept=".pdf,.PDF" id="archivo" required disabled>
                                    </div>

                                    <script>
                                        //habilita y deshabilita los campos
                                        $(document).ready(function () {
                                            $('#combo_resolucion').change(function (e) {
                                                if ($(this).val() == "OTROS") {
                                                    document.getElementById("nuevo_resolucion").value = "";
                                                    document.getElementById("archivo").value = "";
                                                    $('#nuevo_resolucion').prop("disabled", false);
                                                    $('#archivo').prop("disabled", false);


                                                } else {
                                                    document.getElementById("nuevo_resolucion").value = "";
                                                    document.getElementById("archivo").value = "";
                                                    $('#nuevo_resolucion').prop("disabled", true);
                                                    $('#archivo').prop("disabled", true);

                                                }
                                            })
                                        });
                                    </script>



                                    <div class="form-group col-md-3" id="" hidden>
                                        <label for="">Generar Archivo</label>
                                        <select class="form-control " name="archivo_resolucion" id="combo_archivo"
                                            style="width:100%">

                                        </select>

                                    </div>

                                        -->


                                    <div class="form-group col-md-2" id="">
                                        <label for="">Vigencia</label>
                                        <input type="date" class="form-control " name="vigencia" id="vigencia"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>



                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacion" id="combo_situacion"
                                            style="width:100%">
                                            <option value="SELECCIONAR">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_tyt_datos as $situacion_tyt_dato) { ?>
                                                <option value="<?php echo $situacion_tyt_dato['nombre_situacion_tyt']; ?>">
                                                    <?php echo $situacion_tyt_dato['nombre_situacion_tyt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo</label>
                                        <select class="form-control " name="tipo" id="combo_tipo" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_tyt_datos as $tipo_tyt_dato) { ?>
                                                <option value="<?php echo $tipo_tyt_dato['nombre_tipo_tyt']; ?>">
                                                    <?php echo $tipo_tyt_dato['nombre_tipo_tyt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_tasas">
                                        <a href="javascript:window.open('../app/controllers/tasas_tarifas/recargar.php','','width=1650, height=800');"
                                            id="boton_resolucion" class="btn btn-lg"
                                            style="background-color: black; color: white;">
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Resolucion</a>

                                    </div>

                                    <script>
                                        $('#boton_resolucion').click(function () {

                                            var codigo_pago = $('#codigo_pago').val();
                                            var modalidad = $('#combo_modalidad').val();

                                            if ($('#combo_concepto').val() == "OTROS") {
                                                var concepto = $('#nuevo_concepto').val();
                                            } else {
                                                var concepto = $('#combo_concepto').val();
                                            }




                                            var referencia = $('#combo_referencia').val();
                                            var dependencia = $('#combo_dependencia').val();

                                            var url = "../app/controllers/tasas_tarifas/global.php";
                                            $.get(url, { codigo_pago: codigo_pago, modalidad: modalidad, concepto: concepto, referencia: referencia, dependencia: dependencia }, function (datos) { });

                                        });
                                    </script>

                                    <?php
                                    $estado_tasas = "ATENDIDO";
                                    ?>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estado" id="combo_estado" style="width:100%"
                                            required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_tasas_datos as $estado_tasas_dato) {
                                                $nombre_estado_tasas_tabla = $estado_tasas_dato['nombre_estado_tasas'];
                                                $id_estado_tasas = $estado_tasas_dato['id_estado_tasas']; ?>
                                                <option value="<?php echo $id_estado_tasas; ?>" <?php if ($nombre_estado_tasas_tabla == $estado_tasas) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_tasas_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6" id="">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion"
                                            placeholder="Observacion">
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

                                        $('#combo_banco').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cuenta').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_resolucion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_archivo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_situacion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_tipo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
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

<?php include('../layout/parte2.php'); ?>