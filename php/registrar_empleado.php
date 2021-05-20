<?php 

include_once "conexion.php";

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$contrato = $_POST['contrato'];
$salario = $_POST['salario'];
$estado = 'activo';

$insert = $conexion->prepare("INSERT INTO empleado (cedula, nombres, apellidos, correo, telefono, tipo_contrato, salario, estado) VALUES (?,?,?,?,?,?,?,?);");
$resultado = $insert->execute([$cedula,$nombre,$apellido,$correo,$telefono,$contrato,$salario,$estado]);

if ($resultado == true) {
    $ultimoId = $conexion->lastInsertId('cedula');
    $datos = array(
        "estado" => "ok",
        "mensaje" => "El empleado se agregó con éxito",
        "cedula" => $ultimoId
    );
} else {
    $datos = array(
        "estado" => "error",
        "mensaje" => "Algo salió mal. Por favor intentelo nuevamente",
    );
}

echo json_encode($datos);

?>