<?php 

include_once "conexion.php";

$cedula = $_POST["cedula"];

$delete = $conexion->prepare("DELETE FROM empleado WHERE cedula = ?;");
$resultado = $delete->execute([$cedula]);

if ($resultado == true) {
    $datos = array(
        'estado' => 'ok',
        'mensaje' => 'El empleado se eliminó correctamente'
    );
} else {
    $datos = array(
        'estado' => 'error',
        'mensaje' => 'Algo salió mal'
    );
}

echo json_encode($datos);