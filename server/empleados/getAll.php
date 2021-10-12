<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
$bd = include_once "bd.php";
$sentencia = $bd->query("select emple_id, emple_nombre, emple_apellidos, emple_estado from empleados where emple_estado like 'activo'");
$empleados = $sentencia->fetchAll(PDO::FETCH_OBJ);
echo json_encode($empleados);
?>