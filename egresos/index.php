<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/tipo_gasto/listado_tipo_gasto.php');
include ('../app/controllers/cargo/listado_cargo.php');
include ('../app/controllers/actividad_principal/listado_actividad_principal.php');
include ('../app/controllers/subactividad/listado_subactividad.php');
include ('../app/controllers/concepto_giro/listado_concepto_giro.php');
include ('../app/controllers/modalidad_pago/listado_modalidad_pago.php');
include ('../app/controllers/comprobante/listado_comprobante.php');
include ('../app/controllers/estado_egreso/listado_de_estado_egreso.php');


if (empty($_POST['ntX'])) {
    $_POST['ntX'] = "";
}

if (empty($_POST['aniontX'])) {
    $_POST['aniontX'] = "";
}

if (empty($_POST['siafX'])) {
    $_POST['siafX'] = "";
}

if (empty($_POST['tipo_gastoX'])) {
    $_POST['tipo_gastoX'] = "";
}

if (empty($_POST['concepto_giroX'])) {
    $_POST['concepto_giroX'] = "";
}

if (empty($_POST['modalidad_pagoX'])) {
    $_POST['modalidad_pagoX'] = "";
}

if (empty($_POST['cargoX'])) {
    $_POST['cargoX'] = "";
}

if (empty($_POST['actividad_principalX'])) {
    $_POST['actividad_principalX'] = "";
}

if (empty($_POST['subactividadX'])) {
    $_POST['subactividadX'] = "";
}

if (empty($_POST['estadoX'])) {
    $_POST['estadoX'] = "";
}


if (empty($_POST['fecharegistro_desdeX'])) {
    $_POST['fecharegistro_desdeX'] = "";
}

if (empty($_POST['fecharegistro_hastaX'])) {
    $_POST['fecharegistro_hastaX'] = "";
}


$sql_egresos = "SELECT egresos.id_egresos as id_egresos,
    egresos.proveido_conta as proveido_conta,
    egresos.fecha_conta as fecha_conta,
    egresos.asunto_conta as asunto_conta,
    egresos.siaf as siaf,
    tipo_gasto.nombre_tipo_gasto as nombre_tipo_gasto,
    egresos.nt_diga as nt_diga,
    anio_nt.anio_nt as nt_anio,
    egresos.proveido_diga as proveido_diga,
    egresos.fecha_diga as fecha_diga,
    egresos.oficio_dependencia as oficio_dependencia,
    egresos.fecha_dependencia as fecha_dependencia,
    cargo.nombre_cargo as nombre_cargo,
    actividad_principal.nombre_actividad as nombre_actividad,
    subactividad.nombre_subactividad as nombre_subactividad,
    egresos.monto as monto,
    concepto_giro.nombre_concepto_giro as nombre_concepto_giro,
    modalidad_pago.nombre_modalidad_pago as nombre_modalidad_pago,
    egresos.proveedor as proveedor,
    egresos.ruc as ruc,
    egresos.nro_orden_compra as nro_orden_compra,
    egresos.nro_orden_servicio as nro_orden_servicio,
    comprobantes.nombre_comprobantes as nombre_comprobantes,
    egresos.numero_comprobante as numero_comprobante,
    egresos.nro_cp_interno as nro_cp_interno,
    egresos.nota_pago as nota_pago,
    egresos.fecha_giro as fecha_giro,
    egresos.fecha_pago as fecha_pago,
    egresos.id_estado_egreso as id_estado_egreso,
    estado_egreso.nombre_estado_egreso as estado_egreso,
    egresos.fyh_creacion as fyh_creacion_egreso,
    usuarios.nombres as nombres_usuario,
    usuarios.apaterno as apaterno_usuario,
    usuarios.amaterno as amaterno_usuario
    FROM tb_egresos as egresos 
    INNER JOIN tb_tipo_gasto as tipo_gasto ON tipo_gasto.id_tipo_gasto = egresos.id_tipo_gasto 
    INNER JOIN tb_anio_nt as anio_nt ON anio_nt.id_anio_nt = egresos.id_anio_nt_diga 
    INNER JOIN tb_cargo as cargo ON cargo.id_cargo = egresos.id_cargo_dependencia  
    INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal = egresos.id_actividad_dependencia 
    INNER JOIN tb_subactividad as subactividad ON subactividad.id_subactividad = egresos.id_subactividad
    INNER JOIN tb_concepto_giro as concepto_giro ON concepto_giro.id_concepto_giro = egresos.id_concepto_giro
    INNER JOIN tb_modalidad_pago as modalidad_pago ON modalidad_pago.id_modalidad_pago = egresos.id_modalidad_pago
    INNER JOIN tb_comprobantes as comprobantes ON comprobantes.id_comprobantes = egresos.id_comprobantes
    INNER JOIN tb_estado_egreso as estado_egreso ON estado_egreso.id_estado_egreso = egresos.id_estado_egreso
    INNER JOIN tb_usuarios as usuarios ON usuarios.id_usuario = egresos.id_usuario
    WHERE egresos.visible!=1 ";

