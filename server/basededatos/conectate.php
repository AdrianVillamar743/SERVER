<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "empresa_importante";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados WHERE emple_id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE empleados SET emple_estado='BORRADO' WHERE emple_id=".$_GET["borrar"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $emple_nombre=$data->emple_nombre;
    $emple_apellidos=$data->emple_apellidos;
    if ($emple_nombre =="" or $emple_apellidos==""){
        exit();
    }else{

    
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO empleados(emple_nombre,emple_apellidos,emple_estado) VALUES('$emple_nombre','$emple_apellidos','ACTIVO') ");
    echo json_encode(["success"=>1]);
}  
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $emple_id=(isset($data->emple_id))?$data->emple_id:$_GET["actualizar"];
    $emple_nombre=$data->emple_nombre;
    $emple_apellidos=$data->emple_apellidos;
    
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE empleados SET emple_nombre='$emple_nombre',emple_apellidos='$emple_apellidos' WHERE emple_id='$emple_id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados where emple_estado='ACTIVO' OR emple_estado='activo'");
if(mysqli_num_rows($sqlEmpleaados) > 0){
    $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }


?> 