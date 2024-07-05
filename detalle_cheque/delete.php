<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/detalle_cheque/show_detalle.php');

include ('../app/controllers/cuenta/listado_de_nrocuentas.php');

if ((isset($_SESSION['numero_tramite'])) && isset($_SESSION['anio_nt']) && isset($_SESSION['id_anio_nt'])) {
    $numero_tramite = $_SESSION['numero_tramite'];
    $anio_nt = $_SESSION['anio_nt'];
    $id_anio_nt = $_SESSION['id_anio_nt'];
} else {
    $numero_tramite = "";
    $anio_nt = "";
    $id_anio_nt = "";
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Eliminar Pago Realizado: NT
                            <?php echo $numero_tramite . " - " . $anio_nt; ?></b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/detalle_cheque"><i
                                    class="bi bi-card-checklist"></i> Pagos realizado</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-x-octagon-fill"></i> Eliminar pago
                            realizado</a></li>
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
                            <h3 class="card-title">¿Esta seguro de eliminar el pago realizado seleccionado?</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">



                            <form action="../app/controllers/detalle_cheque/ocultar_detalle.php" method="post">
                                <input type="text" name="id_detalle_cheque"
                                    value="<?php echo $id_detalle_cheque; ?>" hidden>
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>
                                <div class="form-row">
                                    <div class="form-group col-md-2" id="nro_cuenta">
                                        <label for="">Tipo de Cheque</label>
                                        <select class="form-control " name="id_nrocuenta" id="combocuenta"
                                            style="width:100%" disabled>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($nrocuentas_datos as $nrocuentas_dato) {
                                                $nro_cuenta_tabla = $nrocuentas_dato['nro_cuenta'];
                                                $id_nrocuenta = $nrocuentas_dato['id_nrocuenta']; ?>
                                                <option value="<?php echo $id_nrocuenta; ?>" <?php if ($nro_cuenta_tabla == $nro_cuenta) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nro_cuenta_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Comp. Int.</label>
                                        <input type="text" class="form-control " name="nro_comprobante_interno"
                                            id="nro_comprobante_interno" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_ci; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Comp. Int.</label>
                                        <input type="date" class="form-control " name="fecha_comprobante_interno"
                                            id="fecha_comprobante_interno" value="<?php echo $fecha_ci; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Comp. Ext.</label>
                                        <input type="text" class="form-control " name="nro_comprobante_externo"
                                            id="nro_comprobante_externo" onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_ce; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Comp. Ext.</label>
                                        <input type="date" class="form-control " name="fecha_comprobante_externo"
                                            id="fecha_comprobante_externo" value="<?php echo $fecha_ce; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Cheque</label>
                                        <input type="text" class="form-control " name="numero_cheque" id="numero_cheque"
                                            onkeypress='return validaNumericos(event)'
                                            value="<?php echo $nro_cheque; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Emision (Cheque)</label>
                                        <input type="date" class="form-control " name="fecha_emision_cheque"
                                            id="fecha_emision_cheque" value="<?php echo $fecha_emision_cheque; ?>"
                                            disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Monto</label>
                                        <input type="text" class="form-control " name="monto" id="monto"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $monto; ?>"
                                            disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">N° Envio</label>
                                        <input type="text" class="form-control " name="numero_envio" id="numero_envio"
                                            onkeypress='return validaNumericos(event)' value="<?php echo $nro_envio; ?>"
                                            disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Aprobado</label>
                                        <input type="date" class="form-control " name="fecha_aprobado"
                                            id="fecha_aprobado" value="<?php echo $fecha_aprobado; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Entregado</label>
                                        <input type="date" class="form-control " name="fecha_entregado"
                                            id="fecha_entregado" value="<?php echo $fecha_entregado; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha Pagado</label>
                                        <input type="date" class="form-control " name="fecha_pagado" id="fecha_pagado"
                                            value="<?php echo $fecha_pagado; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion" id="observacion"
                                            value="<?php echo $observacion; ?>" required>
                                    </div>

                                    <div class="form-group col-md-2" id="">
                                        <label for="">Fecha de Registro</label>
                                        <input type="date" class="form-control " name="fecha_registro"
                                            id="fecha_registro" value="<?php echo $fecha_registro; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-2" id="">

                                    </div>

                                    <div class="form-group col-md-4" id="">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control " name="usuario" id="usuario"
                                            value="<?php echo $usuario; ?>" disabled>
                                    </div>

                                    <div class="form-group col-md-12" align="right">
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i>
                                            Eliminar</button>
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>


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