if (isset($_POST["consultar"])) {

    $consultar = 1;
    $nt = $_POST['ntX'];
    $anio_nt = $_POST['aniontX'];
    $siaf = $_POST['siafX'];
    $tipo_gasto = $_POST['tipo_gastoX'];
    $concepto_giro = $_POST['concepto_giroX'];
    $modalidad_pago = $_POST['modalidad_pagoX'];
    $cargo = $_POST['cargoX'];
    $actividad_principal = $_POST['actividad_principalX'];
    $subactividad = $_POST['subactividadX'];
    $estado = $_POST['estadoX'];
    $desde = $_POST['fecharegistro_desdeX'];
    $hasta = $_POST['fecharegistro_hastaX'];

    $_SESSION['busqueda_boton_egresos'] = $consultar;
    $_SESSION['busqueda_nt'] = $nt;
    $_SESSION['busqueda_anio_nt'] = $anio_nt;
    $_SESSION['busqueda_siaf'] = $siaf;
    $_SESSION['busqueda_tipo_gasto'] = $tipo_gasto;
    $_SESSION['busqueda_concepto_giro'] = $concepto_giro;
    $_SESSION['busqueda_modalidad_pago'] = $modalidad_pago;
    $_SESSION['busqueda_cargo'] = $cargo;
    $_SESSION['busqueda_actividad_principal'] = $actividad_principal;
    $_SESSION['busqueda_subactividad'] = $subactividad;
    $_SESSION['busqueda_estado'] = $estado;
    $_SESSION['busqueda_desde'] = $desde;
    $_SESSION['busqueda_hasta'] = $hasta;


    if (
        !isset($nt) && !isset($anio_nt) && !isset($siaf) && !isset($tipo_gasto) && !isset($concepto_giro) && !isset($modalidad_pago)
        && !isset($cargo) && !isset($actividad_principal) && !isset($subactividad) && !isset($estado) && !isset($desde) && !isset($hasta)
    ) {
        $sql_egresos .= " ";
    } else {

        if (!empty($nt)) {
            $sql_egresos .= " AND egresos.nt_diga like '%" . $nt . "%'";
        }

        if (!empty($anio_nt)) {
            $sql_egresos .= " AND egresos.id_anio_nt_diga='" . $anio_nt . "'";
        }

        if (!empty($siaf)) {
            $sql_egresos .= " AND egresos.siaf like '%" . $siaf . "%'";
        }

        if (!empty($tipo_gasto)) {
            $sql_egresos .= " AND egresos.id_tipo_gasto='" . $tipo_gasto . "'";
        }

        if (!empty($concepto_giro)) {
            $sql_egresos .= " AND egresos.id_concepto_giro='" . $concepto_giro . "'";
        }

        if (!empty($modalidad_pago)) {
            $sql_egresos .= " AND egresos.id_modalidad_pago='" . $modalidad_pago . "'";
        }

        if (!empty($cargo)) {
            $sql_egresos .= " AND egresos.id_cargo_dependencia='" . $cargo . "'";
        }

        if (!empty($actividad_principal)) {
            $sql_egresos .= " AND egresos.id_actividad_dependencia='" . $actividad_principal . "'";
        }

        if (!empty($subactividad)) {
            $sql_egresos .= " AND egresos.id_subactividad='" . $subactividad . "'";
        }

        if (!empty($estado)) {
            $sql_egresos .= " AND egresos.id_estado_egreso='" . $estado . "'";
        }

        if (!empty($desde) && !empty($hasta)) {
            $sql_egresos .= " AND egresos.fyh_creacion between '" . $desde . "' and '" . $hasta . "'";
        }
    }


    $query_egresos = $pdo->prepare($sql_egresos);
    $query_egresos->execute();
    $egresos_datos = $query_egresos->fetchAll(PDO::FETCH_ASSOC);


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
                    <h1 class="m-0"><b>Consulta de Egresos</b>
                        <a href="<?php echo $URL; ?>/egresos/create.php" type="button" class="btn btn-md bg-primary"
                            id="boton_agregar">
                            <i class="bi bi-plus-circle"></i> Agregar Nuevo Egreso</a>
                        <a href="<?php echo $URL; ?>/app/controllers/egreso/exportar_xlsx.php" type="button"
                            class="btn btn-md bg-success" id="boton_exportarExcel">
                            <i class="bi bi-file-earmark-excel"></i> Exportar a Excel</a>
                        <a href="<?php echo $URL; ?>/app/controllers/egreso/exportar_pdf.php" type="button"
                            class="btn btn-md bg-danger" target="_blank" id="boton_exportarPDF">
                            <i class="bi bi-file-earmark-pdf"></i> Exportar a PDF</a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-calculator"></i> Egresos</li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    if ($rol_sesion == "ADMINISTRADOR") { ?>
        <script>
            document.getElementById('boton_agregar').style.display = 'inline';
            document.getElementById('boton_exportarExcel').style.display = 'inline';
            document.getElementById('boton_exportarPDF').style.display = 'inline';
        </script>
    <?php } else if ($rol_sesion == "INGRESOS") { ?>
            <script>
                document.getElementById('boton_agregar').style.display = 'none';
                document.getElementById('boton_exportarExcel').style.display = 'none';
                document.getElementById('boton_exportarPDF').style.display = 'none';
            </script>
    <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                <script>
                    document.getElementById('boton_agregar').style.display = 'inline';
                    document.getElementById('boton_exportarExcel').style.display = 'inline';
                    document.getElementById('boton_exportarPDF').style.display = 'inline';
                </script>
    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                        <script>
                            document.getElementById('boton_agregar').style.display = 'none';
                            document.getElementById('boton_exportarExcel').style.display = 'none';
                            document.getElementById('boton_exportarPDF').style.display = 'none';
                        </script>
    <?php } ?>


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
                                        <input type="text" class="form-control " name="ntX" class="form-control"
                                            value="<?php echo $_POST['ntX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Año</label>
                                        <select class="form-control " name="aniontX" style="width:100%" id="comboaniont"
                                            class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($anios_datos as $anios_dato) {
                                                $anio_nt_tabla = $anios_dato['anio_nt'];
                                                $id_anio_nt = $anios_dato['id_anio_nt']; ?>
                                                <option value="<?php echo $id_anio_nt; ?>" <?php if ($id_anio_nt == $_POST["aniontX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $anio_nt_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">SIAF</label>
                                        <input type="text" class="form-control " name="siafX" class="form-control"
                                            value="<?php echo $_POST['siafX']; ?>"
                                            onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Tipo de Gasto</label>
                                        <select class="form-control " name="tipo_gastoX" style="width:100%"
                                            id="combotipogasto" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($tipo_gasto_datos as $tipo_gasto_dato) {
                                                $nombre_tipo_gasto_tabla = $tipo_gasto_dato['nombre_tipo_gasto'];
                                                $id_tipo_gasto = $tipo_gasto_dato['id_tipo_gasto']; ?>
                                                <option value="<?php echo $id_tipo_gasto; ?>" <?php if ($id_tipo_gasto == $_POST["tipo_gastoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_tipo_gasto_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Concepto de Giro</label>
                                        <select class="form-control " name="concepto_giroX" style="width:100%"
                                            id="combo_conceptogiro" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($concepto_giro_datos as $concepto_giro_dato) {
                                                $nombre_concepto_giro_tabla = $concepto_giro_dato['nombre_concepto_giro'];
                                                $id_concepto_giro = $concepto_giro_dato['id_concepto_giro']; ?>
                                                <option value="<?php echo $id_concepto_giro; ?>" <?php if ($id_concepto_giro == $_POST["concepto_giroX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_concepto_giro_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="">Modalidad de Pago</label>
                                        <select class="form-control " name="modalidad_pagoX" style="width:100%"
                                            id="combo_modalidadpago" class="form-control">
                                            <option value="">TODOS</option>
                                            <?php
                                            foreach ($modalidad_pago_datos as $modalidad_pago_dato) {
                                                $nombre_modalidad_pago_tabla = $modalidad_pago_dato['nombre_modalidad_pago'];
                                                $id_modalidad_pago = $modalidad_pago_dato['id_modalidad_pago']; ?>
                                                <option value="<?php echo $id_modalidad_pago; ?>" <?php if ($id_modalidad_pago == $_POST["modalidad_pagoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_modalidad_pago_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <?php

                                    $sql_actividad_principal = "SELECT * FROM tb_actividad_principal where id_actividad_principal!=1 AND id_cargo='$_POST[cargoX]' ORDER BY nombre_actividad ASC";
                                    $query_actividad_principal = $pdo->prepare($sql_actividad_principal);
                                    $query_actividad_principal->execute();
                                    $actividad_principal_datos = $query_actividad_principal->fetchAll(PDO::FETCH_ASSOC);


                                    $sql_subactividad = "SELECT * FROM tb_subactividad where id_subactividad!=1 AND id_actividad_principal='$_POST[actividad_principalX]' ORDER BY nombre_subactividad ASC";
                                    $query_subactividad = $pdo->prepare($sql_subactividad);
                                    $query_subactividad->execute();
                                    $subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);
                                    ?>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Cargo</label>
                                        <select class="form-control " name="cargoX" id="combo_cargo" style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($tipo_cargo_datos as $tipo_cargo_dato) {
                                                $nombre_cargo_tabla = $tipo_cargo_dato['nombre_cargo'];
                                                $id_cargo = $tipo_cargo_dato['id_cargo']; ?>
                                                <option value="<?php echo $id_cargo; ?>" <?php if ($id_cargo == $_POST["cargoX"]) { ?> selected="selected" <?php } ?>>
                                                    <?php echo $nombre_cargo_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Actividad Principal</label>
                                        <select class="form-control " name="actividad_principalX" id="combo_actividad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($actividad_principal_datos as $actividad_principal_dato) {
                                                $nombre_actividad_tabla = $actividad_principal_dato['nombre_actividad'];
                                                $id_actividad_principal = $actividad_principal_dato['id_actividad_principal']; ?>
                                                <option value="<?php echo $id_actividad_principal; ?>" <?php if ($id_actividad_principal == $_POST["actividad_principalX"]) { ?>
                                                        selected="selected" <?php } ?>>
                                                    <?php echo $nombre_actividad_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Sub Actividad</label>
                                        <select class="form-control " name="subactividadX" id="combo_subactividad"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($subactividad_datos as $subactividad_dato) {
                                                $nombre_subactividad_tabla = $subactividad_dato['nombre_subactividad'];
                                                $id_subactividad = $subactividad_dato['id_subactividad']; ?>
                                                <option value="<?php echo $id_subactividad; ?>" <?php if ($id_subactividad == $_POST["subactividadX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_subactividad_tabla; ?>
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

                                    <div class="form-group col-md-2" id="campo_anio_nt">
                                        <label for="">Estado</label>
                                        <select class="form-control " name="estadoX" id="combo_estado"
                                            style="width:100%">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($estado_egreso_datos as $estado_egreso_dato) {
                                                $nombre_estado_egreso_tabla = $estado_egreso_dato['nombre_estado_egreso'];
                                                $id_estado_egreso = $estado_egreso_dato['id_estado_egreso']; ?>
                                                <option value="<?php echo $id_estado_egreso; ?>" <?php if ($id_estado_egreso == $_POST["estadoX"]) { ?> selected="selected"
                                                    <?php } ?>>
                                                    <?php echo $nombre_estado_egreso_tabla; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

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

                                        <button type="submit" name="consultar" class="btn"
                                            style="background-color: black; color: white;"><i class="bi bi-search"></i>
                                            Iniciar consulta</button>
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
                                <center>SIAF</center>
                            </th>

                            <th>
                                <center>Tipo de Gasto</center>
                            </th>

                            <th>
                                <center>Cargo</center>
                            </th>

                            <th>
                                <center>Actividad Principal</center>
                            </th>

                            <th>
                                <center>Subactividad</center>
                            </th>

                            <th>
                                <center>Monto</center>
                            </th>

                            <th>
                                <center>Concepto de Giro</center>
                            </th>

                            <th>
                                <center>Modalidad de Pago</center>
                            </th>

                            <th>
                                <center>Estado</center>
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
                        if (!isset($egresos_datos)) {
                            $egresos_datos = "";
                        } else {



                            $contador = 0;
                            foreach ($egresos_datos as $egresos_dato) {
                                $id_egresos = $egresos_dato['id_egresos']; ?>
                                <tr>
                                    <td>
                                        <center>
                                            <?php echo $contador = $contador + 1; ?>
                                        </center>
                                    </td>


                                    <td>
                                        <?php echo $egresos_dato['nt_diga']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nt_anio']; ?>
                                    </td>


                                    <td>
                                        <?php echo $egresos_dato['siaf']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nombre_tipo_gasto']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nombre_cargo']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nombre_actividad']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nombre_subactividad']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['monto']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nombre_concepto_giro']; ?>
                                    </td>

                                    <td>
                                        <?php echo $egresos_dato['nombre_modalidad_pago']; ?>
                                    </td>

                                    <td>
                                        <?php
                                        switch ($egresos_dato['estado_egreso']) {
                                            case 'ATENDIDO': ?>
                                                <span class="badge bg-success">
                                                    <?php echo $egresos_dato['estado_egreso']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'PENDIENTE': ?>
                                                <span class="badge bg-warning">
                                                    <?php echo $egresos_dato['estado_egreso']; ?>
                                                </span>
                                                <?php
                                                break;
                                            case 'ANULADO': ?>
                                                <span class="badge bg-danger">
                                                    <?php echo $egresos_dato['estado_egreso']; ?>
                                                </span>
                                                <?php
                                                break;
                                        }
                                        ?>
                                    </td>



                                    <td>
                                        <?php $theDate = new DateTime($egresos_dato['fyh_creacion_egreso']);
                                        echo $egresos_dato['fyh_creacion_egreso'] = $theDate->format('d/m/Y h:i:s a'); ?>
                                    </td>




                                    <td>
                                        <center>
                                            <div class="btn-group">
                                                <a href="show.php?id=<?php echo $id_egresos; ?>" type="button"
                                                    class="btn btn-sm btn-success"><i class="bi bi-search"></i></a>

                                                <a href="informe.php?id=<?php echo $id_egresos; ?>" target="_blank"
                                                    type="button" class="btn btn-sm" style="background-color: bisque;"
                                                    id="boton_imprimir<?php echo $id_egresos; ?>"><i class="bi bi-printer"></i>
                                                </a>

                                                <a href="update.php?id=<?php echo $id_egresos; ?>" type="button"
                                                    class="btn btn-sm btn-primary"><i class="bi bi-pencil-square"></i>
                                                </a>
                                                <a href="delete.php?id=<?php echo $id_egresos; ?>" type="button"
                                                    class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i></a>

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


<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>


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