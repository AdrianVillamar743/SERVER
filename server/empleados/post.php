<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Headers: *");
$jsonEmpleado = json_decode(file_get_contents("php://input"));
if (!$jsonEmpleado) {
    exit("No hay datos");
}
$bd = include_once "bd.php";
$sentencia = $bd->prepare("insert into empleados(emple_nombre, emple_apellidos, emple_estado) values (?,?,'ACTIVO')");
$resultado = $sentencia->execute([$jsonEmpleado->emple_nombre, $jsonEmpleado->emple_apellidos]);
echo json_encode([
    "resultado" => $resultado,
]);
?>