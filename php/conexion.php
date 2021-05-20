<?php

$pass = "";
$usuario = "root";
$db = "empleados";

try {
    $conexion = new PDO("mysql:host=localhost;dbname=$db", $usuario, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Ocurrió un error con la base de datos: " . $e->getMessage();
}