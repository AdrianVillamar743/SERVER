<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: *");
if ($_SERVER["REQUEST_METHOD"] != "PUT") {
    exit("Solo acepto peticiones PUT");
}
$jsonEmpleado = json_decode(file_get_contents("php://input"));
if (!$jsonEmpleado) {
    exit("No hay datos");
}
$bd = include_once "bd.php";
$sentencia = $bd->prepare("UPDATE empleados SET emple_nombre = ?, emple_apellidos = ? WHERE emple_id = ?");
$resultado = $sentencia->execute([$jsonEmpleado->emple_nombre, $jsonEmpleado->emple_apellidos, $jsonEmpleado->emple_id]);
echo json_encode($resultado);