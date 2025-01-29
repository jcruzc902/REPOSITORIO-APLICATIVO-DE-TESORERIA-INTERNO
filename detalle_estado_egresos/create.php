<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../layout/mensajes.php');
include('../app/controllers/estado_giro/listado_de_estado_giro.php');
include('../app/controllers/resolucion_egresos/listado_resolucion_egresos.php');
include('../app/controllers/anio_nt/listado_de_anios.php');

if (
    isset($_SESSION['facultad']) && isset($_SESSION['actividad']) && isset($_SESSION['saldo_inicial']) && isset($_SESSION['periodo'])
) {
    $facultad = $_SESSION['facultad'];
    $actividad = $_SESSION['actividad'];
    $saldo_inicial = $_SESSION['saldo_inicial'];
    $periodo = $_SESSION['periodo'];
} else {
    $facultad = "";
    $actividad = "";
    $saldo_inicial = "";
    $periodo = "";
}






?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0"><b>Registrar Nuevo Pago</b></h4>
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
                            <h4 class="card-title">Digite los datos a detallar sobre el nuevo egreso</h4>
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
                                        <input type="text" name="saldo_inicial" value="<?php echo $saldo_inicial; ?>"
                                            hidden>
                                        <input type="text" name="periodo" value="<?php echo $periodo; ?>" hidden>

                                        <div class="form-group col-md-12" id="">
                                            <h4><b><u>INFORME DE EGRESOS</u></b></h4>
                                        </div>

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

                                        <?php

                                        function conexion()
                                        {

                                            try {
                                                $conn = new PDO('mysql:host=localhost;dbname=aplicativo_tesoreria_interno', 'root', '');
                                            } catch (PDOException $e) {
                                                echo "Error " . $e;
                                            }

                                            return $conn;
                                        }

                                        $con = conexion();
                                        $total_egresos_acumulado = current($con->query("SELECT MAX(egresos) as maximo_egresos FROM tb_detalle_egresos WHERE facultad='$facultad' AND actividad_principal='$actividad' AND estado_giro='APROBADO' AND visible!=1")->fetch());

                                        if ($total_egresos_acumulado == null) {
                                            $total_egresos_acumulado = 0;
                                        }

                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Total de Egresos (S/.)</label>
                                            <input type="text" class="form-control " name="total_egresos"
                                                id="total_egresos" value="<?php echo $total_egresos_acumulado; ?>">
                                        </div>

                                        <div class="form-group col-md-10" id="">

                                        </div>

                                        <div class="form-group col-md-8" id="">
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto" id="asunto"
                                                placeholder="Describa el asunto para el informe" required>
                                        </div>

                                        <?php

                                        //convierte cada letra inicial de una palabra en mayuscula
                                        if (isset($facultad) && isset($actividad)) {
                                            $facultad = mb_strtoupper($facultad);
                                            $actividad = mb_strtoupper($actividad);
                                        }

                                        ?>

                                        <div class="form-group col-md-8" id="">
                                            <label for="">Descripción del informe</label>
                                            <textarea type="text" class="form-control " name="descripcion"
                                                id="descripcion" rows="4" placeholder="Descripción del informe"
                                                required><?php echo "Por medio del presente se informan los egresos referentes a $actividad, realizado por la $facultad"; ?></textarea>
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
                                            <div style="display: flex;">
                                                <select class="form-control " name="resolucion" id="resolucion"
                                                    style="width:100%" required>
                                                    <option value="">SELECCIONAR</option>
                                                    <?php
                                                    foreach ($resolucion_egresos_datos as $resolucion_egresos_dato) {
                                                        $resolucion_tabla = $resolucion_egresos_dato['resolucion'];
                                                        $id_resoluciones_egresos = $resolucion_egresos_dato['id_resoluciones_egresos'];
                                                        ?>
                                                        <option
                                                            value="<?php echo $resolucion_egresos_dato['resolucion']; ?>">
                                                            <?php echo $resolucion_egresos_dato['resolucion']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-create-resolucion">+</button>
                                            </div>


                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Resolucion</label>
                                            <select class="form-control " name="fecha_resolucion" id="fecha_resolucion"
                                                style="width:100%" required>



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
                                            <input type="text" class="form-control " name="especialidad"
                                                id="especialidad" placeholder="Especialidad">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Detalle</label>
                                            <input type="text" class="form-control " name="detalle" id="detalle"
                                                placeholder="Detalle">
                                        </div>



                                        <div class="form-group col-md-2" id="">
                                            <label for="">Periodo</label>
                                            <input type="text" class="form-control " name="periodo_meses"
                                                id="periodo_meses" placeholder="Periodo">
                                        </div>

                                        <div class="form-group col-md-6" id="">

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
                                                onkeypress='return validaNumericos(event)' placeholder="N° SIAF">
                                        </div>

                                        <div class="form-group col-md-6" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Monto (S/.)</label>
                                            <input type="text" class="form-control " name="monto" id="monto"
                                                onkeypress='return validaNumericos(event)' placeholder="Monto"
                                                value="<?php echo 0; ?>">
                                        </div>

                                        <div class="form-group col-md-2" id="" hidden>
                                            <label for="">Total de Egresos (S/.)</label>
                                            <input type="text" class="form-control " name="egreso" id="egreso"
                                                onkeypress='return validaNumericos(event)'
                                                placeholder="Total de Egresos" value="<?php echo 0; ?>" required>
                                        </div>

                                        <div class="form-group col-md-2" id="" hidden>
                                            <label for="">Total de Ingresos (S/.)</label>
                                            <input type="text" class="form-control " name="ingreso" id="ingreso"
                                                onkeypress='return validaNumericos(event)'
                                                placeholder="Total de Ingresos" value="<?php echo 0; ?>">
                                        </div>

                                        <div class="form-group col-md-10" id="">

                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nota de Pago</label>
                                            <input type="text" class="form-control " name="comprobante" id="comprobante"
                                                placeholder="N° Nota de Pago">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Giro</label>
                                            <input type="date" class="form-control " name="fecha_giro" id="fecha_giro">
                                        </div>

                                        <?php

                                        $estado_giro = "PENDIENTE";

                                        ?>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Estado de Giro</label>
                                            <select class="form-control " name="estado_giro" id="estado_giro"
                                                style="width:100%" required>
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
                                            <input type="date" class="form-control " name="fecha_pago" id="fecha_pago">
                                        </div>






                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <?php

                                        $anio_actual = date("Y"); //anio
                                        
                                        $sql_detalle_ec = "SELECT MAX(numero_ec) as numero_estado_cta FROM tb_detalle_egresos WHERE YEAR(fecha_ec)='$anio_actual' AND visible!=1";
                                        $query_detalle_ec = $pdo->prepare($sql_detalle_ec);
                                        $query_detalle_ec->execute();
                                        $detalle_ec_datos = $query_detalle_ec->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($detalle_ec_datos as $detalle_ec_dato) {
                                            $numero_ec = $detalle_ec_dato['numero_estado_cta'];
                                        }

                                        if ($numero_ec != null) {
                                            $numero_ec = $detalle_ec_dato['numero_estado_cta'] + 1; //autoincrementa el numero de informe
                                        } else {
                                            $numero_ec = 1; //empieza con 1
                                        }


                                        ?>



                                        <div class="form-group col-md-2" id="">
                                            <label for="">Estado de Cuenta</label>
                                            <input type="text" class="form-control " name="numero_estado_cuenta"
                                                id="numero_estado_cuenta" value="<?php echo $numero_ec; ?>" readonly>
                                        </div>

                                        <?php
                                        $fecha_actual = date("Y-m-d");
                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Estado de Cuenta</label>
                                            <input type="date" class="form-control " name="fecha_estado_cuenta"
                                                id="fecha_estado_cuenta" value="<?php echo $fecha_actual; ?>">
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Informe de Ingreso</label>
                                            <input type="text" class="form-control " name="informe_ingreso"
                                                id="informe_ingreso" placeholder="Numero-Año"
                                                onkeypress='return validaNumericos(event)'>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Informe Ingreso</label>
                                            <input type="date" class="form-control " name="fecha_informe_ingreso">
                                        </div>

                                        <?php

                                        $anio_actual = date("Y");

                                        $numero_informe = str_pad($numero_informe, 3, "0", STR_PAD_LEFT); //rellena con ceros a la izquierda
                                        

                                        ?>



                                        <div class="form-group col-md-8" id="">
                                            <label for="">Descripción del estado de cuenta</label>
                                            <textarea type="text" class="form-control " name="descripcion_ec"
                                                id="descripcion_ec" rows="4"
                                                placeholder="Descripción del estado de cuenta"
                                                required><?php echo "Me dirijo a usted, con relación al asunto del rubro y documentos referentes de $actividad, realizado por la $facultad; así mismo se remite el Informe N° 00-$anio_actual-PI-OT-DIGA-UNFV de Programación de Ingresos y el Informe de Egresos N° $numero_informe-$anio_actual-OT-DIGA-UNFV"; ?></textarea>
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

                                $('#estado_giro').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#resolucion').select2({
                                    theme: 'bootstrap4',
                                });

                                $('#fecha_resolucion').select2({
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

<!-- /.content-wrapper -->
<div class="modal fade" id="modal-create-resolucion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: white">
                <h4 class="modal-title">Registrar Nuevo Resolucion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Resolucion</label>
                            <input type="text" id="numero_resolucion" class="form-control " placeholder="Numero-Año"
                                onkeypress='return validaNumericos(event)'>
                            <small style="color: red; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Fecha de Resolucion</label>
                            <input type="date" id="fecha" class="form-control ">
                            <small style="color: red; display: none" id="lbl_create2">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" id="btn_create"><i class="bi bi-floppy-fill"></i>
                    Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-circle"></i>
                    Cancelar</button>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function () {
        var numero_resolucion = $('#numero_resolucion').val();
        var fecha = $('#fecha').val();

        if (numero_resolucion == "") {
            $('#numero_resolucion').focus();
            $('#lbl_create').css('display', 'block');
        } else if (fecha == "") {
            $('#fecha').focus();
            $('#lbl_create2').css('display', 'block');
        } else {
            var url = "../app/controllers/resolucion_egresos/create.php";
            $.get(url, { numero_resolucion: numero_resolucion, fecha: fecha }, function (datos) {
                $('#respuesta').html(datos);
            });
        }

    });
</script>
<div id="respuesta"></div>

<?php include('../layout/parte2.php'); ?>