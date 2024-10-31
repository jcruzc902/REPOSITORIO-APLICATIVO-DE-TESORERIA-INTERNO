<?php
#combobox anidado segun la actividad principal seleccionada que haga un listado de subactividad
include('../../config.php');

$id_actividad_principal= $_POST['id_actividad_principal'];

$sql_subactividad = "SELECT 
subactividad.id_subactividad as id_subactividad, 
subactividad.nombre_subactividad as nombre_subactividad, 
subactividad.id_actividad_principal as id_actividad_principal 
FROM tb_subactividad as subactividad 
INNER JOIN tb_actividad_principal as actividad_principal ON actividad_principal.id_actividad_principal=subactividad.id_actividad_principal 
where subactividad.visible!=1 and subactividad.id_actividad_principal='".$id_actividad_principal."' ORDER BY subactividad.nombre_subactividad ASC";
$query_subactividad = $pdo->prepare($sql_subactividad);
$query_subactividad->execute();
$subactividad_datos = $query_subactividad->fetchAll(PDO::FETCH_ASSOC);


    $html = "<option value=''>SELECCIONAR</option>";

foreach($subactividad_datos as $subactividad_dato){

    $html .= "<option value='".$subactividad_dato["id_subactividad"]."'>".$subactividad_dato["nombre_subactividad"]."</option>";
}

echo $html;