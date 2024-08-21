<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../layout/mensajes.php');


include ('../app/controllers/banco_tyt/listado_banco_tyt.php');
include ('../app/controllers/tipo_cuenta/listado_tipo_cuenta.php');
include ('../app/controllers/situacion_cuenta/listado_situacion_cuenta.php');
include ('../app/controllers/estado_saldo/listado_estado_saldo.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Saldo Bancario</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/saldos"><i class="bi bi-check-circle-fill"></i> Saldos Bancarios</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            saldo bancario</a></li>
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
                            <h3 class="card-title">Digite los datos sobre el nuevo saldo bancario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/saldos/create.php" method="post">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Banco</label>
                                        <select class="form-control " name="banco" id="combo_banco" style="width:100%" required>
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
                                        <select class="form-control " name="cuenta" id="combo_cuenta"
                                            style="width:100%" required>

                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Nombre</label>
                                        <select class="form-control " name="nombre" id="combo_nombre"
                                            style="width:100%" required>

                                        </select>

                                    </div>

                                    <script>
                                        $(document).ready(function () {

                                            $('#combo_banco').change(function () {

                                                $('#combo_nombre').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');

                                                $("#combo_banco option:selected").each(function () {
                                                    var nombre_banco = $('#combo_banco').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_cuenta.php",
                                                        { nombre_banco: nombre_banco }, function (data) {
                                                            $("#combo_cuenta").html(data);
                                                        });
                                                });

                                            });
                                        });

                                        $(document).ready(function () {

                                            $('#combo_cuenta').change(function () {

                                                $("#combo_cuenta option:selected").each(function () {
                                                    var numero_cuenta = $('#combo_cuenta').val();
                                                    $.post("../app/controllers/banco_tyt/consulta_nombre.php",
                                                        { numero_cuenta: numero_cuenta }, function (data) {
                                                            $("#combo_nombre").html(data);
                                                        });
                                                });

                                            });
                                        });


                                    </script>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Tipo de Cuenta</label>
                                        <select class="form-control " name="tipo" id="combo_tipo" style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cuenta_datos as $tipo_cuenta_dato) { ?>
                                                <option value="<?php echo $tipo_cuenta_dato['id_cuenta_saldo']; ?>">
                                                    <?php echo $tipo_cuenta_dato['cuenta_saldo']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Situacion</label>
                                        <select class="form-control " name="situacion" id="combo_situacion"
                                            style="width:100%">
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($situacion_saldo_datos as $situacion_saldo_dato) { ?>
                                                <option value="<?php echo $situacion_saldo_dato['id_situacion_saldo']; ?>">
                                                    <?php echo $situacion_saldo_dato['nombre_situacion']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>


                                    <div class="form-group col-md-4" id="" hidden>
                                        <label for="">Detalle de la cuenta</label>
                                        <input type="text" class="form-control " name="detalle_cuenta"
                                            placeholder="Digite el detalle de la cuenta">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Saldo</label>
                                        <input type="date" class="form-control " name="fecha">
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto (S/.)</label>
                                        <input type="text" class="form-control " name="monto" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <?php
                                        $estado_saldo="PENDIENTE";
                                    ?>

                                    <div class="form-group col-md-2" id="campo_estado">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="id_estado_saldo" id="combo_estado"
                                            style="width:100%" required>
                                            <option value="1">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_saldo_datos as $estado_saldo_dato) {
                                                $nombre_estado_tabla = $estado_saldo_dato['nombre_estado'];
                                                $id_estado_saldo = $estado_saldo_dato['id_estado_saldo']; ?>
                                                <option value="<?php echo $id_estado_saldo; ?>" <?php if ($nombre_estado_tabla == $estado_saldo) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_estado_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

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
                                        $('#combo_banco').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_cuenta').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_nombre').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_tipo').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_situacion').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combo_estado').select2({
                                            theme: 'bootstrap4',
                                        });

                                    });
                                </script>

                                <?php if ($rol_sesion == "SECRETARIA") { ?>
                                    <script>
                                        //ocultar las secciones
                                        document.getElementById('campo_periodo').style.display = 'inline';
                                        document.getElementById('campo_nt').style.display = 'inline';
                                        document.getElementById('campo_anio_nt').style.display = 'inline';
                                        document.getElementById('campo_proveido').style.display = 'inline';
                                        document.getElementById('campo_fecha_proveido').style.display = 'inline';
                                        document.getElementById('campo_oficio').style.display = 'inline';
                                        document.getElementById('campo_fecha_oficio').style.display = 'inline';
                                        document.getElementById('campo_observacion').style.display = 'none';
                                        document.getElementById('campo_informe').style.display = 'none';
                                        document.getElementById('campo_fecha_informe').style.display = 'none';
                                        document.getElementById('campo_dependencia').style.display = 'none';
                                        document.getElementById('campo_estado_devolucion').style.display = 'none';
                                        document.getElementById('boton_ingresos').style.display = 'none';




                                    </script>
                                <?php } else if ($rol_sesion == "JEFATURA") { ?>
                                        <script>
                                            //ocultar las secciones
                                            document.getElementById('campo_periodo').style.display = 'inline';
                                            document.getElementById('campo_nt').style.display = 'inline';
                                            document.getElementById('campo_anio_nt').style.display = 'inline';
                                            document.getElementById('campo_proveido').style.display = 'inline';
                                            document.getElementById('campo_fecha_proveido').style.display = 'inline';
                                            document.getElementById('campo_oficio').style.display = 'inline';
                                            document.getElementById('campo_fecha_oficio').style.display = 'inline';
                                            document.getElementById('campo_observacion').style.display = 'inline';
                                            document.getElementById('campo_informe').style.display = 'inline';
                                            document.getElementById('campo_fecha_informe').style.display = 'inline';
                                            document.getElementById('campo_dependencia').style.display = 'inline';
                                            document.getElementById('boton_ingresos').style.display = 'inline';



                                        </script>

                                <?php } else if ($rol_sesion == "ADMINISTRADOR") { ?>
                                            <script>
                                                //ocultar las secciones
                                                document.getElementById('campo_periodo').style.display = 'inline';
                                                document.getElementById('campo_nt').style.display = 'inline';
                                                document.getElementById('campo_anio_nt').style.display = 'inline';
                                                document.getElementById('campo_proveido').style.display = 'inline';
                                                document.getElementById('campo_fecha_proveido').style.display = 'inline';
                                                document.getElementById('campo_oficio').style.display = 'inline';
                                                document.getElementById('campo_fecha_oficio').style.display = 'inline';
                                                document.getElementById('campo_observacion').style.display = 'inline';
                                                document.getElementById('campo_informe').style.display = 'inline';
                                                document.getElementById('campo_fecha_informe').style.display = 'inline';
                                                document.getElementById('campo_dependencia').style.display = 'inline';
                                                document.getElementById('boton_ingresos').style.display = 'inline';



                                            </script>

                                <?php } ?>
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