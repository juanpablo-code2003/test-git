<?php 

include_once 'conexion.php';

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$contrato = $_POST['contrato'];
$salario = $_POST['salario'];
$estado = $_POST['estado'];

$update = $conexion->prepare("UPDATE empleado SET nombres = ?, apellidos = ?, correo = ?, telefono = ?, tipo_contrato = ?, salario = ?, estado = ? WHERE cedula = ?");

$resultado = $update->execute([$nombre,$apellido,$correo,$telefono,$contrato,$salario,$estado,$cedula]);

if ($resultado == true) {
    $datos = array(
        "estado" => "ok",
        "mensaje" => "El empleado se actualizó con éxito"
    );
} else {
    $datos = array (
        "estado" => "error",
        "mensaje" => "Algo salio mal."
    );
}

echo json_encode($datos);