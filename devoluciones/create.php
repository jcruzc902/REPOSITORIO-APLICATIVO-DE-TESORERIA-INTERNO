<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../layout/mensajes.php');


include ('../app/controllers/anio_periodo/listado_de_periodo.php');
include ('../app/controllers/anio_nt/listado_de_anios.php');
include ('../app/controllers/dependencias/listado_de_dependencias.php');
include ('../app/controllers/doc_pago/listado_de_docpago.php');
include ('../app/controllers/anio_envio/listado_de_envio.php');
include ('../app/controllers/condicion/listado_de_condiciones.php');
include ('../app/controllers/condicion2/listado_de_condiciones_2.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Registrar Nuevo Devolucion</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>/devoluciones"><i
                                    class="bi bi-card-checklist"></i> Devoluciones</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-clipboard-check"></i> Registrar nuevo
                            devolucion</a></li>
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
                            <h3 class="card-title">Digite los datos sobre la nueva devolucion de dinero</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: inline;">
                            <form action="../app/controllers/devolucion/create.php" method="post">
                                <input type="text" name="id_usuario" value="<?php echo $id_usuario_sesion; ?>" hidden>

                                <div class="form-row">

                                    <div class="form-group col-md-2" id="campo_periodo">
                                        <label for="">Periodo</label>
                                        <select class="form-control " name="id_anio_periodo" style="width:100%;"
                                            id="comboperiodo" required>
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($anio_periodo_datos as $anio_periodo_dato) { ?>
                                                <option value="<?php echo $anio_periodo_dato['id_anio_periodo']; ?>">
                                                    <?php echo $anio_periodo_dato['anio_periodo']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>

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
                                        <label for="">Proveido</label>
                                        <input type="text" class="form-control " name="proveido" id="proveido"
                                            placeholder="Número de Proveido" onkeypress='return validaNumericos(event)'>
                                    </div>

                                    <div class="form-group col-md-2" id="campo_fecha_proveido">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_proveido"
                                            id="fecha_proveido">
                                    </div>

                                    <div class="form-group col-md-2">

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

                                    <?php
                                    $sql_devoluciones = "SELECT MAX(informe) as numero_informe FROM tb_devoluciones WHERE visible!=1";
                                    $query_devoluciones = $pdo->prepare($sql_devoluciones);
                                    $query_devoluciones->execute();
                                    $devolucion_datos = $query_devoluciones->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($devolucion_datos as $devolucion_dato) {
                                        $numero_informe = $devolucion_dato['numero_informe'];
                                    }

                                    if ($numero_informe != null) {
                                        $numero_informe = $devolucion_dato['numero_informe'] + 1; //autoincrementa el numero de informe
                                    } else {
                                        $numero_informe = 1; //empieza con 1
                                    }

                                    $dia_actual = date("d"); //dia
                                    $mes_actual = date("m"); //mes
                                    
                                    //si es el dia es 1 y el mes es enero 
                                    if ($dia_actual == 01 && $mes_actual == 01) {
                                        $numero_informe = 1; //se reinicia con 1
                                    }
                                    ?>

                                    <div class="form-group col-md-6" id="campo_observacion">
                                        <label for="">Observacion</label>
                                        <input type="text" class="form-control " name="observacion">
                                    </div>

                                    <div class="form-group col-md-2" id="espaciado2">
                                        
                                    </div>

                                    <div class="form-group col-md-2" id="campo_informe">
                                        <label for="">Informe</label>
                                        <input type="text" class="form-control " name="informe" id="informe"
                                            value="<?php echo $numero_informe; ?>" readonly>
                                    </div>

                                    <?php
                                    $fecha_actual = date("Y-m-d");
                                    ?>

                                    <div class="form-group col-md-2" id="campo_fecha_informe">
                                        <label for="">Fecha</label>
                                        <input type="date" class="form-control " name="fecha_informe" id="fecha_informe"
                                            value="<?php echo $fecha_actual; ?>">
                                    </div>

                                    <div class="form-group col-md-4" id="campo_dependencia">
                                        <label for="">Facultad/Dependencia</label>
                                        <select class="form-control " name="id_dependencia" style="width:100%"
                                            id="combofacultad">
                                            <option value="">SELECCIONAR</option>
                                            <?php
                                            foreach ($dependencias_datos as $dependencias_dato) { ?>
                                                <option value="<?php echo $dependencias_dato['id_dependencia']; ?>">
                                                    <?php echo mb_strtoupper($dependencias_dato['nombre']); ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>

                                    </div>



                                    <div class="form-group col-md-2" style="line-height: 100px;" id="boton_ingresos">
                                        <a href="javascript:window.open('../app/controllers/devolucion/recargar.php','','width=1750, height=1000');" id="boton_vouchers" class="btn btn-lg"
                                            style="background-color: black; color: white;" >
                                            <i class="bi bi-box-arrow-in-up-right"></i> Consulta de Ingresos</a>

                                    </div>

                                    <script>
                                        $('#boton_vouchers').click(function () {
                                            var numero_tramite = $('#numero_tramite').val();
                                            var anio_nt = $('#comboaniont').val();

                                            var proveido = $('#proveido').val();
                                            var fecha_proveido = $('#fecha_proveido').val();

                                            var informe = $('#informe').val();
                                            var fecha_informe = $('#fecha_informe').val();

                                            var facultad = $('#combofacultad').val();

                                            var url = "../app/controllers/devolucion/global.php";
                                            $.get(url, {
                                                numero_tramite: numero_tramite, anio_nt: anio_nt, proveido: proveido, fecha_proveido: fecha_proveido,
                                                informe: informe, fecha_informe: fecha_informe, facultad: facultad
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
                                        if (event.charCode >= 48 && event.charCode <= 57) {
                                            return true;
                                        }
                                        return false;
                                    }
                                </script>

                                <script>
                                    $(document).ready(function () {
                                        $('#comboperiodo').select2({
                                            theme: 'bootstrap4',
                                        });



                                        $('#comboaniont').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combofacultad').select2({
                                            theme: 'bootstrap4',
                                        });


                                        $('#combodocpago').select2({
                                            theme: 'bootstrap4',
                                        });

                                        $('#combocondicional').select2({
                                            theme: 'bootstrap4',
                                        });
                                        $('#combocondicional2').select2({
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