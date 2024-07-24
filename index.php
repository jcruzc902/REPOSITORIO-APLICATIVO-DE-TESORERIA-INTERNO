<?php
include ('app/config.php');
include ('layout/sesion.php');

include ('layout/parte1.php');

#$voice = new COM("SAPI.SpVoice");


function conexion()
{

    try {
        $conn = new PDO('mysql:host=localhost;dbname=sistemadedevoluciondedinero', 'root', '');
    } catch (PDOException $e) {
        echo "Error " . $e;
    }

    return $conn;
}


/*
if(isset($_SESSION['nombre_usuario'])){
    $respuesta = $_SESSION['nombre_usuario'];
    $voice->Speak($respuesta); //CODIFICA TEXTO A VOZ
}
*/

?>







<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Panel principal del Sistema</b>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo $URL; ?>"><i class="bi bi-house-door-fill"></i>
                                Inicio</a></li>
                        <li class="breadcrumb-item active"><i class="bi bi-gear-fill"></i> Panel principal</li>
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






                <div class="col-lg-4 col-6" id="card_devoluciones">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_devoluciones = current($con->query("select count(*) from tb_devoluciones where visible!=1")->fetch());


                                    if ($contador_devoluciones == NULL) {
                                        $contador_devoluciones = 0;
                                    } else {
                                        $contador_devoluciones;
                                    }

                                    echo $contador_devoluciones;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Devoluciones <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="<?php echo $URL; ?>/devoluciones/create.php">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-coins"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/devoluciones" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_egresos">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_egresos = current($con->query("select count(*) from tb_egresos where visible!=1")->fetch());


                                    if ($contador_egresos == NULL) {
                                        $contador_egresos = 0;
                                    } else {
                                        $contador_egresos;
                                    }

                                    echo $contador_egresos;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Egresos <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="<?php echo $URL; ?>/egresos/create.php">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-calculator"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/egresos" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_cheques">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_cheques = current($con->query("select count(*) from tb_cheque where visible!=1")->fetch());


                                    if ($contador_cheques == NULL) {
                                        $contador_cheques = 0;
                                    } else {
                                        $contador_cheques;
                                    }

                                    echo $contador_cheques;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Cheques <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="<?php echo $URL; ?>/cheques/create.php">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-money-check"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/cheques" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_tasas_tarifas">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_tasas_tarifas = current($con->query("select count(*) from tb_tasas_tarifas where visible!=1")->fetch());


                                    if ($contador_tasas_tarifas == NULL) {
                                        $contador_tasas_tarifas = 0;
                                    } else {
                                        $contador_tasas_tarifas;
                                    }

                                    echo $contador_tasas_tarifas;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Tasas y Tarifas <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="<?php echo $URL; ?>/tasas_tarifas/create.php">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-signal"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/tasas_tarifas" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_empresas">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_empresas = current($con->query("select count(*) from tb_empresas where visible!=1 and id_empresa!=1")->fetch());


                                    if ($contador_empresas == NULL) {
                                        $contador_empresas = 0;
                                    } else {
                                        $contador_empresas;
                                    }

                                    echo $contador_empresas;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Empresas <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="#">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-building"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/empresas" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>







                <div class="col-lg-4 col-6" id="card_dependencias">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_dependencias = current($con->query("select count(*) from tb_dependencias where visible!=1 and id_dependencia!=1")->fetch());


                                    if ($contador_dependencias == NULL) {
                                        $contador_dependencias = 0;
                                    } else {
                                        $contador_dependencias;
                                    }

                                    echo $contador_dependencias;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Dependencias <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="#">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-bookmark"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/dependencias" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-4 col-6" id="card_conceptos">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_conceptos = current($con->query("select count(*) from tb_conceptos where visible!=1 and id_concepto!=1")->fetch());


                                    if ($contador_conceptos == NULL) {
                                        $contador_conceptos = 0;
                                    } else {
                                        $contador_conceptos;
                                    }

                                    echo $contador_conceptos;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Conceptos <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="#">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/conceptos" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_bancos">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_conceptos = current($con->query("select count(*) from tb_bancos where visible!=1 and id_banco!=1")->fetch());


                                    if ($contador_conceptos == NULL) {
                                        $contador_conceptos = 0;
                                    } else {
                                        $contador_conceptos;
                                    }

                                    echo $contador_conceptos;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Bancos <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="#">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-university"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/bancos" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_roles">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_roles = current($con->query("select count(*) from tb_roles where visible!=1")->fetch());


                                    if ($contador_roles == NULL) {
                                        $contador_roles = 0;
                                    } else {
                                        $contador_roles;
                                    }

                                    echo $contador_roles;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Roles <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="#">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/roles" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-6" id="card_usuarios">
                    <div class="small-box " style="background-color: gainsboro; color: black;">
                        <div class="inner">

                            <h1><b>
                                    <?php

                                    //consulta sql
                                    $con = conexion();
                                    $contador_usuarios = current($con->query("select count(*) from tb_usuarios where visible!=1")->fetch());


                                    if ($contador_usuarios == NULL) {
                                        $contador_usuarios = 0;
                                    } else {
                                        $contador_usuarios;
                                    }

                                    echo $contador_usuarios;
                                    ?>
                                </b></h1>
                            <p>
                            <h5><b>Usuarios <br> Registrados</b></h5>
                            </p>
                        </div>
                        <a href="<?php echo $URL; ?>/usuarios/create.php">
                            <div class="icon" style="background-color: black; color: black">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </a>
                        <a href="<?php echo $URL; ?>/usuarios" class="small-box-footer"
                            style="background-color: midnightblue; color: white;">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>



            </div>

            <br>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <?php
    date_default_timezone_set("America/Lima");
    $year_current = date('Y');
    ?>


    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12" id="chart_importe_devolucion">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Devolucion de Dinero Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var periodo = $("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart.php',
                                    data: { 'periodo': periodo, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 257443 Y 300152 - PERIODO ' + periodo,

                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_devolucion">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Recibos Registrados de Devolucion de
                                Dinero</h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo2" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization2();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div2" style="width: 100%; height: 550px; "></div>


                        </div>

                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization2);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization2() {
                                // Some raw data (not necessarily accurate)
                                var periodo2 = $("#periodo2").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart2.php',
                                    data: { 'periodo2': periodo2, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 257443 Y 300152 - PERIODO ' + periodo2,
                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization2();
                                });
                            });

                        </script>



                    </div>

                </div>



                <div class="col-md-12" id="chart_importe_cheque">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Cheque Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo4" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization4();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div4" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization4);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization4() {
                                // Some raw data (not necessarily accurate)
                                var periodo4 = $("#periodo4").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart4.php',
                                    data: { 'periodo4': periodo4, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 257443 Y 300152 - PERIODO ' + periodo4,

                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div4'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization4();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_cheque">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Cheques Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo5" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization5();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div5" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization5);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization5() {
                                // Some raw data (not necessarily accurate)
                                var periodo5 = $("#periodo5").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart5.php',
                                    data: { 'periodo5': periodo5, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE NRO. CUENTA 257443 Y 300152 - PERIODO ' + periodo5,

                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div5'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization5();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_egresos">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Monto Total de Egresos Mensual (S/.)</h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo3" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization3();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div3" style="width: 100%; height: 550px; "></div>


                        </div>

                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization3);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization3() {
                                // Some raw data (not necessarily accurate)
                                var periodo3 = $("#periodo3").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart3.php',
                                    data: { 'periodo3': periodo3, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE EGRESOS - PERIODO ' + periodo3,
                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div3'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization3();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_egresos">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Egresos Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo6" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization6();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div6" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization6);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization6() {
                                // Some raw data (not necessarily accurate)
                                var periodo6 = $("#periodo6").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart6.php',
                                    data: { 'periodo6': periodo6, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE EGRESOS - PERIODO ' + periodo6,

                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div6'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization6();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_importe_tasas_tarifas">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Importe Total de Tasas y Tarifas Mensual (S/.)
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo7" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization7();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div7" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization7);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization7() {
                                // Some raw data (not necessarily accurate)
                                var periodo7 = $("#periodo7").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart7.php',
                                    data: { 'periodo7': periodo7, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE TASAS Y TARIFAS ' + periodo7,

                                    vAxis: { title: 'Monto' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div7'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization7();
                                });
                            });

                        </script>



                    </div>

                </div>

                <div class="col-md-12" id="chart_cantidad_tasas_tarifas">
                    <div class="card card-dark shadow-lg"
                        style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
                        <div class="card-header">
                            <h1 class="card-title">Estadística de Cantidad de Tasas y Tarifas Registrados
                            </h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body">

                            <div class='col-md-2' style="margin-left: 50px;">
                                <label>Selecciona período</label>
                                <select id="periodo8" class="form-control " style="width: 100%;"
                                    onchange="drawVisualization8();">
                                    <?php

                                    for ($i = 2000; $i <= 2050; $i++) {
                                        if ($i == $year_current) {
                                            echo '<option value="' . $i . '" selected>' . $i . '</option>';
                                        } else {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div id="chart_div8" style="width: 100%; height: 550px; "></div>


                        </div>


                        <script type="text/javascript">
                            google.charts.load('current', { 'packages': ['corechart'] });
                            google.charts.setOnLoadCallback(drawVisualization8);

                            function errorHandler(errorMessage) {
                                //curisosity, check out the error in the console
                                console.log(errorMessage);
                                //simply remove the error, the user never see it
                                google.visualization.errors.removeError(errorMessage.id);
                            }

                            function drawVisualization8() {
                                // Some raw data (not necessarily accurate)
                                var periodo8 = $("#periodo8").val();//Datos que enviaremos para generar una consulta en la base de datos
                                var jsonData = $.ajax({
                                    url: '<?php echo $URL; ?>/grafica/chart8.php',
                                    data: { 'periodo8': periodo8, 'action': 'ajax' },
                                    dataType: 'json',
                                    async: false
                                }).responseText;

                                var obj = jQuery.parseJSON(jsonData);
                                var data = google.visualization.arrayToDataTable(obj);



                                var options = {
                                    title: 'REPORTE DE TASAS Y TARIFAS - PERIODO ' + periodo8,

                                    vAxis: { title: 'Cantidad' },
                                    hAxis: { title: 'Meses' },
                                    seriesType: 'bars',
                                    series: { 5: { type: 'line' } }
                                };

                                var chart = new google.visualization.ComboChart(document.getElementById('chart_div8'));
                                google.visualization.events.addListener(chart, 'error', errorHandler);
                                chart.draw(data, options);
                            }

                            // Haciendo los graficos responsivos
                            jQuery(document).ready(function () {
                                jQuery(window).resize(function () {
                                    drawVisualization8();
                                });
                            });

                        </script>



                    </div>

                </div>




                <script>
                    $(document).ready(function () {
                        $('#periodo').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo2').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo3').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo4').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo5').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo6').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo7').select2({
                            theme: 'bootstrap4',
                        });
                        $('#periodo8').select2({
                            theme: 'bootstrap4',
                        });
                    });
                </script>

            </div>
        </div>
    </div>

    <?php
    if ($rol_sesion == "ADMINISTRADOR") { ?>
        <script>
            document.getElementById('card_devoluciones').style.display = 'inline';
            document.getElementById('card_egresos').style.display = 'inline';
            document.getElementById('card_cheques').style.display = 'inline';
            document.getElementById('card_tasas_tarifas').style.display = 'inline';
            document.getElementById('card_dependencias').style.display = 'inline';
            document.getElementById('card_conceptos').style.display = 'inline';
            document.getElementById('card_empresas').style.display = 'inline';
            document.getElementById('card_bancos').style.display = 'inline';
            document.getElementById('card_roles').style.display = 'inline';
            document.getElementById('card_usuarios').style.display = 'inline';
            document.getElementById('chart_importe_devolucion').style.display = 'inline';
            document.getElementById('chart_cantidad_devolucion').style.display = 'inline';
            document.getElementById('chart_importe_cheque').style.display = 'inline';
            document.getElementById('chart_cantidad_cheque').style.display = 'inline';
            document.getElementById('chart_egresos').style.display = 'inline';
            document.getElementById('chart_cantidad_egresos').style.display = 'inline';
            document.getElementById('chart_importe_tasas_tarifas').style.display = 'inline';
            document.getElementById('chart_cantidad_tasas_tarifas').style.display = 'inline';
        </script>
    <?php } else if ($rol_sesion == "INGRESOS") { ?>
            <script>
                document.getElementById('card_devoluciones').style.display = 'none';
                document.getElementById('card_egresos').style.display = 'none';
                document.getElementById('card_cheques').style.display = 'none';
                document.getElementById('card_tasas_tarifas').style.display = 'none';
                document.getElementById('card_dependencias').style.display = 'none';
                document.getElementById('card_conceptos').style.display = 'none';
                document.getElementById('card_empresas').style.display = 'none';
                document.getElementById('card_bancos').style.display = 'none';
                document.getElementById('card_roles').style.display = 'none';
                document.getElementById('card_usuarios').style.display = 'none';
                document.getElementById('chart_importe_devolucion').style.display = 'inline';
                document.getElementById('chart_cantidad_devolucion').style.display = 'inline';
                document.getElementById('chart_importe_cheque').style.display = 'inline';
                document.getElementById('chart_cantidad_cheque').style.display = 'inline';
                document.getElementById('chart_egresos').style.display = 'inline';
                document.getElementById('chart_cantidad_egresos').style.display = 'inline';
                document.getElementById('chart_importe_tasas_tarifas').style.display = 'inline';
                document.getElementById('chart_cantidad_tasas_tarifas').style.display = 'inline';
            </script>
    <?php } else if ($rol_sesion == "SECRETARIA") { ?>
                <script>
                    document.getElementById('card_devoluciones').style.display = 'none';
                    document.getElementById('card_egresos').style.display = 'none';
                    document.getElementById('card_cheques').style.display = 'none';
                    document.getElementById('card_tasas_tarifas').style.display = 'none';
                    document.getElementById('card_dependencias').style.display = 'none';
                    document.getElementById('card_conceptos').style.display = 'none';
                    document.getElementById('card_empresas').style.display = 'none';
                    document.getElementById('card_bancos').style.display = 'none';
                    document.getElementById('card_roles').style.display = 'none';
                    document.getElementById('card_usuarios').style.display = 'none';
                    document.getElementById('chart_importe_devolucion').style.display = 'inline';
                    document.getElementById('chart_cantidad_devolucion').style.display = 'inline';
                    document.getElementById('chart_importe_cheque').style.display = 'inline';
                    document.getElementById('chart_cantidad_cheque').style.display = 'inline';
                    document.getElementById('chart_egresos').style.display = 'inline';
                    document.getElementById('chart_cantidad_egresos').style.display = 'inline';
                    document.getElementById('chart_importe_tasas_tarifas').style.display = 'inline';
                    document.getElementById('chart_cantidad_tasas_tarifas').style.display = 'inline';
                </script>
    <?php } else if ($rol_sesion == "DIGA") { ?>
                    <script>
                        document.getElementById('card_devoluciones').style.display = 'none';
                        document.getElementById('card_egresos').style.display = 'none';
                        document.getElementById('card_cheques').style.display = 'none';
                        document.getElementById('card_tasas_tarifas').style.display = 'none';
                        document.getElementById('card_dependencias').style.display = 'none';
                        document.getElementById('card_conceptos').style.display = 'none';
                        document.getElementById('card_empresas').style.display = 'none';
                        document.getElementById('card_bancos').style.display = 'none';
                        document.getElementById('card_roles').style.display = 'none';
                        document.getElementById('card_usuarios').style.display = 'none';
                        document.getElementById('chart_importe_devolucion').style.display = 'inline';
                        document.getElementById('chart_cantidad_devolucion').style.display = 'inline';
                        document.getElementById('chart_importe_cheque').style.display = 'inline';
                        document.getElementById('chart_cantidad_cheque').style.display = 'inline';
                        document.getElementById('chart_egresos').style.display = 'inline';
                        document.getElementById('chart_cantidad_egresos').style.display = 'inline';
                        document.getElementById('chart_importe_tasas_tarifas').style.display = 'inline';
                        document.getElementById('chart_cantidad_tasas_tarifas').style.display = 'inline';
                    </script>
    <?php } else if ($rol_sesion == "JEFATURA") { ?>
                        <script>
                            document.getElementById('card_devoluciones').style.display = 'none';
                            document.getElementById('card_egresos').style.display = 'none';
                            document.getElementById('card_cheques').style.display = 'none';
                            document.getElementById('card_tasas_tarifas').style.display = 'none';
                            document.getElementById('card_dependencias').style.display = 'none';
                            document.getElementById('card_conceptos').style.display = 'none';
                            document.getElementById('card_empresas').style.display = 'none';
                            document.getElementById('card_bancos').style.display = 'none';
                            document.getElementById('card_roles').style.display = 'none';
                            document.getElementById('card_usuarios').style.display = 'none';
                            document.getElementById('chart_importe_devolucion').style.display = 'inline';
                            document.getElementById('chart_cantidad_devolucion').style.display = 'inline';
                            document.getElementById('chart_importe_cheque').style.display = 'inline';
                            document.getElementById('chart_cantidad_cheque').style.display = 'inline';
                            document.getElementById('chart_egresos').style.display = 'inline';
                            document.getElementById('chart_cantidad_egresos').style.display = 'inline';
                            document.getElementById('chart_importe_tasas_tarifas').style.display = 'inline';
                            document.getElementById('chart_cantidad_tasas_tarifas').style.display = 'inline';
                        </script>
    <?php } ?>




</div>
<!-- /.content-wrapper -->

<?php include ('layout/mensajes.php'); ?>
<?php include ('layout/parte2.php'); ?>