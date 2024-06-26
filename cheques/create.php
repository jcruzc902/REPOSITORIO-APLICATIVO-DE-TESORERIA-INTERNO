<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../layout/mensajes.php');

include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/asuntos/listado_de_asuntos.php');
include ('../app/controllers/tipo_gasto/listado_tipo_gasto.php');


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Cheque</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/cheques"><i class="bi bi-wallet"></i>
                                Cheques</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            cheque</a></li>
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
                            <h3 class="card-title">Digite los datos sobre el nuevo cheque</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/cheque/create.php" method="post">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="campo_nt">
                                        <label for="">NT.</label>
                                        <input type="text" class="form-control " name="nt"
                                            onkeypress='return validaNumericos(event)' id="numero_tramite"
                                            placeholder="Número NT" required>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Año</label>
                                        <select class="form-control " name="id_anio_nt" id="comboaniont"
                                            style="width:100%" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) { ?>
                                                <option value="<?php echo $anios_dato['id_anio_nt']; ?>">
                                                    <?php echo $anios_dato['anio_nt']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>


                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido (DIGA)</label>
                                        <input type="text" class="form-control " name="proveido_diga" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_diga"
                                            id="fecha_proveido">
                                    </div>



                                    <div class="form-group col-md-2" id="campo_proveido">
                                        <label for="">Proveido (CONTABILIDAD)</label>
                                        <input type="text" class="form-control " name="proveido_conta" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido_conta"
                                            id="fecha_proveido">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_asunto">
                                        <label for="">Asunto</label>
                                        <select class="form-control " name="id_asunto" id="comboasunto"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($asuntos_datos as $asuntos_dato) { ?>
                                                <option value="<?php echo $asuntos_dato['id_asunto']; ?>">
                                                    <?php echo $asuntos_dato['nombre_asunto']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_siaf">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siaf" id=""
                                            onkeypress='return validaNumericos(event)' placeholder="Número SIAF">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_tipo_gasto">
                                        <label for="">Tipo de gasto</label>
                                        <select class="form-control " name="id_tipo_gasto" id="combotipogasto"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_gasto_datos as $tipo_gasto_dato) { ?>
                                                <option value="<?php echo $tipo_gasto_dato['id_tipo_gasto']; ?>">
                                                    <?php echo $tipo_gasto_dato['nombre_tipo_gasto']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_oficio">
                                        <label for="">Oficio</label>
                                        <input type="text" class="form-control " name="oficio"
                                            placeholder="Número de Oficio y Dependencias">
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_oficio">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_oficio">
                                    </div>


                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos">
                                        <a href="javascript:window.open('../app/controllers/cheque/recargar.php','','width=1750, height=1000');"
                                            id="boton_vouchers" class="btn btn-lg"
                                            style="background-color: black; color: white;">
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Pagos</a>

                                    </div>

                                    <script>
                                        $('#boton_vouchers').click(function () {
                                            var numero_tramite = $('#numero_tramite').val();
                                            var anio_nt = $('#comboaniont').val();

                                            var url = "../app/controllers/cheque/global.php";
                                            $.get(url, {
                                                numero_tramite: numero_tramite, anio_nt: anio_nt
                                            }, function (datos) { });

                                        });
                                    </script>

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

                                        $('#comboaniont').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#comboasunto').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combotipogasto').select2({
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

<?php include ('../layout/parte2.php'); ?>