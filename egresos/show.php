<?php
include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');

include ('../app/controllers/detalle_estado_egresos/show_detalle_egreso.php');
include('../app/controllers/anio_nt/listado_de_anios.php');


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

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Facultad</label>
                                            <input type="text" class="form-control " name="facultad" value="<?php echo $facultad; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Actividad Principal</label>
                                            <input type="text" class="form-control " name="actividad_principal" value="<?php echo $actividad_principal; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Subactividad</label>
                                            <input type="text" class="form-control " name="subactividad" value="<?php echo $subactividad; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Periodo</label>
                                            <input type="text" class="form-control " name="periodo" value="<?php echo $periodo; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">NT</label>
                                            <input type="text" class="form-control " name="nt" value="<?php echo $nt; ?>" disabled>
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
                                            <input type="text" class="form-control " name="proveido_contabilidad" value="<?php echo $proveido_contabilidad; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Proveido Contabilidad</label>
                                            <input type="date" class="form-control " name="fecha_proveido_contabilidad" value="<?php echo $fecha_proveido_contabilidad; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Proveido DIGA</label>
                                            <input type="text" class="form-control " name="proveido_diga" value="<?php echo $proveido_diga; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Proveido DIGA</label>
                                            <input type="date" class="form-control " name="fecha_proveido_diga" value="<?php echo $fecha_diga; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Oficio OCLSA-ORH</label>
                                            <input type="text" class="form-control " name="oficio_oclsa_orh" value="<?php echo $oficio; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha OCLSA-ORH</label>
                                            <input type="date" class="form-control " name="fecha_oclsa_orh" value="<?php echo $fecha_oficio; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Detalle</label>
                                            <input type="text" class="form-control " name="detalle" value="<?php echo $detalle; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Orden de Compra</label>
                                            <input type="text" class="form-control " name="orden_compra" value="<?php echo $nro_orden_compra; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">N° Orden de Servicio</label>
                                            <input type="text" class="form-control " name="orden_servicio" value="<?php echo $nro_orden_servicio; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">SIAF</label>
                                            <input type="text" class="form-control " name="siaf" value="<?php echo $siaf; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <?php

                                            $monto = floatval($monto);
                                            $monto = number_format($monto, 2, '.', ','); //convertir int a decimal

                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Monto (S/.)</label>
                                            <input type="text" class="form-control " name="monto" value="<?php echo $monto; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Nota de Pago</label>
                                            <input type="text" class="form-control " name="comprobante" value="<?php echo $comprobante_pago; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Pago</label>
                                            <input type="date" class="form-control " name="fecha_pago" value="<?php echo $fecha_pago; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Giro</label>
                                            <input type="date" class="form-control " name="fecha_giro" value="<?php echo $fecha_giro;?>" disabled>
                                        </div>



                                        <div class="form-group col-md-6" id="">
                                            <label for="">Asunto</label>
                                            <input type="text" class="form-control " name="asunto" value="<?php echo $asunto; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-6" id="">

                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Informe</label>
                                            <input type="text" class="form-control " name="informe" value="<?php echo $informe; ?>" disabled>
                                        </div>

                                        <?php
                                        $fecha_actual = date("Y-m-d");
                                        ?>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Informe</label>
                                            <input type="date" class="form-control " name="fecha_informe" value="<?php echo $fecha_informe; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-2" id="">
                                            <label for="">Resolucion</label>
                                            <input type="text" class="form-control " name="resolucion" value="<?php echo $resolucion; ?>" disabled>
                                        </div>

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha Resolucion</label>
                                            <input type="date" class="form-control " name="fecha_resolucion" value="<?php echo $fecha_resolucion; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-4" id="">

                                        </div>

                                        <?php

                                        $egresos = floatval($egresos);
                                        $egresos = number_format($egresos, 2, '.', ','); //convertir int a decimal

                                        
                                        $ingresos = floatval($ingresos);
                                        $ingresos = number_format($ingresos, 2, '.', ','); //convertir int a decimal
                                        
                                        ?>        

                                        <div class="form-group col-md-2" id="" >
                                            <label for="">Egresos</label>
                                            <input type="text" class="form-control " name="egresos" 
                                                value="<?php echo $egresos; ?>" disabled>
                                        </div>


                                        <div class="form-group col-md-2" id="" >
                                            <label for="">Ingresos</label>
                                            <input type="text" class="form-control " name="ingresos" 
                                                value="<?php echo $ingresos; ?>" disabled>
                                        </div>

                                        <!--
                                        <div class="form-group col-md-2" id="" >
                                            <label for="">Saldo</label>
                                            <input type="text" class="form-control " name="saldo" 
                                                value="<?php echo $saldo; ?>" disabled>
                                        </div>
                                        -->

                                        <?php 
                                        $theDate = new DateTime($fecha_registro);
                                        $fecha_registro = $theDate->format('d/m/Y h:i:s a');
                                        ?>
                 

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Fecha de Registro</label>
                                            <input class="form-control" type="text" 
                                                value="<?php echo $fecha_registro; ?>" disabled>
                                        </div>

                                        <!--
                                        <div class="form-group col-md-4" id="">
                                            
                                        </div>
                                        -->

                                        <div class="form-group col-md-2" id="">
                                            <label for="">Usuario</label>
                                            <input class="form-control" type="text" 
                                                value="<?php echo $usuario; ?>" disabled>
                                        </div>
                                    
                                </div>

                                    


                                    
                                    

                                    <div class="form-group col-md-12" align="right">
                                        <a href="index" class="btn" style="background-color: grey; color: white;"><i
                                                class="bi bi-x-circle-fill"></i> Cancelar</a>

                                    </div>
                                </div>

                                

                            </form>
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

<?php include ('../layout/mensajes.php'); ?>
<?php include ('../layout/parte2.php'); ?>