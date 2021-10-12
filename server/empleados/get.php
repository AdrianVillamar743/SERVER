<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
if (empty($_GET["emple_id"])) {
    exit("No hay id de empleado");
}
$emple_id = $_GET["emple_id"];
$bd = include_once "bd.php";
$sentencia = $bd->prepare("select emple_id,emple_nombre,emple_apellidos from empleados where emple_id = ?");
$sentencia->execute([$emple_id]);
$empleado = $sentencia->fetchObject();
echo json_encode($empleado);

?>