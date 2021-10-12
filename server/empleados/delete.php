<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: DELETE");
$metodo = $_SERVER["REQUEST_METHOD"];
if ($metodo != "DELETE" && $metodo != "OPTIONS") {
    exit("Solo se permite método DELETE");
}

if (empty($_GET["emple_id"])) {
    exit("No hay id de empleado para eliminar");
}
$emple_id = $_GET["emple_id"];
$bd = include_once "bd.php";
$sentencia = $bd->prepare("UPDATE empleados SET emple_estado='BORRADO' WHERE emple_id = ?");
$resultado = $sentencia->execute([$emple_id]);
echo json_encode($resultado);
?>